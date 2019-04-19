<?php
/**
 * AdminController File Doc Comment
 * PHP version 7.3
 * 
 * @category Class
 * @package  Estate_Agency
 * @author   LauraDev <contact@lauradev.fr>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     ""
 */

namespace App\Controller\Admin;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\PropertyRepository;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Property;
use App\Form\PropertyType;
use Symfony\Component\HttpFoundation\Request;

/**
 * AdminController Class Doc Comment
 * 
 * @category Class
 * @package  Estate_Agency
 * @author   LauraDev <contact@lauradev.fr>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     ""
 */
class AdminPropertyController extends AbstractController
{

    /**
     * Object Manager
     * 
     * @var ObjectManager
     */
    private $em;

    /**
     * Property Repository
     * 
     * @var PropertyRepository
     */
    private $repository;

    /**
     * Constructor
     *
     * @param ObjectManager      $em         ObjectManager
     * @param PropertyRepository $repository PropertyRepository
     */
    public function __construct(
        ObjectManager $em,
        PropertyRepository $repository
    ) {
        $this->em = $em;
        $this->repository = $repository;
    }


    /**
     * Index Action - display a list of all properties
     * 
     * @return Response
     */
    public function list(): Response
    {
        $properties = $this->repository->findAll();

        return $this->render(
            'admin/property/index.html.twig', compact('properties')
        );
    }

    /**
     * Create action - display a form to create a new property
     * 
     * @param Request $request represents an HTTP request
     * 
     * @return Response
     */
    public function create(Request $request): Response
    {
        $property = new Property();
        $form = $this->createForm(PropertyType::class, $property);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($property);
            $this->em->flush();

            $this->addFlash('success', 'Le bien "' . $property->getTitle() . '" a ete cree avec succes');
            return $this->redirectToRoute('admin.property.list');
        }

        return $this->render(
            'admin/property/form.html.twig', [
                'property' => $property,
                'form' => $form->createView()
            ]
        );
    }

    /**
     * Edit action - display a form to edit an existing property
     * 
     * @param Property $property property entity
     * @param Request  $request  represents an HTTP request
     * 
     * @return Response
     */
    public function edit(Property $property, Request $request): Response // here the request to find the property using it's id is automatically done
    {
        $form = $this->createForm(PropertyType::class, $property);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();

            $this->addFlash('success', 'Le bien "' . $property->getTitle() . '" a ete modifie avec succes');
            return $this->redirectToRoute('admin.property.list');
        }

        return $this->render(
            'admin/property/form.html.twig', [
                'property' => $property,
                'form' => $form->createView()
            ]
        );
    }

    /**
     * Delete action - delete a property
     * 
     * @param Property $property property entity
     * @param Request  $request  represents an HTTP request
     * 
     * @return Response
     */
    public function delete(Property $property, Request $request): Response // here the request to find the property using it's id is automatically done
    {
        if ($this->isCsrfTokenValid('delete' . $property->getId(), $request->get('_token'))) {
            $this->em->remove($property);
            $this->em->flush();

            $this->addFlash('success', 'Le bien "' . $property->getTitle() . '" a ete supprime avec succes');
        }
        return $this->redirectToRoute('admin.property.list');
    }
}
