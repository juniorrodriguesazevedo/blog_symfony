<?php

namespace App\Controller;

use App\Entity\News;
use App\Entity\Category;
use App\Repository\NewsRepository;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    public function __construct(
        private NewsRepository $newsRepository,
        private CategoryRepository $categoryRepository
    ) {
    }

    #[Route('/', name: 'home_index', methods: ['GET'])]
    public function index(): Response
    {
        $pageTitle = 'Home';

        return $this->render('home/index.html.twig', [
            'pageTitle' => $pageTitle,
            'categories' => $this->categoryRepository->findAllCategoriesOrderByTitle()
        ]);
    }

    #[Route('/category/{slug}', name: 'home_category', methods: ['GET'])]
    public function category(string $slug = null): Response
    {
        return $this->render('home/category.html.twig', [
            'pageTitle' => $slug,
            'categories' => $this->categoryRepository->findAllCategoriesOrderByTitle(),
            'news' => $this->newsRepository->findByCategoryName($slug)
        ]);
    }
}
