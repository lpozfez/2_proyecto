<?php

namespace App\Controller;

use App\Repository\UserRepository;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\orm\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;


#[Route('/api', name: 'api_user')]
class ApiUserController extends AbstractController
{

    #[Route('/user', name:'api_add_user', methods:['POST'])]
    public function addUser(Request $request, UserRepository $userBd) :JsonResponse
    {
        //Cogemos los datos de la Request
        $data=json_decode($request->getContent(), true);
        $email=$data['email'];
        $roles=$data['roles'];
        $password=$data['password'];
        $nombre=$data['nombre'];
        $apellidos=$data['apellidos'];
        $telegram=$data['telegram'];
        $puntos=$data['puntos'];
        //Creamos el objeto $user
        $user=new User();

        $usuComprobar=$userBd->findOneBy(['email' => $email]);
        if(!$usuComprobar){
            //Añadimos los datos de la Request al nuevo objeto
            $user->setEmail($email);
            $user->setRoles($roles);
            $user->setPassword($password);
            $user->setNombre($nombre);
            $user->setApellidos($apellidos);
            $user->setTelegram($telegram);
            $user->setPuntos($puntos);
            //Grabamos en Base de datos
            $userBd->save($user,true);
            //devolvemos el objeto creado en BD
            return $this->json($data,$status=201);
        }else{
            return $this->json('El usuario ya existe', 404);
        }
    }

    #[Route('/user/{id}', name: 'get_usuario', methods:['GET', 'HEAD'])]
    public function getUsuario(UserRepository $userBd,int $id): JsonResponse
    {
       $user=$userBd->find($id);
       if(!$user){
            return $this->json('Usuario no encontrado', 404);
        }else{
            $datos[] = $user->toArray();
            return $this->json($datos, $status=200);
        }
    }

    #[Route("/user", name:"todos_usuarios", methods:['GET', 'HEAD'])]
    public function getusers(UserRepository $userBd): JsonResponse 
    { 
        $users = $userBd->findAll(); 
        $datos = []; 
    
        foreach ($users as $user) { 
            $datos[] = $user->toArray();
        } 
    
        return $this->json($datos, $status=200); 
    }

    #[Route('/user/{id}', name:'modifica_user', methods:['PUT'])]
    public function updateUser(Request $request,int $id, UserRepository $userBd):JsonResponse
    {
        //Buscamos la user en BD
        $user=$userBd->find($id);
        if(!$user){
            return $this->json('Usuario no encontrado', 404);
        }else{
            //Añadimos los datos de la Request al Objeto user
            $data=json_decode($request->getContent(), true);
            $user->setEmail($data['email']);
            $user->setRoles($data['roles']);
            $user->setPassword($data['password']);
            $user->setNombre($data['nombre']);
            $user->setApellidos($data['apellidos']);
            $user->setTelegram($data['telegram']);
            $user->setPuntos($data['puntos']);
            //guardamos en BD
            $userBd->save($user, true);
            return $this->json($data, 200);
        }
    }

    #[Route('/user/{id}', name:'borra_user', methods:['DELETE'])]
    public function deleteuser(Request $request,UserRepository $userBd, int $id):JsonResponse
    {
        //Buscamos la user en BD
        $user=$userBd->find($id);
        if($user==null){
            return $this->json('Usuario no encontrado', 404);
        }else{
            $userBd->remove($user, true);
            return $this->json('Usuario borrado', 200);
        }
    }

   
}
