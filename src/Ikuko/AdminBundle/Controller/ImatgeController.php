<?php

namespace Ikuko\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Ikuko\BlogBundle\Entity\Imatge;
use Ikuko\AdminBundle\Form\NovaImatgeTypeForm;
use Symfony\Component\HttpFoundation\Request;

class ImatgeController extends Controller {

    public function llistaImatgesAction() {
        $repository = $this->getDoctrine()->getRepository('IkukoBlogBundle:Imatge');
        $imatges = $repository->findAll();

        return $this->render('IkukoAdminBundle:Imatge:llista_imatges.html.twig', array(
                    'imatges' => $imatges));
    }

    public function novaImatgeAction(Request $request) {
        $imatge = new Imatge();
        $form = $this->createForm(new NovaImatgeTypeForm(), $imatge);

        if ($request->isMethod('POST')) {
            $form->bind($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $directori_desti = $this->container->getParameter('ikuko.directori.imatges');
                $nom_imatge = uniqid('blog-') . '-img.jpg';
                $imatge->setRutaImatge($nom_imatge);
                $form->getData()->getImatge()->move($directori_desti, $nom_imatge);
                $em->persist($imatge);
                $em->flush();

                $this->get('session')->getFlashBag()->add('notice', 'Imatge desada correctament!');
                return $this->redirect($this->generateUrl('ikuko_admin_nova_imatge'));
            } else {
                $this->get('session')->getFlashBag()->add('notice', 'Hi ha hagut un error al desar la imatge!');
                return $this->redirect($this->generateUrl('ikuko_admin_nova_imatge'));
            }
        }
        return $this->render('IkukoAdminBundle:Imatge:nova_imatge.html.twig', array(
                    'form' => $form->createView(),
        ));
    }

    public function eliminaImatgeAction($id_imatge) {
        $em = $this->getDoctrine()->getManager();
        $imatge = $em->getRepository('IkukoBlogBundle:Imatge')
                ->findOneBy(array('id' => $id_imatge));

        if (!$id_imatge) {
            throw $this->createNotFoundException('No s\'ha trobat cap imatge amb id: ' . $id_imatge);
        }
        $em->remove($imatge);
        $em->flush();

        $this->get('session')->getFlashBag()->add('notice', 'Imatge eliminada amb èxit!');

        return $this->forward('IkukoAdminBundle:Imatge:llistaImatges');
    }

}
