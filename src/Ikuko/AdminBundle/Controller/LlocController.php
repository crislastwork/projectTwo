<?php

namespace Ikuko\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Ikuko\BlogBundle\Entity\Lloc;
use Ikuko\AdminBundle\Form\NouLlocTypeForm;
use Symfony\Component\HttpFoundation\Request;

class LlocController extends Controller {

    public function llistaLlocsAction() {
        $repository = $this->getDoctrine()->getRepository('IkukoBlogBundle:Lloc');
        $llocs = $repository->findAll();

        return $this->render('IkukoAdminBundle:Lloc:llista_llocs.html.twig', array(
                    'llocs' => $llocs));
    }

    public function nouLlocAction(Request $request) {
        $lloc = new Lloc();
        $form = $this->createForm(new NouLlocTypeForm(), $lloc);

        if ($request->isMethod('POST')) {
            $form->bind($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($lloc);
                $em->flush();

                $this->get('session')->getFlashBag()->add('notice', 'Lloc d\'interés desat correctament!');
            }
            return $this->redirect($this->generateUrl('ikuko_admin_nou_lloc')
            );
        }
        return $this->render('IkukoAdminBundle:Lloc:nou_lloc.html.twig', array(
                    'form' => $form->createView(),
        ));
    }

    public function editaLlocAction(Request $request, $lloc) {

        $em = $this->getDoctrine()->getManager();
        $lloc = $em->getRepository('IkukoBlogBundle:Lloc')
                ->findOneBy(array('id' => $lloc));

        $form = $this->createForm(new NouLlocTypeForm(), $lloc);

        if ($request->isMethod('POST')) {
            $form->bind($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($lloc);
                $em->flush();

                $this->get('session')->getFlashBag()->add('notice', 'Lloc d\'interés modificat correctament!');

                return $this->forward('IkukoAdminBundle:Lloc:llistaLlocs');
            }
        }
        return $this->render('IkukoAdminBundle:Lloc:edita_lloc.html.twig', array(
                    'form' => $form->createView(),
                    'lloc' => $lloc
        ));
    }

    public function eliminaLlocAction($lloc) {
        $em = $this->getDoctrine()->getManager();
        $lloc = $em->getRepository('IkukoBlogBundle:Lloc')
                ->findOneBy(array('id' => $lloc));

        if (!$lloc) {
            throw $this->createNotFoundException('No s\'ha trobat cap lloc d\'interés amb id: ' . $lloc);
        }
        $em->remove($lloc);
        $em->flush();

        $this->get('session')->getFlashBag()->add('notice', 'Lloc d\'interés eliminat amb èxit!');

        return $this->forward('IkukoAdminBundle:Lloc:llistaLlocs');
    }

}
