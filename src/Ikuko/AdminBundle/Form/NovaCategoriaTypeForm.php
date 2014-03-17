<?php

namespace Ikuko\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


class NovaCategoriaTypeForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options) {
        
        $builder
                ->add('titolCa', 'text', array('label' => 'Títol de la categoria en Català'))
                ->add('titolEs', 'text', array('label' => 'Títol de la  categoria en Castellà'));           
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Ikuko\BlogBundle\Entity\Categoria',
        ));
    }
    
    public function getName() {
        return 'NovaCategoria';
    }
}
