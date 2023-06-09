<?php

namespace App\Controller;

use Pagerfanta\Pagerfanta;
use App\Repository\NewsRepository;
use App\Repository\CategoryRepository;
use Pagerfanta\Doctrine\ORM\QueryAdapter;
use Symfony\Component\HttpFoundation\Request;
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
    public function category(Request $request, string $slug = null): Response
    {
        $queryBuilder = $this->newsRepository->createQueryBuilderByCategoryTitle($slug);
        $adapter = new QueryAdapter($queryBuilder);

        $pagerFanta = Pagerfanta::createForCurrentPageWithMaxPerPage(
            $adapter,
            $request->get('page', 1),
            6
        );

        return $this->render('home/category.html.twig', [
            'pageTitle' => $slug,
            'categories' => $this->categoryRepository->findAllCategoriesOrderByTitle(),
            'pager' => $pagerFanta
        ]);
    }
}
