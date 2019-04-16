<?php

namespace App\Controller\Admin;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\PropertyRepository;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Property;
use App\Form\PropertyType;
use Symfony\Component\HttpFoundation\Request;

class AdminPropertyController extends AbstractController {

  /**
   * @var ObjectManager
   */
  private $em;

  /**
   * @var PropertyRepository
   */
  private $repository;

  public function __construct(
    ObjectManager $em,
    PropertyRepository $repository
  )
  {
    $this->em = $em;
    $this->repository = $repository;
  }


  /**
   * @return Response
   */
  public function index(): Response
  {
    $properties = $this->repository->findAll();

    return $this->render( 'admin/property/index.html.twig', compact('properties') );
  }

    /**
   * @return Response
   */
  public function create(Request $request): Response
  {
    $property = new Property();
    $form = $this->createForm(PropertyType::class, $property);

    # Handle request 
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
      $this->em->persist($property);
      $this->em->flush();

      $this->addFlash('success', 'Le bien "' . $property->getTitle() . '" a ete cree avec succes');
      return $this->redirectToRoute('admin.property.index');
    }

    return $this->render( 'admin/property/form.html.twig', [
      'property' => $property,
      'form' => $form->createView()
    ]);
  }

  /**
   * @return Response
   */
  public function edit(Property $property, Request $request): Response // here the request to find the property using it's id is automatically done
  {
    $form = $this->createForm(PropertyType::class, $property);

    # Handle request 
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
      $this->em->flush();

      $this->addFlash('success', 'Le bien "' . $property->getTitle() . '" a ete modifie avec succes');
      return $this->redirectToRoute('admin.property.index');
    }

    return $this->render( 'admin/property/form.html.twig', [
      'property' => $property,
      'form' => $form->createView()
    ]);
  }

    /**
   * @return Response
   */
  public function delete(Property $property, Request $request): Response // here the request to find the property using it's id is automatically done
  {
    if ($this->isCsrfTokenValid('delete' . $property->getId(), $request->get('_token')) )
    {
      $this->em->remove($property);
      $this->em->flush();

      $this->addFlash('success', 'Le bien "' . $property->getTitle() . '" a ete supprime avec succes');
    }
    return $this->redirectToRoute('admin.property.index');
  }

}