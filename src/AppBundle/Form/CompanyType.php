<?php

namespace AppBundle\Form;

use AppBundle\Entity\Dictionary;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
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
		//	->add('slug', TextType::class,array('mapped' => false,))
            ->add('address')
            ->add('zipCode')
            ->add('city')
           // ->add('activities')

            ->add('activities', EntityType::class, array(
                'class' => 'AppBundle:Dictionary',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->setParameter('type', Dictionary::TYPE_ACTIVITY)
                        ->where('u.type = :type')
                        ->orderBy('u.type', 'ASC');
                },
                'expanded' => true,
                'multiple' => true,
                'choice_label' => 'name',
                'label_attr' => ['class' => 'style_checkbox'],

            ))
            ->add('presentation')
            ->add('logo')

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
