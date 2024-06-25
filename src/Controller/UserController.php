<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Constraints\Date;

class UserController extends AbstractController
{
    private $em;
    public function __construct(EntityManagerInterface $em)
    {
     $this->em = $em;   
    }
    #[Route('/registro', name: 'UserRegistration')]
    public function UserRegistration(Request $request,UserPasswordHasherInterface $passwordHasher): Response {
        $user = new User();
        $registration_form = $this->createForm(UserType::class, $user);
        $registration_form->handleRequest($request);
      if(  $registration_form->isSubmitted() && $registration_form->isValid()){
            $plaintexPassword  = $registration_form->get('password')->getData();
            $hashedPassword = $passwordHasher->hashPassword(
                $user, $plaintexPassword
            );
            $dateString = date('Y-m-d');
            $dataObj = new DateTime($dateString);
            $user->setPassword($hashedPassword);
            $user->setRoles(['ROLE_USER']);
            $user->setFechaRegistro($dataObj);
            $this->em->persist($user);
            $this->em->flush();
            return $this->redirectToRoute('app_imagen');
        }
        return $this->render('user/index.html.twig',[
            'registration_form' => $registration_form->createView()
        ]);
    }
}
