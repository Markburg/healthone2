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

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin_home")
     */
    public function index(): Response
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }
    /**
     * @Route ("/admin/recepten"), name="admin_recepten")
     * @return Response
     */
    public function receptenAction(): Response
    {
        $recepten = $this->getDoctrine()->getRepository(Recept::class)->findAll();
        return $this->render('admin/recepten.html.twig', [
            'recepten' => $recepten,
        ]);
    }
    /** * @Route("/admin/medicijnen", name="admin_medicijnen") */
    public function getMedicijnen()
    {
        $medicijnen = $this->getDoctrine()->getRepository(Medicijn::class)->getMedicijnen();
        return $this->render('admin/medicijnen.html.twig', ['medicijnen' => $medicijnen]);
    }
    /** * @Route("/admin/patienten", name="admin_patienten") */
    public function getPatienten()
    {
        $patienten = $this->getDoctrine()->getRepository(Patient::class)->getPatienten();
        return $this->render('admin/patienten.html.twig', ['patienten' => $patienten]);
    }
    /** *@Route("/admin/medicijn/new", name="admin_medicijn_new") */
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

            return $this->redirectToRoute('admin_medicijnen');
        }

        return $this->render('admin/new_medicijn.html.twig', ['medicijnForm'=>$form->createView()]);
    }
    /** *@Route("/admin/medicijn/{id}/edit", name="admin_medicijn_edit") */
    public function editMedicijn(Medicijn $medicijn,Request $request, EntityManagerInterface $em) {
        $form = $this->createForm(MedicijnType::class, $medicijn);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $em->persist($medicijn);
            $em->flush();
            $this->addFlash('succes','Medicijn Update!');

            return $this->redirectToRoute('admin_medicijn_edit',[
                'id'=>$medicijn->getId(),
            ]);
        }

        return $this->render('admin/edit_medicijn.html.twig', ['medicijnForm'=>$form->createView()]);
    }
    /** * @Route("/admin/medicijnen/delete/{id}", name="admin_delete_medicijn") */
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

        return $this->redirectToRoute('admin_medicijnen');
    }
    /**
     * @Route ("/admin/patient/new"), name="admin_patient_new")
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

            return $this->redirectToRoute('admin_patienten');
        }
        return $this->render('admin/new_patient.html.twig', ['patientForm' => $form->createView(),
        ]);
    }
    /** *@Route("/admin/patient/{id}/edit", name="admin_patient_edit") */
    public function editPatient(Patient $patient,Request $request, EntityManagerInterface $em) {
        $form = $this->createForm(PatientType::class, $patient);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $em->persist($patient);
            $em->flush();
            $this->addFlash('succes','Patient Update!');

            return $this->redirectToRoute('admin_patienten',[
                'id'=>$patient->getId(),
            ]);
        }

        return $this->render('admin/edit_patient.html.twig', ['patientForm'=>$form->createView()]);
    }
    /** * @Route("/admin/patient/delete/{id}", name="admin_delete_patient") */
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

        return $this->redirectToRoute('admin_patienten');
    }
    /**
     * @Route ("/admin/recept/new"), name="admin_recept_new")
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

            return $this->redirectToRoute('admin_patienten');
        }
        return $this->render('admin/new_recept.html.twig', ['receptForm' => $form->createView(),
        ]);
    }
    /** *@Route("/admin/recept/{id}/edit", name="admin_recept_edit") */
    public function editRecept(Recept $recept,Request $request, EntityManagerInterface $em) {
        $form = $this->createForm(ReceptType::class, $recept);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $em->persist($recept);
            $em->flush();
            $this->addFlash('succes','Recept Update!');

            return $this->redirectToRoute('admin_patienten',[
                'id'=>$recept->getId(),
            ]);
        }

        return $this->render('admin/edit_recept.html.twig', ['receptForm'=>$form->createView()]);
    }
    /** *@Route("/admin/recept/delete/{id}", name="admin_recept_delete") */
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

        return $this->redirectToRoute('admin_patienten');
    }

}