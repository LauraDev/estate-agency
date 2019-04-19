<?php

namespace App\Controller\Admin;

use App\Entity\Facility;
use App\Form\FacilityType;
use App\Repository\FacilityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("admin/amenagement")
 */
class AdminFacilityController extends AbstractController
{
    /**
     * @Route("/", name="admin.facility.list", methods={"GET"})
     */
    public function list(FacilityRepository $facilityRepository): Response
    {
        return $this->render('admin/facility/list.html.twig', [
            'facilities' => $facilityRepository->findAll(),
        ]);
    }

    /**
     * @Route("/creer", name="admin.facility.create", methods={"GET","POST"})
     */
    public function create(Request $request): Response
    {
        $facility = new Facility();
        $form = $this->createForm(FacilityType::class, $facility);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($facility);
            $entityManager->flush();

            $this->addFlash('success', 'L\'amenagement "' . $facility->getName() . '" a ete cree avec succes');

            return $this->redirectToRoute('admin.facility.list');
        }

        return $this->render('admin/facility/new.html.twig', [
            'facility' => $facility,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin.facility.edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Facility $facility): Response
    {
        $form = $this->createForm(FacilityType::class, $facility);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', 'L\'amenagement "' . $facility->getName() . '" a ete modifie avec succes');

            return $this->redirectToRoute('admin.facility.list', [
                'id' => $facility->getId(),
            ]);
        }

        return $this->render('admin/facility/edit.html.twig', [
            'facility' => $facility,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin.facility.delete", methods={"DELETE"})
     */
    public function delete(Request $request, Facility $facility): Response
    {
        if ($this->isCsrfTokenValid('delete'.$facility->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($facility);
            $entityManager->flush();

            $this->addFlash('success', 'L\'amenagement "' . $facility->getName() . '" a ete supprime avec succes');
        }

        return $this->redirectToRoute('admin.facility.list');
    }
}
