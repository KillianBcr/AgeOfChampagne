<?php

namespace App\Controller\Admin;

use App\Entity\Crus;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CrusCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Crus::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }

}
