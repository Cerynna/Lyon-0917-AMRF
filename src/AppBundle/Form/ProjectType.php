<?php

namespace AppBundle\Form;

use AppBundle\Entity\Dictionary;
use AppBundle\Entity\Project;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
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
        $builder
            ->add('title',TextType::class,[
                'attr' => [
                    'required' => true,
                ]
                ])
			->add('slug', TextType::class,array('mapped' => false,))
            ->add('themes', EntityType::class, array(
                'class' => 'AppBundle:Dictionary',
                /*'mapped' => false,*/
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->setParameter('type', Dictionary::TYPE_THEME)
                        ->where('u.type = :type')
                        ->orderBy('u.type', 'ASC');
                },
                'expanded' => true,
                'multiple' => true,
                'choice_label' => 'name',
                'label_attr' => ['class' => 'style_checkbox'],

            ))
            ->add('creationDate', DateType::class, array(
                'widget' => 'single_text',
                // this is actually the default format for single_text
                'format' => 'yyyy-MM-dd',

            ))
            ->add('updateDate', DateType::class, array(
                'widget' => 'single_text',
                // this is actually the default format for single_text
                'format' => 'yyyy-MM-dd',

            ))
            ->add('images', FileType::class, [
                'multiple' => true])
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

            ->add('keyWords', EntityType::class, array(
                'class' => 'AppBundle:Dictionary',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->setParameter('type', Dictionary::TYPE_KEYWORD)
                        ->where('u.type = :type')
                        ->orderBy('u.type', 'ASC');
                },
                'expanded' => true,
                'multiple' => true,
                'choice_label' => 'name',
                'label_attr' => ['class' => 'style_checkbox'],

            ))


            ->add('mayor', EntityType::class, [
                'class' => 'AppBundle\Entity\Mayor',
                'choice_label' => 'town',
            ]);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Project'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'projet';
    }


}
