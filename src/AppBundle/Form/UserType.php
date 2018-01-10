<?php

namespace AppBundle\Form;

use AppBundle\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('login')
            ->add('password')
            ->add('status')
            ->add('status', ChoiceType::class, array(
                'choices' => array(
                    'Inactif' => User::USER_STATUS_INACTIF,
                    'Actif' => User::USER_STATUS_ACTIF,
                    'Delete' => User::USER_STATUS_DELETE,
                ),
            ))
            ->add('role', ChoiceType::class, array(
                'choices' => array(
                    'Maire' => User::USER_ROLE_MAYOR,
                    'Partenaire' => User::USER_ROLE_PARTNER,
                    'Admin' => User::USER_ROLE_ADMIN,
                ),
            ))
            ->add('email')
            ->add('creationDate')
            ->add('lastLogin')
            ->add('mayor', MayorType::class)
            ->add('partner', PartnerType::class);
    }

    /**
     * {@inheritdoc}
     */
    public
    function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\User'
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


