<?php
/**
 * Created by PhpStorm.
 * User: cerynna
 * Date: 13/01/18
 * Time: 23:12
 */

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class FiltreUserMayorType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('CodePostal', TextType::class, [
                'attr' => [
                    'required' => false,
                ]
            ])
            ->add('CodeInsee', TextType::class, [
                'attr' => [
                    'required' => false,
                ]
            ]);
    }
}
