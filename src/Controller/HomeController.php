<?php

namespace App\Controller;

use App\Services\NewsService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    public function __construct(private NewsService $newsService)
    {
    }

    #[Route('/', name: 'home_index', methods: ['GET'])]
    public function index(): Response
    {
        $pageTitle = 'Home';

        return $this->render('home/index.html.twig', [
            'pageTitle' => $pageTitle,
            'categories' => $this->newsService->getCategoriesList()
        ]);
    }

    #[Route('/category/{slug}', name: 'home_category', methods: ['GET'])]
    public function category(string $slug = null): Response
    {
        return $this->render('home/category.html.twig', [
            'pageTitle' => $slug,
            'categories' => $this->newsService->getCategoriesList(),
            'news' => $this->newsService->getNewsList()
        ]);
    }
}
