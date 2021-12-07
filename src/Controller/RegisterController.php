<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegisterType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegisterController extends AbstractController
{
    /**
     * @Route("/inscription", name="register")
     */
    public function index(Request $request,EntityManagerInterface $manager,UserPasswordEncoderInterface $encoder)
    {
        $user = new User();

        $form = $this->createForm(RegisterType::class,$user); 

        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
            //dd($user);
            $user = $form->getData();// maka ny donnée rehetra ao @ formulaire
            //dd($user);
            //$password = $user->getPassword();
            //dd($password);
            $hash = $encoder->encodePassword($user,$user->getPassword());
            //dd($hash);
            $user->setPassword($hash);
            $manager->persist($user);
            $manager->flush();
        }
        
        return $this->render('register/index.html.twig',[
            'form'=>$form->createView()
           
        ]);
    }
}
