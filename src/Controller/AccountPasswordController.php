<?php

namespace App\Controller;

use App\Form\ChangePasswordType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AccountPasswordController extends AbstractController
{
    /**
     * @Route("/compte/modifier-mdp", name="account_password")
     */
    public function index(Request $request,EntityManagerInterface $manager,UserPasswordEncoderInterface $encoder)
    {
        $notification = null;

        $user = $this->getUser();
        $form = $this->createForm(ChangePasswordType::class,$user); 

        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
            $old_password = $form->get('old_password')->getData();//old_password: anarany champ ao @ Form ChangePasswordType mht izay alaina direct satria tsis ifandraisany mht eto ny entité User sy ny champ 'old_password'.($user->getOld_password():ts azo atao)
            if($encoder->isPasswwordValid($user,$old_password)){// mitovy ve ny mdp ilay connecté sy ilay 'old_password' nosoratany.
                $new_password = $form->get('new_password')->getData();
                $hash = $encoder->encodePassword($user,$new_password);
                $user->setPassword($hash);

                $manager->persist($user);// na ts ilaina aza ts manin satria modif ny cas eto
                $manager->flush();

                $notification = "Votre mot de passe a bien été bien mis à jour";
            }else{
                $notification = "Votre mot de passe actuel n'est pas le bon";
            }
           
        }
        
        return $this->render('account/password.html.twig',[
            'form'=>$form->createView(),
            'notification'=>$notification
        ]);
    }
}
