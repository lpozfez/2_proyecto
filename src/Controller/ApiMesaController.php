<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Mesa;
use App\Form\MesasType;
use App\Repository\MesaRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\orm\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;




class ApiMesaController extends AbstractController
{

    #[Route('/api/mesa', name:'add_mesa', methods:['POST'])]
    public function addMesa(Request $request, MesaRepository $mesaBd) :JsonResponse
    {
        //Cogemos los datos de la Request
        $data=json_decode($request->getContent(), true);
        $ancho=$data['ancho'];
        $alto=$data['alto'];
        $x=$data['x'];
        $y=$data['y'];
        $imagen=$data['imagen'];
        //Creamos el objeto mesa
        $mesa=new Mesa();
        //Añadimos los datos de la Request al nuevo objeto
        $mesa->setAncho($ancho);
        $mesa->setAlto($alto);
        $mesa->setX($x);
        $mesa->setY($y);
        $mesa->setImagen($imagen);
        //Grabamos en Base de datos
        $mesaBd->save($mesa,true);
        //devolvemos el objeto creado en BD
        return $this->json($data,$status=201);
    }

    #[Route('/api/mesa/{id}', name:'modifica_mesa', methods:['PUT'])]
    public function updateMesa(int $id, MesaRepository $mesaRepository):JsonResponse
    {
           
    }

    #[Route('/api/mesa/borrar/{id}', name:'borra_mesa', methods:['DELETE'])]
    public function deleteMesa(MesaRepository $mesaRepository, int $id):JsonResponse
    {

    }

    #[Route('/api/mesa/{id}', name: 'get_mesa', methods:['GET', 'HEAD'])]
    public function getMesa(MesaRepository $mesaRepository,int $id): JsonResponse
    {
       $mesa=$mesaRepository->find($id);

       $datos[] = $mesa->toArray();

       return $this->json($datos, $status=200);
    }

    #[Route("/api/mesa", name:"todas_mesas", methods:['GET', 'HEAD'])]
    public function getMesas(MesaRepository $mesaRepository): JsonResponse 
    { 
        $mesas = $mesaRepository->findAll(); 
        $datos = []; 
    
        foreach ($mesas as $mesa) { 
            $datos[] = $mesa->toArray();
        } 
    
        return $this->json($datos, $status=200); 
    }

    // #[Route('/api/mesa', name: 'app_api_mesa')]
    // public function index(): Response
    // {
    //     return $this->render('api_mesa/index.html.twig', [
    //         'controller_name' => 'ApiMesaController',
    //     ]);
    // }


}
