<?php

namespace App\Services;

use Symfony\Contracts\Cache\ItemInterface;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class NewsService
{
    public function __construct(
        private HttpClientInterface $client,
        private CacheInterface $cacheInterface
    ) {
    }

    public function getCategoriesList(): array
    {
        $categories = $this->cacheInterface->get('news_categories', function (ItemInterface $itemInterface) {
            $itemInterface->expiresAfter(60);
            $url = 'https://raw.githubusercontent.com/JonasPoli/array-news/main/arrayCategoryNews.json';
            $response = $this->client->request('GET', $url);

            return $response->toArray();
        });

        return $categories;
    }

    public function getNewsList(): array
    {
        $newsList = $this->cacheInterface->get('news_list', function (ItemInterface $itemInterface) {
            $itemInterface->expiresAfter(60);
            $url = 'https://raw.githubusercontent.com/JonasPoli/array-news/main/arrayNews.json';
            $response = $this->client->request('GET', $url);

            return $response->toArray();
        });

        return $newsList;
    }
}
