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
    public function updateMesa(Request $request,int $id, MesaRepository $mesaRepository):JsonResponse
    {
        //Buscamos la mesa en BD
        $mesa=$mesaRepository->find($id);
        if(!$mesa){
            return $this->json('Mesa no encontrada', 404);
        }else{
            //Añadimos los datos de la Request al Objeto Mesa
            $data=json_decode($request->getContent(), true);
            $mesa->setAncho($data['ancho']);
            $mesa->setAlto($data['alto']);
            $mesa->setX($data['x']);
            $mesa->setY($data['y']);
            $mesa->setImagen($data['imagen']);
            //guardamos en BD
            $mesaRepository->save($mesa, true);
            return $this->json($data, 200);
        }
    }

    #[Route('/api/mesa/{id}', name:'borra_mesa', methods:['DELETE'])]
    public function deleteMesa(Request $request,MesaRepository $mesaRepository, int $id):JsonResponse
    {
        //Buscamos la mesa en BD
        $mesa=$mesaRepository->find($id);
        if($mesa==null){
            return $this->json('Mesa no encontrada', 404);
        }else{
            $mesaRepository->remove($mesa, true);
            return $this->json('Mesa borrada', 200);
        }
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


}
