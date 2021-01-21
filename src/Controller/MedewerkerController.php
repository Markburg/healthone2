<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MedewerkerController extends AbstractController
{
    /**
     * @Route("/medewerker", name="medewerker_home")
     */
    public function index(): Response
    {
        return $this->render('medewerker/index.html.twig', [
            'controller_name' => 'MedewerkerController',
        ]);
    }
}
