<?php

namespace App\Controller\Admin;

use App\Entity\News;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;

class NewsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return News::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Notícia')
            ->setEntityLabelInPlural('Notícias')
            ->setPageTitle('index', 'Gerenciamento de notícias')
            ->setPaginatorPageSize(10);
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->setFormTypeOption('disabled', 'disabled'),
            AssociationField::new('category')->setFormTypeOptions(
                ['choice_label' => 'name', 'choice_value' => 'id']
            )->setLabel('Categoria'),
            TextField::new('title')->setLabel('Título'),
            TextField::new('image')->setLabel('URL da imagem'),
            TextareaField::new('description')->hideOnIndex()->setLabel('Descrição'),
            TextareaField::new('content')->hideOnIndex()->setLabel('Conteúdo'),
            DateTimeField::new('createAt')->setLabel('Criada em')->setFormTypeOption('disabled', 'disabled')->setFormat('dd/MM/Y')
        ];
    }
}
