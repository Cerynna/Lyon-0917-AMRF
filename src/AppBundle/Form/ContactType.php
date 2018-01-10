<?php
/**
 * Created by PhpStorm.
 * User: simont
 * Date: 18/12/2017
 * Time: 10:49
 */

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;

class ContactType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name')
            ->add('firstName')
            ->add('email')
            ->add('phone')
            ->add('subject', ChoiceType::class, array(
                'choices' => array(
                    'Demande de renseignements' => 'Renseignements',
                    'Demande d\'Adhésion' => 'Adhésion',
                    'Problème de connexion' => 'Connexion',
                    'Question fiche Projet' => 'Projet',
                    'Autre' => 'Autre',
                )
            ))
            ->add('statut', ChoiceType::class, array(
                'choices' => array(
                    'Maire' => 'Maire',
                    'Partenaire' => 'Partenaire',
                    'Journaliste' => 'Journaliste',
                    'Autres' => 'Autres',
                )
            ))
            ->add('message', TextareaType::class);
    }
}