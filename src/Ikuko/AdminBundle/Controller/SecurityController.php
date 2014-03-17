<?php

namespace Ikuko\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\HttpFoundation\Request;


class SecurityController extends Controller
{
    
    public function loginAction(Request $request) {
        
        $session = $request->getSession();
       
        // login error
        if($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)){
            $error = $request->attributes->get(
                    SecurityContext::AUTHENTICATION_ERROR
                    );
        } else {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR); 
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        }
        
        return $this->render('IkukoAdminBundle:Default:login.html.twig', array(
                     'error' => $error
                    ));
    }
}
