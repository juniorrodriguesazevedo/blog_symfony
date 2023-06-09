<?php

namespace App\Command;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:add-categories',
    description: 'Adicionar categorias de notícias',
)]
class AddCategoriesCommand extends Command
{
    public function __construct(
        private CategoryRepository $categoryRepository,
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $categories = $this->categoryRepository->findAll();

        if (count($categories) > 0) {
            $io->warning('As categorias já existem');
            exit;
        }

        $names = [
            'Mundo',
            'Brasil',
            'Tecnologia',
            'Design',
            'Cultura',
            'Negócios',
            'Política',
            'Opinião',
            'Ciência',
            'Saúde',
            'Estilo',
            'Viagens'
        ];

        foreach ($names as $name) {
            $category = new Category();
            $category->setName($name);
            $this->categoryRepository->save($category, true);
        }

        $io->success('Categorias criadas com sucesso!');

        return Command::SUCCESS;
    }
}
