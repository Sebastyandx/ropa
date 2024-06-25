<?php

namespace App\Controller;

use App\Entity\Imagen;
use App\Entity\Productos;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Validator\Constraints\Length;

class ImagenController extends AbstractController

{ private $em;

    public function __construct(EntityManagerInterface $em)
    {
        {$this->em = $em;}
    }
    #[Route('/modelos', name: 'app_imagen')]
    public function index(SessionInterface $session): Response
    {
        $imagenes = $this->em->getRepository(Imagen::class)->traerImagenes();
        $session->set('ropa','');
        $user  = $this->getUser();
        return $this->render('imagen/index.html.twig', ['imagenes' => $imagenes,'user'=>$user]);
    }


    #[Route('/modelos/{id}', name: 'imagen_ropa')]
     public function getRopaByImagen($id):JsonResponse{
            $productos = $this->em->getRepository(Productos::class)->traerRopa($id);
            $arrayRopa = [];
            $array2= [];
            for ($i=0;$i< count($productos);$i++){
                array_push($array2,$productos[$i]->getId());
                array_push($array2,$productos[$i]->getNombre());
                array_push($array2,$productos[$i]->getPrecio());
                array_push($array2,$productos[$i]->getImagen());

                array_push($arrayRopa,$array2);
                $array2= [];
            }
            return new JsonResponse($arrayRopa);
        
     }   

     #[Route('/scroll', name: 'scroll_imagen')]
     public function scroll(Request $request): Response
     {
         $offset = $request->request->get('offset');
         $limit = $request->request->get('limit', 6);
         $imagenes = $this->em->getRepository(Imagen::class)->traerImagenesConScroll($offset, $limit);
         $arrayRopa = [];
         $array2= [];
         for ($i=0;$i< count($imagenes);$i++){
             array_push($array2,$imagenes[$i]->getId());
             array_push($array2,$imagenes[$i]->getUrl());

             array_push($arrayRopa,$array2);
             $array2= [];
         }
     
         return new JsonResponse([
             'imagenes' => $arrayRopa,
         ]);
     
    }

 
}
