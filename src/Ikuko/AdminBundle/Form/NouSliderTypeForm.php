<?php

namespace Ikuko\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


class NouSliderTypeForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options) {
        
        $builder
                ->add('nom', 'text', array('label' => 'Nom del Slider'))
                ->add('textCa', 'textarea', array('label' => 'Text en Català'))
                ->add('textEs', 'textarea', array('label' => 'Text en Castellà'))
                ->add('color', 'choice', array(
                        'label' => 'Color del Text',
                        'choices' => array('#FFFFFF' => 'Blanc', '#000000' => 'Negre' )))
                ->add('posicio', 'choice', array(
                        'label' => 'Posició del Text',
                        'choices' => array('right' => 'Dreta', 'left' => 'Esquerra' )))
                ->add('imatge', 'file', array(
                        'label' => 'Puja una imatge',
                        'required' => false));

    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Ikuko\IkukoBundle\Entity\Slider',
        ));
    }
    
    public function getName() {
        return 'NouSlider';
    }
}
