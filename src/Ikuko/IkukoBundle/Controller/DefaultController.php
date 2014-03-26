<?php

namespace Ikuko\IkukoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
// en relació a la pag contacte
use Ikuko\IkukoBundle\Entity\Enquiry;
use Ikuko\IkukoBundle\Form\EnquiryType;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    // controller de la pàgina index del frontend
    public function indexAction()
    {
        $repository = $this->getDoctrine()
                ->getRepository('IkukoIkukoBundle:Slider');

        $sliders = $repository->findAll();
        
        $repository2 = $this->getDoctrine()
                ->getRepository('IkukoBlogBundle:Blog');
        
        $query = $repository2->createQueryBuilder('b')
                ->orderBy('b.dataPublicacio', 'DESC')
                ->setMaxResults(6)
                ->getQuery();
        
        $blogs = $query->getResult();
        
        $repository3 = $this->getDoctrine()
                    ->getRepository('IkukoIkukoBundle:Colleccio');
        
        $query2 = $repository3->createQueryBuilder('c')
                              ->orderBy('c.dataCreacio', 'DESC')
                              ->setMaxResults(2)
                              ->getQuery();
        
        $colleccions = $query2->getResult();
        
        
        return $this->render('IkukoIkukoBundle:Default:index.html.twig', array(
            'sliders' => $sliders,
            'blogs' => $blogs,
            'colleccions' => $colleccions));
    }
    
    // llista dinàmica de col.leccions per al menú del frontend
    public function llistaColleccionsAction()
    {
        $em = $this->getDoctrine()->getManager();
        $colleccions = $em->getRepository('IkukoIkukoBundle:Colleccio')->findAll();
        
        return $this->render(
                'IkukoIkukoBundle:Colleccio:llista_colleccions.html.twig', array(
                    'colleccions' => $colleccions));
    }
        
    public function aboutAction()
    {
        return $this->render('IkukoIkukoBundle:Default:about.html.twig');
    }
    
    public function blogAction()
    {
        $name = 'Ikuko';
        return $this->render('IkukoIkukoBundle:Default:index.html.twig', array('name' => $name));
    }
    
    public function contacteAction(Request $request)
    {
        $enquiry = new Enquiry();
        $form = $this->createForm(new EnquiryType(), $enquiry);

        if ($request->getMethod() == 'POST') {
            $form->bind($request);

            if ($form->isValid()) {
                $message = \Swift_Message::newInstance()
                        ->setSubject('Contact enquiry from Ikuko')
                        ->setFrom('enquiries@ikuko.com')
                        ->setTo('adp.cris@gmail.com')
                        ->setBody($this->renderView('IkukoIkukoBundle:Default:contact.txt.twig', array(
                            'enquiry' => $enquiry)));
                $this->get('mailer')->send($message);

                $this->get('session')->getFlashBag()->add('ikuko-notice', 'Missatge enviat correctament. Gràcies!');

                // Perform some action, such as sending an email
                // Redirect - This is important to prevent users re-posting
                // the form if they refresh the page
                return $this->redirect($this->generateUrl('ikuko_contacte'));
            }
        }

        return $this->render('IkukoIkukoBundle:Default:contacte.html.twig', array(
                    'form' => $form->createView()
        ));
    }   
}
