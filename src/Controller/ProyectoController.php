<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;


class ProyectoController extends AbstractController{

    
    #[Route('/', name: 'main')]
    public function home():Response{
        return $this->render('base.html.twig');
    }
}

?>