<?php

namespace AMRF\PublicRooterBundle\Form;

use AMRF\PublicRooterBundle\Entity\Dictionary;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DictionaryType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type', ChoiceType::class, array(
                'choices'  => array(
                    'Thématique' => Dictionary::TYPE_THEME,
                    "Secteur d'activité" => Dictionary::TYPE_ACTIVITY,
                    'Mot clé' => Dictionary::TYPE_KEYWORD,
                )))
            ->add('name')
            ->add('value');
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AMRF\PublicRooterBundle\Entity\Dictionary'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'amrf_publicrooterbundle_dictionary';
    }


}
