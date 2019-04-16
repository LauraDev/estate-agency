<?php

namespace App\Form;

use App\Entity\Property;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class PropertyType extends AbstractType
{
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
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Property::class,
            'translation_domain' => 'forms' //think about changing locale var in services.yaml
        ]);
    }

    /**
     * @return array
     */
    private function getChoices(): array
    {
        $choices = Property::heat;
        $output = [];
        foreach( $choices as $index => $value) {
            $output[$value] =  $index;
        }
        return $output;
    }
}
