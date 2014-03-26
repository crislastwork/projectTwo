<?php

namespace Ikuko\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Ikuko\IkukoBundle\Entity\Slider;
use Ikuko\AdminBundle\Form\NouSliderTypeForm;
use Symfony\Component\HttpFoundation\Request;

class SliderController extends Controller {

    public function llistaSlidersAction() {
        $repository = $this->getDoctrine()->getRepository('IkukoIkukoBundle:Slider');
        $sliders = $repository->findAll();

        return $this->render('IkukoAdminBundle:Slider:llista_sliders.html.twig', array(
                    'sliders' => $sliders));
    }

    public function nouSliderAction(Request $request) {
        $slider = new Slider();
        $form = $this->createForm(new NouSliderTypeForm(), $slider);

        if ($request->isMethod('POST')) {
            $form->bind($request);
            if ($form->getData()->getImatge() == null) {
                $this->get('session')->getFlashBag()->add('notice', 'Afegeix una imatge abans de desar!');
                return $this->redirect($this->generateUrl('ikuko_admin_nou_slider'));
            } else {
                if ($form->isValid()) {
                    $em = $this->getDoctrine()->getManager();
                    $directori_desti = $this->container->getParameter('ikuko.directori.imatges');
                    $nom_imatge = uniqid('slider-') . '-img.jpg';
                    $slider->setRutaSlider($nom_imatge);
                    $form->getData()->getImatge()->move($directori_desti, $nom_imatge);
                    $em->persist($slider);
                    $em->flush();

                    $this->get('session')->getFlashBag()->add('notice', 'Slider desat correctament!');
                }
                return $this->redirect($this->generateUrl('ikuko_admin_nou_slider')
                );
            }
        }
        return $this->render('IkukoAdminBundle:Slider:nou_slider.html.twig', array(
                    'form' => $form->createView(),
        ));
    }

    public function editaSliderAction(Request $request, $id_slider) {

        $em = $this->getDoctrine()->getManager();
        $slider = $em->getRepository('IkukoIkukoBundle:Slider')
                ->findOneBy(array('id' => $id_slider));

        $form = $this->createForm(new NouSliderTypeForm(), $slider);

        if ($request->isMethod('POST')) {
            $form->bind($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();

                if ($form->getData()->getImatge() != null) {
                    $directori_desti = $this->container->getParameter('ikuko.directori.imatges');
                    $nom_imatge = uniqid('slider-') . '-img.jpg';
                    $slider->setRutaSlider($nom_imatge);
                    $form->getData()->getImatge()->move($directori_desti, $nom_imatge);
                }

                $em->persist($slider);
                $em->flush();

                $this->get('session')->getFlashBag()->add('notice', 'Slider modificat correctament!');

                return $this->forward('IkukoAdminBundle:Slider:llistaSliders');
            }
        }
        return $this->render('IkukoAdminBundle:Slider:edita_slider.html.twig', array(
                    'form' => $form->createView(),
                    'slider' => $slider
        ));
    }

    public function eliminaSliderAction($id_slider) {
        $em = $this->getDoctrine()->getManager();
        $slider = $em->getRepository('IkukoIkukoBundle:Slider')
                ->findOneBy(array('id' => $id_slider));

        if (!$id_slider) {
            throw $this->createNotFoundException('No s\'ha trobat cap slider amb id: ' . $id_slider);
        }
        $em->remove($slider);
        $em->flush();

        $this->get('session')->getFlashBag()->add('notice', 'Slider eliminat amb èxit!');

        return $this->forward('IkukoAdminBundle:Slider:llistaSliders');
    }

}
