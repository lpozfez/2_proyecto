<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;



class ProyectoController extends AbstractController{

    
    #[Route('/', name: 'main')]
    public function home(AuthenticationUtils $authenticationUtils):Response{
        
        if($authenticationUtils->getLastUsername()){
            $user=$authenticationUtils->getLastUsername();
        }else{
            $user=null;
        }
        return $this->render('base.html.twig',[
            'user' => $user,
        ]);
    }
}

?>