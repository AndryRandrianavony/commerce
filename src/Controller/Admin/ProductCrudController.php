<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ProductCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Product::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
       /*return [
            IdField::new('id'),
            TextField::new('name'),
            TextEditorField::new('description'),
        ];*/
        
        return [
            TextField::new('name'),
            SlugField::new('slug')->setTargetFieldName('name'),// name no atao slug eto
            //ImageField::new('illustration')->setUploadDir('public/uploads/'),/*->setFormTypeOptions(['mapped'=>false, 'required'=>false]),*/
            ImageField::new('illustration')
                ->setUploadDir('public/uploads/')
                ->setUpLoadedFileNamePattern('[randomhash].[extension]')
                ->setRequired(false),
            TextField::new('subtitle'),
            TextareaField::new('description'),
            MoneyField::new('price')->setCurrency('EUR'), // Euro
            AssociationField::new('category'), //select
            //CollectionField::new('category'),// mitombo mitombo
        ];
    }
    
}
