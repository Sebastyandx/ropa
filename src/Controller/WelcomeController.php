<?php
namespace App\Controller;

use App\Entity\Productos;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;

class WelcomeController extends AbstractController{
    private $em;
    public function __construct(EntityManagerInterface $em)
    {
        {$this->em = $em;}
    }
    #[Route('/welcome', name:'welcome_blackrony')]
    public function welcome():Response{
        $productos = $this->em->getRepository(Productos::class)->traer6productos();
        return $this->render('Welcome/Welcome.html.twig',['destacados'=>$productos]);
    }
}   