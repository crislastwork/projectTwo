<?php

namespace Ikuko\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Ikuko\IkukoBundle\Entity\Colleccio;
use Ikuko\AdminBundle\Form\NovaColleccioTypeForm;
use Symfony\Component\HttpFoundation\Request;

class ColleccioController extends Controller {

    public function llistaColleccionsAction() {
        $repository = $this->getDoctrine()->getRepository('IkukoIkukoBundle:Colleccio');
        $colleccions = $repository->findAll();

        return $this->render('IkukoAdminBundle:Colleccio:llista_colleccions.html.twig', array(
                    'colleccions' => $colleccions));
    }

    public function novaColleccioAction(Request $request) {
        $colleccio = new Colleccio();
        $form = $this->createForm(new NovaColleccioTypeForm(), $colleccio);

        if ($request->isMethod('POST')) {
            $form->bind($request);
            if ($form->getData()->getImatge() == null) {
                $this->get('session')->getFlashBag()->add('notice', 'Afegeix una imatge abans de desar!');
                return $this->redirect($this->generateUrl('ikuko_admin_nova_colleccio'));
            } else {
                if ($form->isValid()) {
                    $em = $this->getDoctrine()->getManager();
                    $directori_desti = $this->container->getParameter('ikuko.directori.imatges');
                    $nom_imatge = uniqid('coleccio-') . '-img.jpg';
                    $colleccio->setRutaImatge($nom_imatge);
                    $form->getData()->getImatge()->move($directori_desti, $nom_imatge);
                    $em->persist($colleccio);
                    $em->flush();

                    $this->get('session')->getFlashBag()->add('notice', 'Col.leccio desada correctament!');
                }
                return $this->redirect($this->generateUrl('ikuko_admin_nova_colleccio')
                );
            }
        }
        return $this->render('IkukoAdminBundle:Colleccio:nova_colleccio.html.twig', array(
                    'form' => $form->createView(),
        ));
    }

    public function editaColleccioAction(Request $request, $colleccio) {

        $em = $this->getDoctrine()->getManager();
        $colleccio = $em->getRepository('IkukoIkukoBundle:Colleccio')
                ->findOneBy(array('id' => $colleccio));

        $form = $this->createForm(new NovaColleccioTypeForm(), $colleccio);

        if ($request->isMethod('POST')) {
            $form->bind($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                
                 if ($form->getData()->getImatge() != null) {
                    $directori_desti = $this->container->getParameter('ikuko.directori.imatges');
                    $nom_imatge = uniqid('coleccio-') . '-img.jpg';
                    $colleccio->setRutaImatge($nom_imatge);
                    $form->getData()->getImatge()->move($directori_desti, $nom_imatge);
                }
                
                $em->persist($colleccio);
                $em->flush();

                $this->get('session')->getFlashBag()->add('notice', 'Col.lecció modificada correctament!');

                return $this->forward('IkukoAdminBundle:Colleccio:llistaColleccions');
            }
        }
        return $this->render('IkukoAdminBundle:Colleccio:edita_colleccio.html.twig', array(
                    'form' => $form->createView(),
                    'colleccio' => $colleccio
        ));
    }

    public function eliminaColleccioAction($colleccio) {
        $em = $this->getDoctrine()->getManager();
        $colleccio = $em->getRepository('IkukoIkukoBundle:Colleccio')
                ->findOneBy(array('id' => $colleccio));

        if (!$colleccio) {
            throw $this->createNotFoundException('No s\'ha trobat cap col.lecció amb id: ' . $colleccio);
        }
        $em->remove($colleccio);
        $em->flush();

        $this->get('session')->getFlashBag()->add('notice', 'Col.lecció eliminada amb èxit!');

        return $this->forward('IkukoAdminBundle:Colleccio:llistaColleccions');
    }

}
