<?php


namespace App\Controller;


use App\Entity\Medicijn;
use App\Form\AfdelingType;
use App\Form\MedicijnType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /** *@Route("/medicijn/new", name="medicijn_new") */
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

            return $this->redirectToRoute('medicijnen');
        }

        return $this->render('admin/new_medicijn.html.twig', ['medicijnForm'=>$form->createView()]);
    }
    /** *@Route("/medicijn/{id}/edit", name="medicijn_edit") */
    public function editMedicijn(Medicijn $medicijn,Request $request, EntityManagerInterface $em) {
        $form = $this->createForm(MedicijnType::class, $medicijn);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $em->persist($medicijn);
            $em->flush();
            $this->addFlash('succes','Medicijn Update!');

            return $this->redirectToRoute('medicijnen',[
                'id'=>$medicijn->getId(),
            ]);
        }

        return $this->render('admin/edit_medicijn.html.twig', ['medicijnForm'=>$form->createView()]);
    }
    /** * @Route("/medicijnen/delete/{id}", name="delete_medicijn") */
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

        return $this->redirectToRoute('medicijnen');
    }

    /** *@Route("/afdeling/new", name="afdeling_new") */
    public function newAfdeling(Request $request){
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