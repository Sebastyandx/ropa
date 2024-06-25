<?php

namespace App\Controller;

use App\Entity\Productos;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProductoController extends AbstractController
{ private $em;
    public function __construct(EntityManagerInterface $em)
    {
        {$this->em = $em;}
    }
    #[Route('/producto/detalles', name: 'app_producto')]
    public function index(): Response
    {

        $productos = $this->em->getRepository(Productos::class)->findAll15();
        return $this->render('producto/index.html.twig', ['productos15' => $productos]);
    }


    
}
