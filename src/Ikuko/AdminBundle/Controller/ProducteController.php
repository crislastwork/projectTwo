<?php

namespace Ikuko\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Ikuko\IkukoBundle\Entity\Producte;
use Ikuko\AdminBundle\Form\NouProducteTypeForm;
use Symfony\Component\HttpFoundation\Request;

class ProducteController extends Controller {

    public function llistaProductesAction() {
        $repository = $this->getDoctrine()->getRepository('IkukoIkukoBundle:Producte');
        $productes = $repository->findAll();

        return $this->render('IkukoAdminBundle:Producte:llista_productes.html.twig', array(
                    'productes' => $productes));
    }

    public function nouProducteAction(Request $request) {
        $producte = new Producte();
        $form = $this->createForm(new NouProducteTypeForm(), $producte);

        if ($request->isMethod('POST')) {
            $form->bind($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                
                $producte->setColleccioEs($form->getData()->getColleccioCa());
                $producte->setTagEs($form->getData()->getTagCa());
                
                $directori_desti = $this->container->getParameter('ikuko.directori.imatges');
                if ($form->getData()->getImatgeA() != null) {
                    $nom_imatge = uniqid('prod-') . '-img1.jpg';
                    $producte->setRutaImatgeA($nom_imatge);
                    $form->getData()->getImatgeA()->move($directori_desti, $nom_imatge);
                } 
                if ($form->getData()->getImatgeB() != null) {
                    $nom_imatge = uniqid('prod-') . '-img2.jpg';
                    $producte->setRutaImatgeB($nom_imatge);
                    $form->getData()->getImatgeB()->move($directori_desti, $nom_imatge);
                } 
                if ($form->getData()->getImatgeC() != null) {
                    $nom_imatge = uniqid('prod-') . '-img3.jpg';
                    $producte->setRutaImatgeC($nom_imatge);
                    $form->getData()->getImatgeC()->move($directori_desti, $nom_imatge);
                } 
                if ($form->getData()->getImatgeD() != null) {
                    $nom_imatge = uniqid('prod-') . '-img4.jpg';
                    $producte->setRutaImatgeD($nom_imatge);
                    $form->getData()->getImatgeD()->move($directori_desti, $nom_imatge);
                }
                $em->persist($producte);
                $em->flush();

                $this->get('session')->getFlashBag()->add('notice', 'Producte desat correctament!');

                return $this->redirect($this->generateUrl('ikuko_admin_nou_producte')
                );
            }
        }
        return $this->render('IkukoAdminBundle:Producte:nou_producte.html.twig', array(
                    'form' => $form->createView(),
        ));
    }

    public function editaProducteAction(Request $request, $id_producte) {

        $em = $this->getDoctrine()->getManager();
        $producte = $em->getRepository('IkukoIkukoBundle:Producte')
                ->findOneBy(array('id' => $id_producte));

        $form = $this->createForm(new NouProducteTypeForm(), $producte);

        if ($request->isMethod('POST')) {
            $form->bind($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                
                $producte->setColleccioEs($form->getData()->getColleccioCa());
                $producte->setTagEs($form->getData()->getTagCa());
                
                $directori_desti = $this->container->getParameter('ikuko.directori.imatges');
                if ($form->getData()->getImatgeA() != null) {
                    $nom_imatge = uniqid('prod-') . '-img1.jpg';
                    $producte->setRutaImatgeA($nom_imatge);
                    $form->getData()->getImatgeA()->move($directori_desti, $nom_imatge);
                } 
                if ($form->getData()->getImatgeB() != null) {
                    $nom_imatge = uniqid('prod-') . '-img2.jpg';
                    $producte->setRutaImatgeB($nom_imatge);
                    $form->getData()->getImatgeB()->move($directori_desti, $nom_imatge);
                } 
                if ($form->getData()->getImatgeC() != null) {
                    $nom_imatge = uniqid('prod-') . '-img3.jpg';
                    $producte->setRutaImatgeC($nom_imatge);
                    $form->getData()->getImatgeC()->move($directori_desti, $nom_imatge);
                } 
                if ($form->getData()->getImatgeD() != null) {
                    $nom_imatge = uniqid('prod-') . '-img4.jpg';
                    $producte->setRutaImatgeD($nom_imatge);
                    $form->getData()->getImatgeD()->move($directori_desti, $nom_imatge);
                }

                $em->persist($producte);
                $em->flush();

                $this->get('session')->getFlashBag()->add('notice', 'Producte modificat correctament!');

                return $this->forward('IkukoAdminBundle:Producte:llistaProductes');
            }
        }
        return $this->render('IkukoAdminBundle:Producte:edita_producte.html.twig', array(
                    'form' => $form->createView(),
                    'producte' => $producte
        ));
    }

    public function eliminaProducteAction($id_producte) {
        $em = $this->getDoctrine()->getManager();
        $producte = $em->getRepository('IkukoIkukoBundle:Producte')
                ->findOneBy(array('id' => $id_producte));

        if (!$id_producte) {
            throw $this->createNotFoundException('No s\'ha trobat cap producte amb id: ' . $id_producte);
        }
        $em->remove($producte);
        $em->flush();

        $this->get('session')->getFlashBag()->add('notice', 'Producte eliminat amb èxit!');

        return $this->forward('IkukoAdminBundle:Producte:llistaProductes');
    }

}
