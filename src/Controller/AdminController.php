<?php


namespace App\Controller;


use App\Form\AfdelingType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /** *@Route("/afdeling/new", name="afdeling_new") */
    public function newAction(Request $request){
        $form = $this->createForm(AfdelingType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $afdeling = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($afdeling);
            $em->flush();
            $this->addFlash('succes','Afdeling gemaakt!');

            return $this->redirectToRoute('app_homepage');
        }

        return $this->render('admin/new_afdeling.html.twig', ['afdelingForm'=>$form->createView()]);
    }

}