<?php

namespace AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use A2lix\TranslationFormBundle\Form\Type\TranslationsType;

use Symfony\Component\Form\Extension\Core\Type\FileType;

class CategoryType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('translations', TranslationsType::class,[
            'label'=>' ',
            'fields' =>[
                'name'=>[
                    'label' => 'Titre de la categorie(*)',
                    'attr'=>[
                        "class" =>'form_ctrl  required_class theSlugInutWilTakeThisInputValue title_page',
                        'data-label'=>'Titre de la categorie (*)'
                    ]
                ],
                'slug'=>[
                    'label' => 'Permalien (*)',
                    'attr'=>[
                        "class" =>'form_ctrl required_class slugInputFromOriginalTextInput slugTestIfExistInDatabase',
                        'data-entity'=>'Page',
                        'data-label'=>'Permalien (*)'
                    ]
                ]
            ]
        ])
         ->add('state',ChoiceType::class,array(
            'choices' => array(
                'On-Line' => 1,
                'Off-Line ' => 0
            ),
            'attr'=>array(
                'class'=>'select_ctrl_state'
            )
        ));
    }
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AdminBundle\Entity\Category'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'adminbundle_category';
    }


}
