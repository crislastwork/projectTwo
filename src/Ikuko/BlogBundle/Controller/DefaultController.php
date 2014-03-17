<?php

namespace Ikuko\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('IkukoBlogBundle:Default:index.html.twig');
    }
    
    
}
