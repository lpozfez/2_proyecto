<?php

namespace App\Controller;

use App\Repository\JuegoRepository;
use App\Entity\Juego;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\orm\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

#[Route('/api', name: 'app_api_juegos')]
class ApiJuegosController extends AbstractController
{
    #[Route('/juego', name:'api_add_juego', methods:['POST'])]
    public function addJuego(Request $request, JuegoRepository $juegoBd) :JsonResponse
    {
        //Cogemos los datos de la Request
        $data=json_decode($request->getContent(), true);
        $nombre=$data['nombre'];
        $editorial=$data['editorial'];
        $minJugadores=$data['minJugadores'];
        $maxJugadores=$data['maxJugadores'];
        $anchoTablero=$data['anchoTablero'];
        $altoTablero=$data['altoTablero'];
        $imagen=$data['imagen'];
        //Creamos el objeto $juego
        $juego=new Juego();

        $juegoComprobar=$juegoBd->findOneBy(['nombre' => $nombre]);
        if(!$juegoComprobar){
            //Añadimos los datos de la Request al nuevo objeto
            $juego->setNombre($nombre);
            $juego->setEditorial($editorial);
            $juego->setMinJugadores($minJugadores);
            $juego->setMaxJugadores($maxJugadores);
            $juego->setAnchoTablero($anchoTablero);
            $juego->setAltoTablero($altoTablero);
            $juego->setImagen($imagen);
            //Grabamos en Base de datos
            $juegoBd->save($juego,true);
            //devolvemos el objeto creado en BD
            return $this->json($data,$status=201);
        }else{
            return $this->json('El juego ya existe', 404);
        }
    }

    #[Route('/juego/{id}', name: 'get_juego', methods:['GET', 'HEAD'])]
    public function getJuego(JuegoRepository $juegoBd,int $id): JsonResponse
    {
       $juego=$juegoBd->find($id);
       if(!$juego){
            return $this->json('Juego no encontrado', 404);
        }else{
            $datos[] = $juego->toArray();
            return $this->json($datos, $status=200);
        }
    }

    #[Route("/juego", name:"todos_juegos", methods:['GET', 'HEAD'])]
    public function getJuegos(JuegoRepository $juegoBd): JsonResponse 
    { 
        $juegos = $juegoBd->findAll(); 
        $datos = []; 
    
        foreach ($juegos as $juego) { 
            $datos[] = $juego->toArray();
        } 
    
        return $this->json($datos, $status=200); 
    }

    #[Route('/juego/{id}', name:'modifica_juego', methods:['PUT'])]
    public function updateJuego(Request $request,int $id, JuegoRepository $juegoBd):JsonResponse
    {
        //Buscamos la juego en BD
        $juego=$juegoBd->find($id);
        if(!$juego){
            return $this->json('Juego no encontrado', 404);
        }else{
            //Añadimos los datos de la Request al Objeto juego
            $data=json_decode($request->getContent(), true);
            $juego->setNombre($data['nombre']);
            $juego->setEditorial($data['editorial']);
            $juego->setMinJugadores($data['minJugadores']);
            $juego->setMaxJugadores($data['maxJugadores']);
            $juego->setAnchoTablero($data['anchoTablero']);
            $juego->setAltoTablero($data['altoTablero']);
            $juego->setImagen($data['imagen']);
            //guardamos en BD
            $juegoBd->save($juego, true);
            return $this->json($data, 200);
        }
    }

    #[Route('/juego/{id}', name:'borra_juego', methods:['DELETE'])]
    public function deleteJuego(Request $request,JuegoRepository $juegoBd, int $id):JsonResponse
    {
        //Buscamos la juego en BD
        $juego=$juegoBd->find($id);
        if($juego==null){
            return $this->json('Juego no encontrado', 404);
        }else{
            $juegoBd->remove($juego, true);
            return $this->json('Juego borrado', 200);
        }
    }
}
