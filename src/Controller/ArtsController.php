<?php

namespace App\Controller;

use App\Entity\Medicijn;
use App\Entity\Patient;
use App\Entity\Recept;
use App\Form\MedicijnType;
use App\Form\PatientType;
use App\Form\ReceptType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
    /**
     * @Route ("/arts/recepten"), name="arts_recepten")
     * @return Response
     */
    public function receptenAction(): Response
    {
        $recepten = $this->getDoctrine()->getRepository(Recept::class)->findAll();
        return $this->render('arts/recepten.html.twig', [
            'recepten' => $recepten,
        ]);
    }
    /**
     * @Route ("/arts/recept/new"), name="arts_recept_new")
     */
    public function newRecept(Request $request): Response
    {
        $form = $this->createForm(ReceptType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $recept = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($recept);
            $em->flush();
            $this->addFlash('succes','Recept gemaakt!');

            return $this->redirectToRoute('app_arts_recepten');
        }
        return $this->render('arts/new_recept.html.twig', ['receptForm' => $form->createView(),
        ]);
    }
    /** *@Route("/arts/recept/{id}/edit", name="arts_recept_edit") */
    public function editRecept(Recept $recept,Request $request, EntityManagerInterface $em) {
        $form = $this->createForm(ReceptType::class, $recept);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $em->persist($recept);
            $em->flush();
            $this->addFlash('succes','Recept Update!');

            return $this->redirectToRoute('app_arts_recepten',[
                'id'=>$recept->getId(),
            ]);
        }

        return $this->render('arts/edit_recept.html.twig', ['receptForm'=>$form->createView()]);
    }
    /** *@Route("/arts/recept/delete", name="arts_recept_delete") */
    public function deleteRecept($id)
    {
        $em = $this->getDoctrine()->getManager();
        if (!$id)
        {
            throw $this->createNotFoundException('No ID found');
        }
        $recept = $em->getRepository(Recept::class)->Find($id);

        if($recept != null)
        {
            $em->remove($recept);
            $em->flush();
            $this->addFlash('succes','recept is verwijderd!');
        }

        return $this->redirectToRoute('app_arts_recepten');
    }
}
