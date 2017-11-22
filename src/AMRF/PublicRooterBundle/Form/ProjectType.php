<?php

namespace AMRF\PublicRooterBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProjectType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title')
            ->add('theme')
            ->add('creationDate')
            ->add('updateDate')
            ->add('image')
            ->add('projectDate', DateType::class, array(
                'widget' => 'single_text',
                // this is actually the default format for single_text
                'format' => 'yyyy-MM-dd',

            ))
            ->add('projectDuration')
            ->add('projectCost')
            ->add('projectCoFinance')
            ->add('descResume')
            ->add('descContext')
            ->add('descGoal')
            ->add('descProgress')
            ->add('descPartners')
            ->add('descResults')
            ->add('descDifficulties')
            ->add('descAdvices')
            ->add('contactName')
            ->add('contactOccupation')
            ->add('contactEmail')
            ->add('contactPhone')
            ->add('file')
            ->add('url')
            ->add('youtube')
            ->add('facebook')
            ->add('twitter')
            ->add('keyWords')
            ->add('mayor');
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AMRF\PublicRooterBundle\Entity\Project'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'amrf_publicrooterbundle_project';
    }


}
