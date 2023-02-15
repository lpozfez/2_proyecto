<?php

namespace App\Controller\Admin;

use App\Entity\Invitacion;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class InvitacionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Invitacion::class;
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
