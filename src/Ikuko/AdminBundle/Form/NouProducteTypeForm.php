<?php

namespace Ikuko\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


class NouProducteTypeForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options) {
        
        $builder
                ->add('nomCa', 'text', array('label' => 'Nom del producte en Català'))
                ->add('nomEs', 'text', array('label' => 'Nom del producte en Castellà'))
                ->add('descripcioCa', 'textarea', array('label' => 'Descripció en Català'))
                ->add('descripcioEs', 'textarea', array('label' => 'Descripció en Castellà'))
                ->add('preu', 'money', array('label' => 'Preu'))
                ->add('talles', 'text', array('label' => 'Talles'))
                ->add('linkCompra', 'text', array(
                        'label' => 'Link a botiga onlilne',
                        'required' => false))
                ->add('venut', 'checkbox', array(
                        'label' => 'Marca si el producte està esgotat',
                        'required' => false))
                ->add('imatgeA', 'file', array(
                        'label' => 'Primera imatge',
                        'required' => false))
                ->add('imatgeB', 'file', array(
                        'label' => 'Segona imatge',
                        'required' => false))
                ->add('imatgeC', 'file', array(
                        'label' => 'Tercera imatge',
                        'required' => false))
                ->add('imatgeD', 'file', array(
                        'label' => 'Quarta imatge',
                        'required' => false))
                ->add('colleccioCa', 'entity', array(
                        'class' => 'IkukoIkukoBundle:Colleccio',
                        'label' => 'Col.lecció'))
                ->add('tagCa', 'entity', array(
                        'class' => 'IkukoIkukoBundle:Tag',
                        'label' => 'Tag'));

    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Ikuko\IkukoBundle\Entity\Producte',
        ));
    }
    
    public function getName() {
        return 'NouProducte';
    }
}
