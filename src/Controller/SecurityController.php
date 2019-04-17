<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController {

  /**
   * @var UserRepository
   */
  private $repository;

    /**
   * @var ObjectManager
   */
  private $em;

  public function __construct(
    ObjectManager $em,
    UserRepository $repository
  )
  {
    $this->em = $em;
    $this->repository = $repository;
  }

  /**
   * @return Response
   * @param UserRepository $repository
   */
  public function login(AuthenticationUtils $authUtils): Response
  {
    $lastUsername = $authUtils->getLastUsername();
    $error = $authUtils->getLastAuthenticationError();

    return $this->render("security/login.html.twig", [
      'last_username' => $lastUsername,
      'error' => $error
    ]);
  }

}