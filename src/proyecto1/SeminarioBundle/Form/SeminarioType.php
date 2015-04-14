<?php

namespace proyecto1\SeminarioBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SeminarioType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre')
            ->add('lugar')
            ->add('hora')
            ->add('estatus','checkbox',array('required' => false))
            ->add('responsables')
            ->add('crear','submit')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'proyecto1\SeminarioBundle\Entity\Seminario'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'proyecto1_seminariobundle_seminario';
    }
}
