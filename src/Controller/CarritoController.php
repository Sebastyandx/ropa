<?php

namespace App\Controller;

use App\Entity\ItemCarrito;
use App\Entity\OrdenCompra;
use App\Entity\Productos;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CarritoController extends AbstractController
{
    private $em;
    public function __construct(EntityManagerInterface $em)
    {
        {$this->em = $em;}
    }
    #[Route('/carrito', name: 'app_carrito')]
    public function index(): Response
    {
        /* TRAIGO EL ID DEL USUARIO LOGEADO */
        $userId = $this->getUser()->getId();
        /* CON ESE ID, BUSCO LA ORDENES DE COMPRAS DONDE TENGAN ESE ID DE USUARIO */
        $ordenes = $this->em->getRepository(OrdenCompra::class)->traerOrdenCompras($userId);
        /* COLOCO EL ID DE LAS ORDENES EN UN ARRAY */
        $arrayOrdenId = [];
        foreach ($ordenes as $orden){
            array_push($arrayOrdenId,$orden->getId());
        }
        /* dd($arrayOrdenId); */
        /* CON EL ID DE LAS ORDENES TRAIGO LOS PRODUCTOS QUE TENGAN ESE ID COMO ORDEN */
        $productos = $this->em->getRepository(ItemCarrito::class)->traerProductos(1);
        $arrayProductoId = [];
        foreach ($productos as $producto){
           $productoId = $producto->getProductoId();
           $traerProductoID = $this->em->getRepository(Productos::class)->traerRopaCarrito($productoId);
           
           array_push($arrayProductoId,$traerProductoID);
        }

        return $this->render('carrito/index.html.twig', [ 'ordenes'=>$ordenes,'productos'=>$productos ]);
    }


       /**
     * @Route("/carrito", name="ver_carrito")
     */
    #[Route('/carrito2', name: 'ver_carrito')]
    public function verCarrito(SessionInterface $session)
    {
        $carrito = $session->get('carrito', []);

        return $this->render('carrito/ver.html.twig', [
            'carrito' => $carrito
        ]);
    }

    /**
     * @Route("/carrito/agregar/{id}", name="agregar_al_carrito")
     */
    #[Route('/carrito/agregar/{id}', name: 'agregar_al_carrito')]
    public function agregarAlCarrito($id, SessionInterface $session)
    {
        $producto =$this->em->getRepository(Productos::class)->find($id);
        if (!$producto) {
            throw $this->createNotFoundException('El producto no existe');
        }

        $carrito = $session->get('carrito', []);

        if (!isset($carrito[$id])) {
            $carrito[$id] = [
                'producto' => $producto,
                'cantidad' => 0
            ];
        }

        $carrito[$id]['cantidad']++;

        $session->set('carrito', $carrito);

        return $this->redirectToRoute('ver_carrito');
    }

    /**
     * @Route("/carrito/eliminar/{id}", name="eliminar_del_carrito")
     */
    #[Route('/carrito/eliminar/{id}', name:"eliminar_del_carrito")]
    public function eliminarDelCarrito($id, SessionInterface $session)
    {
        $carrito = $session->get('carrito', []);

        if (isset($carrito[$id])) {
            unset($carrito[$id]);
        }

        $session->set('carrito', $carrito);

        return $this->redirectToRoute('ver_carrito');
    }

    /**
     * @Route("/carrito/vaciar", name="vaciar_carrito")
     */
    #[Route('/carrito/vaciar', name:"vaciar_carrito")]
     public function vaciarCarrito(SessionInterface $session)
    {
        $session->set('carrito', []);

        return $this->redirectToRoute('ver_carrito');
    }
}
