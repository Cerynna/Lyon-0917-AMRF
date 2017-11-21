<?php

namespace AMRF\PublicRooterBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('login')
            ->add('password')
            ->add('role')
            ->add('status')
            ->add('email')
            ->add('creationDate')
            ->add('lastLogin')
            ->add('mayor', MayorType::class)
            ->add('partner', PartnerType::class);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AMRF\PublicRooterBundle\Entity\User'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'amrf_publicrooterbundle_user';
    }


}
