<?php

namespace Ikuko\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class DefaultController extends Controller 
{

    public function indexAction() 
    {
        return $this->render('IkukoAdminBundle:Default:hello_cris.html.twig');
    }

}
