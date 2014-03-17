<?php

namespace Ikuko\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


class NouTagTypeForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options) {
        
        $builder
                ->add('tagCa', 'text', array('label' => 'Nom del tag en Català'))
                ->add('tagEs', 'text', array('label' => 'Nom del tag en Castellà'));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Ikuko\IkukoBundle\Entity\Tag',
        ));
    }
    
    public function getName() {
        return 'NouTag';
    }
}
