<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;


class ProyectoController extends AbstractController{

    #[Route('/')]
    public function home():Response{
        return new Response("Esta es la página de inicio(futura landing page)");
    }
}

?>