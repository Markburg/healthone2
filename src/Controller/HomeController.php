<?php

namespace App\Controller;

use App\Entity\Afdeling;
use App\Entity\Medicijn;
use App\Entity\User;
use Psr\Log\LoggerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="app_homepage")
     */
    public function homepage()
    {
        return $this->render('article/homepage.html.twig');
    }

    /** * @Route("/create", name="create") */
    public function createAction() {
        $entityManager = $this->getDoctrine()->getManager();
        $afdeling = new Afdeling();
        $afdeling->setNaam("Inkoop");
        $afdeling->setLocatie("Amsterdam");

        //In tabel opslaan
        $entityManager->persist($afdeling);
        //SQL uitvoeren
        $entityManager->flush();
        return new Response('Afdeling is opgelagen met id'.$afdeling->getId());
    }
    /** * @Route("/update/{userId}", name="update") */
    public function updateAction($userId) {
    $entityManager=$this->getDoctrine()->getManager();
    $user=$entityManager->getRepository(User::class)->find($userId);
    if(!$userId) {
        throw $this->createNotFoundException("Geen user gevonden");
    }
    $afdeling=$entityManager->getRepository(Afdeling::class)->findOneBy(['naam'=>'Inkoop']);
    $user->setAfdeling($afdeling); $entityManager->flush();
    return new Response("user gekoppeld aan afdeling Inkoop");
    }
    /** * @Route("/getnoafdeling", name="no_afdeling") */
    public function getNoAfdeling() {
        $users = $this->getDoctrine()->getRepository(User::class)->getNoAfdeling();
        return $this->render('article/geenAfdeling.html.twig', ['users'=>$users]);
    }
}
