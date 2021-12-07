<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ChangePasswordController extends AbstractController
{
    /**
     * @Route("/change/password", name="change_password")
     */
    public function index()
    {
        return $this->render('change_password/index.html.twig', [
            'controller_name' => 'ChangePasswordController',
        ]);
    }
}
