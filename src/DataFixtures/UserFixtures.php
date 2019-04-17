<?php
/**
 * UserFixtures File Doc Comment
 * PHP version 7.3
 * 
 * @category Class
 * @package  Estate_Agency
 * @author   LauraDev <contact@lauradev.fr>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     ""
 */

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\User;

/**
 * UserFixtures Class Doc Comment
 * 
 * @category Class
 * @package  Estate_Agency
 * @author   LauraDev <contact@lauradev.fr>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     ""
 */
class UserFixtures extends Fixture
{
    /**
     * UserPasswordEncoderInterface
     * 
     * @var UserPasswordEncoderInterface $_passwordEncoder
     */
    private $_passwordEncoder;

    /**
     * Constructor
     *
     * @param UserPasswordEncoderInterface $_passwordEncoder Password Encoder
     */
    public function __construct(UserPasswordEncoderInterface $_passwordEncoder)
    {
        $this->_passwordEncoder = $_passwordEncoder;
    }

    /**
     * Fixture loading 100 properties using faker
     * 
     * @param ObjectManager $manager ObjectManager
     */
    public function load(ObjectManager $manager)
    {        
        $user = new User();
        $user->setUsername('demo');
        $user->setPassword(
            $this->_passwordEncoder->encodePassword(
                $user,
                'demo'
            )
        );
        
        $manager->persist($user);
        $manager->flush();
    }
}
