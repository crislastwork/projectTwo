<?php

namespace Ikuko\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class ComentariController extends Controller 
{
    public function llistaComentarisAction() {
        $repository = $this->getDoctrine()->getRepository('IkukoBlogBundle:Comentari');
        $comentaris = $repository->findAll();

        return $this->render('IkukoAdminBundle:Comentari:llista_comentaris.html.twig', array(
                    'comentaris' => $comentaris));
    }
    
    public function eliminaComentariAction($id_comentari) {
        $em = $this->getDoctrine()->getManager();
        $comentari = $em->getRepository('IkukoBlogBundle:Comentari')
                ->findOneBy(array('id' => $id_comentari));

        if (!$id_comentari) {
            throw $this->createNotFoundException('No s\'ha trobat cap comentari amb id: ' . $id_comentari);
        }
        $em->remove($comentari);
        $em->flush();

        $this->get('session')->getFlashBag()->add('notice', 'Comentari eliminat amb èxit!');

        return $this->forward('IkukoAdminBundle:Comentari:llistaComentaris');
    }
}
