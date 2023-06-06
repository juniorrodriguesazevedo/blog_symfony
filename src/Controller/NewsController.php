<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class NewsController extends AbstractController
{
    #[Route('/api/news/{id}', name: 'api_news_index', methods: ['GET'])]
    public function index(int $id = null): Response
    {
        $news = [
            'id' => $id,
            'title' => 'Lorem Ipsum is simply dummy text of the printing and typesetting',
        ];

        return new JsonResponse($news);
    }
}
