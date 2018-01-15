<?php

namespace AppBundle\Form;

use AppBundle\Entity\Dictionary;
use AppBundle\Entity\Search;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\FormBuilderInterface;


class SearchType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('texts')
            ->add('keywords', EntityType::class, array(
                'class' => 'AppBundle:Dictionary',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->setParameter('type', Dictionary::TYPE_KEYWORD)
                        ->where('u.type = :type')
                        ->orderBy('u.type', 'ASC');
                },
                'expanded' => false,
                'multiple' => true,
                'choice_label' => 'name',
                'label_attr' => ['class' => 'style_checkbox'],
                'required' => false,

            ))
            ->add('themas', EntityType::class, array(
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
                'required' => false,

            ))
            ->add('commune')
            ->add('region')
            ->add('departement');

    }
}
