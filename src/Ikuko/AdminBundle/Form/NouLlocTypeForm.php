<?php

namespace Ikuko\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


class NouLlocTypeForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options) {
        
        $builder
                ->add('nomCa', 'text', array('label' => 'Nom del lloc en Català'))
                ->add('nomEs', 'text', array('label' => 'Nom del lloc en Castellà'))
                ->add('link', 'text', array('label' => 'Link del lloc'));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Ikuko\BlogBundle\Entity\Lloc',
        ));
    }
    
    public function getName() {
        return 'NouLloc';
    }
}
