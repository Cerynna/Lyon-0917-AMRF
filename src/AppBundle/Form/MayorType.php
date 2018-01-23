<?php

namespace AppBundle\Form;

use Symfony\Component\Console\Input\Input;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MayorType extends AbstractType
{
	/**
	 * {@inheritdoc}
	 */
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
			->add('firstName')
			->add('lastName')
			->add('address')
			->add('insee')
			->add('email')
			->add('phone')
			->add('town', TextType::class, array(
				'attr' => array(
					'readonly' => true,
				)
			))
			->add('zipCode', TextType::class, array(
				'attr' => array(
					'readonly' => true,
				)
			))
			->add('department')
			->add('region')
			->add('latitude')
			->add('longitude')
			->add('population')
			->add('url')
			->add('facebook')
			->add('twitter')
			->add('google');
	}

	/**
	 * {@inheritdoc}
	 */
	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults(array(
			'data_class' => 'AppBundle\Entity\Mayor'
		));
	}

	/**
	 * {@inheritdoc}
	 */
	public function getBlockPrefix()
	{
		return 'mayor';
	}
}
