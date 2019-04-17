<?php
/**
 * SecurityController File Doc Comment
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
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

/**
 * SecurityController Class Doc Comment
 * 
 * @category Class
 * @package  Estate_Agency
 * @author   LauraDev <contact@lauradev.fr>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     ""
 */
class SecurityController extends AbstractController
{

    /**
     * Login Action
     * 
     * @param AuthenticationUtils $authUtils get last error/username
     * 
     * @return Response
     */
    public function login(AuthenticationUtils $authUtils): Response
    {
        $lastUsername = $authUtils->getLastUsername();
        $error = $authUtils->getLastAuthenticationError();

        return $this->render(
            "security/login.html.twig", [
                'last_username' => $lastUsername,
                'error' => $error
            ]
        );
    }
}
