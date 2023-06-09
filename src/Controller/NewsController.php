<?php

namespace App\Controller;

use App\Entity\News;
use Pagerfanta\Pagerfanta;
use App\Repository\NewsRepository;
use Pagerfanta\Doctrine\ORM\QueryAdapter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Config\BabdevPagerfantaConfig;

class NewsController extends AbstractController
{
    public function __construct(private NewsRepository $newsRepository)
    {
    }

    #[Route('/api/news/{id}', name: 'api_news_index', methods: ['GET'])]
    public function index(int $id = null): JsonResponse
    {
        $news = [
            'id' => $id,
            'title' => 'Lorem Ipsum is simply dummy text of the printing and typesetting',
        ];

        return new JsonResponse($news);
    }

    #[Route('/news/create', name: 'news_create', methods: ['GET'])]
    public function create(): Response
    {
        $year = rand(10, 50);

        $new = new News();
        $new->setTitle("Jovem é idoso $year");
        $new->setDescription("Jovem é de laska mesmo essa merda $year");
        $this->newsRepository->save($new, true);

        return new Response("{$new->getTitle()}, <br> {$new->getDescription()}");
    }

    #[Route('/news/show/{new}', name: 'news_show', methods: ['GET'])]
    public function show(News $new): Response
    {
        return $this->render('news/show.html.twig', ['new' => $new]);
    }

    #[Route('/news/search', name: 'news_search', methods: ['GET'])]
    public function search(Request $request): Response
    {
        $search = $request->get('search');
        $queryBuilder = $this->newsRepository->createQueryBuilderBySearch($search);
        $adpter = new QueryAdapter($queryBuilder);
        
        $pageFanta = Pagerfanta::createForCurrentPageWithMaxPerPage(
            $adpter,
            $request->get('page', 1),
            6
        );

        return $this->render('news/search.html.twig', [
            'pager' => $pageFanta,
            'search' => $search
        ]);
    }
}
