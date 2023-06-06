<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    private $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    #[Route('/', name: 'home_index', methods: ['GET'])]
    public function index(): Response
    {
        $pageTitle = 'Home';

        return $this->render('home/index.html.twig', [
            'pageTitle' => $pageTitle,
            'categories' => $this->getCategoriesList()
        ]);
    }

    #[Route('/category/{slug}', name: 'home_category', methods: ['GET'])]
    public function category(string $slug = null): Response
    {
        return $this->render('home/category.html.twig', [
            'pageTitle' => $slug,
            'categories' => $this->getCategoriesList(),
            'news' => $this->getNewsList()
        ]);
    }

    public function getCategoriesList(): array
    {
        $url = 'https://raw.githubusercontent.com/JonasPoli/array-news/main/arrayCategoryNews.json';
        $response = $this->client->request('GET', $url);

        return $response->toArray();
    }

    public function getNewsList(): array
    {
        $url = 'https://raw.githubusercontent.com/JonasPoli/array-news/main/arrayNews.json';
        $response = $this->client->request('GET', $url);

        return $response->toArray();
    }
}
