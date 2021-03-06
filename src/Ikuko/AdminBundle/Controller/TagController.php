<?php

namespace Ikuko\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Ikuko\IkukoBundle\Entity\Tag;
use Ikuko\AdminBundle\Form\NouTagTypeForm;
use Symfony\Component\HttpFoundation\Request;


class TagController extends Controller 
{

    public function llistaTagsAction() {
        $repository = $this->getDoctrine()->getRepository('IkukoIkukoBundle:Tag');
        $tags = $repository->findAll();

        return $this->render('IkukoAdminBundle:Tag:llista_tags.html.twig', array(
                    'tags' => $tags));
    }

    public function nouTagAction(Request $request) {
        $tag = new Tag();
        $form = $this->createForm(new NouTagTypeForm(), $tag);

        if ($request->isMethod('POST')) {
            $form->bind($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($tag);
                $em->flush();

                $this->get('session')->getFlashBag()->add('notice', 'Tag desat correctament!');
            }
            return $this->redirect($this->generateUrl('ikuko_admin_nou_tag')
            );
        }
        return $this->render('IkukoAdminBundle:Tag:nou_tag.html.twig', array(
                    'form' => $form->createView(),
        ));
    }

    public function editaTagAction(Request $request, $id_tag) {

        $em = $this->getDoctrine()->getManager();
        $tag = $em->getRepository('IkukoIkukoBundle:Tag')
                ->findOneBy(array('id' => $id_tag));

        $form = $this->createForm(new NouTagTypeForm(), $tag);

        if ($request->isMethod('POST')) {
            $form->bind($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($tag);
                $em->flush();

                $this->get('session')->getFlashBag()->add('notice', 'Tag modificat correctament!');

                return $this->forward('IkukoAdminBundle:Tag:llistaTags');
            }
        }
        return $this->render('IkukoAdminBundle:Tag:edita_tag.html.twig', array(
                    'form' => $form->createView(),
                    'tag' => $tag
        ));
    }

    public function eliminaTagAction($id_tag) {
        $em = $this->getDoctrine()->getManager();
        $tag = $em->getRepository('IkukoIkukoBundle:Tag')
                ->findOneBy(array('id' => $id_tag));

        if (!$id_tag) {
            throw $this->createNotFoundException('No s\'ha trobat cap tag amb id: ' . $id_tag);
        }

        try{
            $em->remove($tag);
            $em->flush();
            $this->get('session')->getFlashBag()->add('notice', 'Tag eliminat amb èxit!');
        } catch (\Doctrine\DBAL\DBALException $e) {
            
            $this->get('session')->getFlashBag()->add('notice', 'IMPOSSIBLE ELIMINAR EL TAG!');
        }
        
        return $this->forward('IkukoAdminBundle:Tag:llistaTags');
    }

}

