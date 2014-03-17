<?php

namespace Ikuko\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


class NovaColleccioTypeForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options) {
        
        $builder
                ->add('titolCa', 'text', array('label' => 'Títol de la col.lecció en Català'))
                ->add('titolEs', 'text', array('label' => 'Títol de la col.lecció en Castellà'))
                ->add('nomImatge', 'text', array('label' => 'Nom de la imatge'))
                ->add('imatge', 'file', array(
                        'label' => 'Puja una imatge',
                        'required' => false));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Ikuko\IkukoBundle\Entity\Colleccio',
        ));
    }
    
    public function getName() {
        return 'NovaColleccio';
    }
}
