<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\PropertyRepository;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Property;

class PropertyController extends AbstractController {

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
  public function list(): Response
  {
    $properties = $this->repository->findAllNotSold();

    return $this->render('pages/property/list.html.twig', [
      'properties' => $properties,
      'active_page' => 'properties'
    ]);
  }

  /**
   * @return Response
   */
  public function detail(Property $property, string $slug): Response // here the request to find the property using it's id is automatically done
  {
    if ($property->getSlug() !== $slug)
    {
      return $this->redirectToRoute('property.detail', [
        'id' => $property->getId(),
        'slug' => $property->getSlug()
      ], 301);
    }
    return $this->render('pages/property/detail.html.twig', [
      'property' => $property,
      'active_page' => 'properties'
    ]);
  }

}