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

use App\Entity\Facility;
use App\Entity\Property;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * PropertyType Class Doc Comment
 * 
 * @category Class
 * @package  Estate_Agency
 * @author   LauraDev <contact@lauradev.fr>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     ""
 */
class PropertyType extends AbstractType
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
            ->add('title')
            ->add('description')
            ->add('surface')
            ->add('rooms')
            ->add('bedrooms')
            ->add('floor')
            ->add('price')
            ->add('heat', ChoiceType::class, ["choices" => $this->getChoices()])
            ->add('city')
            ->add('address')
            ->add('postcode')
            ->add('sold')
            ->add('facilities', EntityType::class, [
                'required' => false,
                'class' => Facility::class,
                'choice_label' => 'name',
                'multiple' => true
            ])
            ->add('imageFile', FileType::class, [
                'required' => false
            ]);
    }

    /**
     * Form options
     * 
     * @param OptionsResolver $resolver Options 
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => Property::class,
                'translation_domain' => 'forms' 
                // To display french, think about changing the locale var in services.yaml
            ]
        );
    }

    /**
     * Get heat choices elements 
     * 
     * @return array
     */
    private function getChoices(): array
    {
        $choices = Property::HEAT;
        $output = [];
        foreach ( $choices as $index => $value) {
            $output[$value] =  $index;
        }
        return $output;
    }
}
