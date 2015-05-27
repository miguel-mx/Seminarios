<?php

namespace proyecto1\SeminarioBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EventoType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('seminario')
            ->add('lugar','text',array('required'=>false))
            ->add('fecha', 'date', array('input' => 'datetime','widget' => 'single_text','format' => 'dd-MM-yyyy',))
            ->add('hora')
            ->add('ponente')
            ->add('origen')
            ->add('platica')
            ->add('resumen','textarea',array('required' => false))
            ->add('coment','text',array('required' => false))

        ;
    }
    
    /**x
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'proyecto1\SeminarioBundle\Entity\Evento'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'proyecto1_seminariobundle_evento';
    }
}
