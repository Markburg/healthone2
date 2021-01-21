<?php

namespace App\Controller;

use App\Entity\Medicijn;
use App\Form\MedicijnType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
    /** * @Route("/medewerker/medicijnen", name="medewerker_medicijnen") */
    public function getMedicijnen()
    {
        $medicijnen = $this->getDoctrine()->getRepository(Medicijn::class)->getMedicijnen();
        return $this->render('medewerker/medicijnen.html.twig', ['medicijnen' => $medicijnen]);
    }
    /** *@Route("/medewerker/medicijn/new", name="medewerker_medicijn_new") */
    public function newMedicijn(Request $request){
        $form = $this->createForm(MedicijnType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $medicijn = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($medicijn);
            $em->flush();
            $this->addFlash('succes','Medicijn gemaakt!');

            return $this->redirectToRoute('medewerker_medicijnen');
        }

        return $this->render('medewerker/new_medicijn.html.twig', ['medicijnForm'=>$form->createView()]);
    }
    /** *@Route("/medewerker/medicijn/{id}/edit", name="medewerker_medicijn_edit") */
    public function editMedicijn(Medicijn $medicijn,Request $request, EntityManagerInterface $em) {
        $form = $this->createForm(MedicijnType::class, $medicijn);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $em->persist($medicijn);
            $em->flush();
            $this->addFlash('succes','Medicijn Update!');

            return $this->redirectToRoute('medewerker_medicijnen',[
                'id'=>$medicijn->getId(),
            ]);
        }

        return $this->render('medewerker/edit_medicijn.html.twig', ['medicijnForm'=>$form->createView()]);
    }
    /** * @Route("/medewerker/medicijnen/delete/{id}", name="medewerker_delete_medicijn") */
    public function deleteMedicijn($id)
    {
        $em = $this->getDoctrine()->getManager();
        if (!$id)
        {
            throw $this->createNotFoundException('No ID found');
        }
        $medicijn = $em->getRepository(Medicijn::class)->Find($id);

        if($medicijn != null)
        {
            $em->remove($medicijn);
            $em->flush();
            $this->addFlash('succes','Medicijn is verwijderd!');
        }

        return $this->redirectToRoute('medewerker_medicijnen');
    }
}
