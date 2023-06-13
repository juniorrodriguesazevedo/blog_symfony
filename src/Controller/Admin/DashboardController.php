<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use App\Repository\NewsRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    public function __construct(private NewsRepository $newsRepository)
    {
    }

    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return $this->render('admin/dashboard.html.twig', [
            'lastNews' => $this->newsRepository->findLastNews(10)
        ]);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Blog Symfony');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');

        yield MenuItem::linkToCrud('Usuários', 'fa fa-users', User::class)
            ->setController(UserCrudController::class);

        yield MenuItem::linkToCrud('Categorias', 'fa fa-bars', Category::class)
            ->setController(CategoryCrudController::class);

        yield MenuItem::linkToCrud('Notícias', 'fa fa-newspaper-o', News::class)
            ->setController(NewsCrudController::class);
    }
}
