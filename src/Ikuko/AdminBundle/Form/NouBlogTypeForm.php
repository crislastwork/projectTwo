<?php

namespace Ikuko\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


class NouBlogTypeForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options) {
        
        $builder
                ->add('titolCa', 'text', array('label' => 'Títol de la col.lecció en Català'))
                ->add('titolEs', 'text', array('label' => 'Títol de la col.lecció en Castellà'))
                ->add('blogCa', 'textarea', array('label' => 'Text del blog en Català'))
                ->add('blogEs', 'textarea', array('label' => 'Text del blog en Castellà'))
                ->add('autor', 'text', array('label' => 'Nom de l\'autor/a'))
                ->add('dataPublicacio', 'date', array('label' => 'Data de publicació'))
                ->add('imatge', 'file', array(
                        'label' => 'Puja una imatge',
                        'required' => false))
                ->add('categoriaCa', 'entity', array(
                        'class' => 'IkukoBlogBundle:Categoria',
                        'label' => 'Categoria'));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Ikuko\BlogBundle\Entity\Blog',
        ));
    }
    
    public function getName() {
        return 'NouBlog';
    }
}
