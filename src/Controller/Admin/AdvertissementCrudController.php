<?php

namespace App\Controller\Admin;

use App\Entity\Advertissement;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class AdvertissementCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Advertissement::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
