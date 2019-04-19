<?php

/**
 * PropertyType File Doc Comment
 * PHP version 7.3
 * 
 * @category Class
 * @package  Estate_Agency
 * @author   LauraDev <contact@lauradev.fr>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     ""
 */
namespace App\Form;

use App\Entity\PropertySearch;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

/**
 * PropertyType Class Doc Comment
 * 
 * @category Class
 * @package  Estate_Agency
 * @author   LauraDev <contact@lauradev.fr>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     ""
 */
class PropertySearchType extends AbstractType
{
    /**
     * Build Property Form
     * 
     * @param FormBuilderInterface $builder FormBuilderInterface
     * @param array                $options Options
     * 
     * @return array
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('maxPrice', IntegerType::class, ['required' => false])
            ->add('minSurface', IntegerType::class, ['required' => false]);
    }

    /**
     * Form options
     * 
     * @param OptionsResolver $resolver Options Resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => PropertySearch::class,
                'translation_domain' => 'forms',
                'method' => 'get',
                'csrf_protection' => false
            ]
        );
    }

    public function getBlockPrefix()
    {
        return '';
    }
}
