<?php

namespace MediaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
class ImageType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('src',  FileType::class,array(
            'required'=>false,
            'data_class' => null,
            'required'=>false,
            'label'=>"importer un fichier ",
            'attr'=>array(
                'class'=>'fileinput inputimageUpload form_ctrl',
                'placeholder'=>'importer un fichier',
                'data-label'=>'importer un fichier'
            )
        ))
        ->add('externaLink',null,array(
            'label'=>'Autheur',
            'attr'=>array(
                'class'=>'form_ctrl not_required_class',
                'placeholder'=>'Autheur',
                'data-label'=>'Autheur ',
                'required'=>false
            )
        ))
        ->add('alt',null,array(
            'label'=>'Autheur',
            'attr'=>array(
                'class'=>'form_ctrl not_required_class',
                'placeholder'=>'Autheur',
                'data-label'=>'Autheur ',
                'required'=>false
            )
        ));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MediaBundle\Entity\Image'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'mediabundle_image';
    }


}
