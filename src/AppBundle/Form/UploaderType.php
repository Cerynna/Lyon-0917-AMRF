<?php
/**
 * Created by PhpStorm.
 * User: cerynna
 * Date: 02/12/17
 * Time: 13:39
 */

namespace AppBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;

class UploaderType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('path', FileType::class, [
            'attr' => [
                'onchange' => 'document.uploader.submit();'
            ]
        ]);
    }
}