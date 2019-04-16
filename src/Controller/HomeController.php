<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\PropertyRepository;

class HomeController extends AbstractController {

  /**
   * @var PropertyRepository
   */
  private $repository;

  /**
   * @return Response
   * @param PropertyRepository $repository
   */
  public function index(PropertyRepository $repository): Response
  {
    $this->repository = $repository;
    $latest = $this->repository->findLatest();

    return $this->render("pages/home.html.twig", [
      'latest' => $latest
    ]);
  }

}