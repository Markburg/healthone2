<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArtsController extends AbstractController
{
    /**
     * @Route("/arts", name="arts_home")
     */
    public function index(): Response
    {
        return $this->render('arts/index.html.twig', [
            'controller_name' => 'ArtsController',
        ]);
    }
}
