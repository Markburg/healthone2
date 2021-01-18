<?php


namespace App\Controller;


use App\Entity\Medicijn;
use App\Entity\Patient;
use App\Entity\Recept;
use App\Form\AfdelingType;
use App\Form\MedicijnType;
use App\Form\PatientType;
use App\Form\ReceptType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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
    /**
     * @Route ("/patient/new"), name="patient_new")
     */
    public function newPatient(Request $request): Response
    {
        $form = $this->createForm(PatientType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $patient = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($patient);
            $em->flush();
            $this->addFlash('succes','Patient gemaakt!');

            return $this->redirectToRoute('app_home_patienten');
        }
        return $this->render('admin/new_patient.html.twig', ['patientForm' => $form->createView(),
        ]);
    }
    /** *@Route("/patient/{id}/edit", name="patient_edit") */
    public function editPatient(Patient $patient,Request $request, EntityManagerInterface $em) {
        $form = $this->createForm(PatientType::class, $patient);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $em->persist($patient);
            $em->flush();
            $this->addFlash('succes','Patient Update!');

            return $this->redirectToRoute('app_home_patienten',[
                'id'=>$patient->getId(),
            ]);
        }

        return $this->render('admin/edit_patient.html.twig', ['patientForm'=>$form->createView()]);
    }
    /** * @Route("/patient/delete/{id}", name="delete_patient") */
    public function deletePatient($id)
    {
        $em = $this->getDoctrine()->getManager();
        if (!$id)
        {
            throw $this->createNotFoundException('No ID found');
        }
        $patient = $em->getRepository(Patient::class)->Find($id);

        if($patient != null)
        {
            $em->remove($patient);
            $em->flush();
            $this->addFlash('succes','patient is verwijderd!');
        }

        return $this->redirectToRoute('app_home_patienten');
    }
    /**
     * @Route ("/recept/new"), name="recept_new")
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

            return $this->redirectToRoute('app_home_recepten');
        }
        return $this->render('admin/new_recept.html.twig', ['receptForm' => $form->createView(),
        ]);
    }
    /** *@Route("/recept/{id}/edit", name="recept_edit") */
    public function editRecept(Recept $recept,Request $request, EntityManagerInterface $em) {
        $form = $this->createForm(ReceptType::class, $recept);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $em->persist($recept);
            $em->flush();
            $this->addFlash('succes','Recept Update!');

            return $this->redirectToRoute('app_home_recepten',[
                'id'=>$recept->getId(),
            ]);
        }

        return $this->render('admin/edit_recept.html.twig', ['receptForm'=>$form->createView()]);
    }
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

        return $this->redirectToRoute('app_home_recepten');
    }

}