<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home_index', methods: ['GET'])]
    public function index(): Response
    {
        $pageTitle = 'Home';

        $categories = [
            ['title' => 'Mundo',      'text' => 'Notícias sobre o Mundo'],
            ['title' => 'Brasil',     'text' => 'Notícias sobre o Brasil'],
            ['title' => 'Tecnologia', 'text' => 'Notícias sobre Tecnologia'],
            ['title' => 'Design',     'text' => 'Notícias sobre Design'],
            ['title' => 'Cultura',    'text' => 'Notícias sobre Cultura'],
            ['title' => 'Negócios',   'text' => 'Notícias sobre Negócios'],
            ['title' => 'Política',   'text' => 'Notícias sobre Política'],
            ['title' => 'Opinião',    'text' => 'Notícias sobre Opinião'],
            ['title' => 'Ciência',    'text' => 'Notícias sobre Ciência'],
            ['title' => 'Saúde',      'text' => 'Notícias sobre Saúde'],
            ['title' => 'Estilo',     'text' => 'Notícias sobre Estilo de vida'],
            ['title' => 'Viagens',    'text' => 'Notícias sobre Viagens'],
        ];

        return $this->render('home/index.html.twig', [
            'pageTitle' => $pageTitle,
            'categories' => $categories
        ]);
    }

    #[Route('/category/{slug}', name: 'home_category', methods: ['GET'])]
    public function category(string $slug = null): Response
    {
        $categories = [
            ['title' => 'Mundo',      'text' => 'Notícias sobre o Mundo'],
            ['title' => 'Brasil',     'text' => 'Notícias sobre o Brasil'],
            ['title' => 'Tecnologia', 'text' => 'Notícias sobre Tecnologia'],
            ['title' => 'Design',     'text' => 'Notícias sobre Design'],
            ['title' => 'Cultura',    'text' => 'Notícias sobre Cultura'],
            ['title' => 'Negócios',   'text' => 'Notícias sobre Negócios'],
            ['title' => 'Política',   'text' => 'Notícias sobre Política'],
            ['title' => 'Opinião',    'text' => 'Notícias sobre Opinião'],
            ['title' => 'Ciência',    'text' => 'Notícias sobre Ciência'],
            ['title' => 'Saúde',      'text' => 'Notícias sobre Saúde'],
            ['title' => 'Estilo',     'text' => 'Notícias sobre Estilo de vida'],
            ['title' => 'Viagens',    'text' => 'Notícias sobre Viagens'],
        ];

        return $this->render('home/category.html.twig', [
            'pageTitle' => $slug,
            'categories' => $categories,
            'news' => $this->getNewsList()
        ]);
    }

    public function getNewsList()
    {
        return [
            [
                "title" => "Nova descoberta arqueológica no Egito",
                "description" => "Arqueólogos descobriram uma nova tumba faraônica com artefatos e múmias bem preservadas.",
                "image" => "https://picsum.photos/419/225",
                "create_at" => date('d/m/Y')
            ],
            [
                "title" => "Empresa anuncia novo produto revolucionário",
                "description" => "A empresa XYZ anunciou o lançamento de um novo produto que promete mudar o mercado.",
                "image" => "https://picsum.photos/419/225",
                "create_at" => date('d/m/Y')
            ],
            [
                "title" => "Novo estudo revela impactos do aquecimento global",
                "description" => "Um novo estudo mostra que o aquecimento global está causando mudanças drásticas em ecossistemas marinhos.",
                "image" => "https://picsum.photos/419/225",
                "create_at" => date('d/m/Y')
            ],
            [
                "title" => "Atleta brasileiro ganha medalha de ouro em competição internacional",
                "description" => "O atleta brasileiro João da Silva conquistou a medalha de ouro no campeonato mundial de atletismo.",
                "image" => "https://picsum.photos/419/225",
                "create_at" => date('d/m/Y')
            ],
            [
                "title" => "Novo filme de super-herói bate recorde de bilheteria",
                "description" => "O novo filme da franquia 'Super-Herói X' bateu recorde de bilheteria em sua primeira semana de exibição.",
                "image" => "https://picsum.photos/419/225",
                "create_at" => date('d/m/Y')
            ],
            [
                "title" => "Pesquisadores descobrem nova espécie de animal marinho",
                "description" => "Pesquisadores da Universidade de São Paulo descobriram uma nova espécie de peixe em águas profundas do oceano Atlântico.",
                "image" => "https://picsum.photos/419/225",
                "create_at" => date('d/m/Y')
            ],
            [
                "title" => "Grande incêndio atinge área de preservação ambiental",
                "description" => "Um grande incêndio atingiu uma área de preservação ambiental no estado do Amazonas.",
                "image" => "https://picsum.photos/419/225",
                "create_at" => date('d/m/Y')
            ],
            [
                "title" => "Novo parque é inaugurado na cidade",
                "description" => "A prefeitura inaugura o novo parque da cidade, com diversas atrações para todas as idades.",
                "image" => "https://picsum.photos/419/225",
                "create_at" => date('d/m/Y')
            ],
            [
                "title" => "Acidente grave na rodovia",
                "description" => "Um acidente envolvendo três veículos deixou quatro pessoas feridas na rodovia BR-101.",
                "image" => "https://picsum.photos/419/225",
                "create_at" => date('d/m/Y')
            ],
        ];
    }
}
