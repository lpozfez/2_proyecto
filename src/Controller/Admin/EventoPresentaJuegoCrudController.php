<?php

namespace App\Controller\Admin;

use App\Entity\EventoPresentaJuego;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class EventoPresentaJuegoCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return EventoPresentaJuego::class;
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
