<?php
/**
 * HomeController File Doc Comment
 * PHP version 7.3
 * 
 * @category Class
 * @package  Estate_Agency
 * @author   LauraDev <contact@lauradev.fr>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     ""
 */

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\PropertyRepository;

/**
 * HomeController Class Doc Comment
 * 
 * @category Class
 * @package  Estate_Agency
 * @author   LauraDev <contact@lauradev.fr>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     ""
 */
class HomeController extends AbstractController
{
    /**
     * Action returning the site Index
     * 
     * @param PropertyRepository $repository Property Repository
     * 
     * @return Response
     */
    public function index(PropertyRepository $repository): Response
    {
        $latest = $repository->findLatest();

        return $this->render(
            "pages/home.html.twig", [
                'latest' => $latest
            ]
        );
    }
}
