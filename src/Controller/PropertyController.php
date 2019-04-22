<?php
/**
 * PropertyController File Doc Comment
 * PHP version 7.3
 * 
 * @category Class
 * @package  Estate_Agency
 * @author   LauraDev <contact@lauradev.fr>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     ""
 */

namespace App\Controller;

use App\Entity\Contact;
use App\Entity\Property;
use App\Repository\PropertyRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\PropertySearch;
use App\Form\PropertySearchType;
use App\Form\ContactType;
use App\Services\ContactService;

/**
 * PropertyController Class Doc Comment
 *
 * @category Class
 * @package  Estate_Agency
 * @author   LauraDev <contact@lauradev.fr>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     ""
 */
class PropertyController extends AbstractController
{

    /**
     * Action displaying a list of all "not sold" properties
     * 
     * @param PaginatorInterface $paginator  Knp Paginator Bunble
     * @param Request            $request    represents an HTTP request
     * @param PropertyRepository $repository Property Repository
     * 
     * @return Response
     */
    public function list(PaginatorInterface $paginator, Request $request, PropertyRepository $repository): Response
    {
        
        $search = new PropertySearch();

        $form = $this->createForm(PropertySearchType::class, $search);
        $form->handleRequest($request);
        
        $properties = $paginator->paginate(
            $repository->findAllNotSoldQuery($search),
            $request->query->getInt('page', 1),
            12
        );
        

        return $this->render(
            'pages/property/list.html.twig',
            [
                'properties' => $properties,
                'active_page' => 'properties',
                'form' => $form->createView()
            ]
        );
    }

    /**
     * Action displaying the detail of a property
     * 
     * @param Property $property to display
     * @param string   $slug     of the property
     * 
     * @return Response
     */
    public function detail(
        ContactService $contactService,
        Property $property,
        Request $request,
        string $slug
    ): Response
    {
        if ($property->getSlug() !== $slug) {
            return $this->redirectToRoute(
                'property.detail',
                [
                    'id' => $property->getId(),
                    'slug' => $property->getSlug()
                ],
                301
            );
        }

        $contact = new Contact();
        $contact->setProperty($property);
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $contactService->sendMessage($contact);
            $this->addFlash('success', 'Votre message a bien ete envoye');
            // return $this->redirectToRoute(
            //     'property.detail',
            //     [
            //         'id' => $property->getId(),
            //         'slug' => $property->getSlug()
            //     ]
            // );
        }

        return $this->render(
            'pages/property/detail.html.twig',
            [
                'property' => $property,
                'active_page' => 'properties',
                'form' => $form->createView()
            ]
        );
    }
}
