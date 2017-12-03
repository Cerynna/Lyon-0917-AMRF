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
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;

class UploaderType extends AbstractType
{

    /**
     * @var string
     */
    private $name = "image";

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return UploaderType
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }



    public function getBlockPrefix()
    {
        return "uploader_" . $this->name;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this->setName('file');
        $builder->add('path', FileType::class, [
            'attr' => [
                'onchange' => 'this.form.submit();'
            ]
        ]);
    }
}