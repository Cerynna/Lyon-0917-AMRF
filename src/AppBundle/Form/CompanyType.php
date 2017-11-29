<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CompanyType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name')
            ->add('address')
            ->add('zipCode')
            ->add('city')
            ->add('activities')
            ->add('presentation')
            ->add('logo',FileType::class, array(
                'data_class' => null,
                )
            )
            ->add('url')
            ->add('facebook')
            ->add('linkedin')
            ->add('twitter')
            ->add('contactFirstName')
            ->add('contactLastName')
            ->add('contactPhone')
            ->add('contactEmail')
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Company'
        ));
    }


    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'company';
    }


}
