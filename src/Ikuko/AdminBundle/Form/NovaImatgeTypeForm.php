<?php

namespace Ikuko\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


class NovaImatgeTypeForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options) {
        
        $builder
                ->add('nom', 'text', array('label' => 'Nom de la imatge'))
                ->add('imatge', 'file', array(
                        'label' => 'Puja una imatge'));

    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Ikuko\BlogBundle\Entity\Imatge',
        ));
    }
    
    public function getName() {
        return 'NovaImatge';
    }
}
