<?php

namespace Ikuko\IkukoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $repository = $this->getDoctrine()
                ->getRepository('IkukoIkukoBundle:Slider');

        $sliders = $repository->findAll();
        
        $repository2 = $this->getDoctrine()
                ->getRepository('IkukoBlogBundle:Blog');
        
        $query = $repository2->createQueryBuilder('b')
                ->orderBy('b.data_publicacio', 'ASC')
                ->setMaxResults(6)
                ->getQuery();
        
        $blogs = $query->getResult();
        
        
        return $this->render('IkukoIkukoBundle:Default:index.html.twig', array(
            'sliders' => $sliders,
            'blogs' => $blogs));
    }
    
    public function colleccionsAction()
    {
        $name = 'Ikuko';
        return $this->render('IkukoIkukoBundle:Default:index.html.twig', array('name' => $name));
    }
    
    public function aboutAction()
    {
        $name = 'Ikuko';
        return $this->render('IkukoIkukoBundle:Default:index.html.twig', array('name' => $name));
    }
    
    public function blogAction()
    {
        $name = 'Ikuko';
        return $this->render('IkukoIkukoBundle:Default:index.html.twig', array('name' => $name));
    }
    
    public function contacteAction()
    {
        $name = 'Ikuko';
        return $this->render('IkukoIkukoBundle:Default:index.html.twig', array('name' => $name));
    }
    
}
