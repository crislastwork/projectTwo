<?php

namespace Ikuko\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Ikuko\BlogBundle\Entity\Categoria;
use Ikuko\AdminBundle\Form\NovaCategoriaTypeForm;
use Symfony\Component\HttpFoundation\Request;

class CategoriaController extends Controller {

    public function llistaCategoriesAction() {
        $repository = $this->getDoctrine()->getRepository('IkukoBlogBundle:Categoria');
        $categories = $repository->findAll();

        return $this->render('IkukoAdminBundle:Categoria:llista_categories.html.twig', array(
                    'categories' => $categories));
    }

    public function novaCategoriaAction(Request $request) {
        $categoria = new Categoria();
        $form = $this->createForm(new NovaCategoriaTypeForm(), $categoria);

        if ($request->isMethod('POST')) {
            $form->bind($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($categoria);
                $em->flush();

                $this->get('session')->getFlashBag()->add('notice', 'Categoria desada correctament!');
            }
            return $this->redirect($this->generateUrl('ikuko_admin_nova_categoria')
            );
        }
        return $this->render('IkukoAdminBundle:Categoria:nova_categoria.html.twig', array(
                    'form' => $form->createView(),
        ));
    }

    public function editaCategoriaAction(Request $request, $categoria) {

        $em = $this->getDoctrine()->getManager();
        $categoria = $em->getRepository('IkukoBlogBundle:Categoria')
                ->findOneBy(array('id' => $categoria));

        $form = $this->createForm(new NovaCategoriaTypeForm(), $categoria);

        if ($request->isMethod('POST')) {
            $form->bind($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($categoria);
                $em->flush();

                $this->get('session')->getFlashBag()->add('notice', 'Categoria modificada correctament!');

                return $this->forward('IkukoAdminBundle:Categoria:llistaCategories');
            }
        }
        return $this->render('IkukoAdminBundle:Categoria:edita_categoria.html.twig', array(
                    'form' => $form->createView(),
                    'categoria' => $categoria
        ));
    }

    public function eliminaCategoriaAction($categoria) {
        $em = $this->getDoctrine()->getManager();
        $categoria = $em->getRepository('IkukoBlogBundle:Categoria')
                ->findOneBy(array('id' => $categoria));

        if (!$categoria) {
            throw $this->createNotFoundException('No s\'ha trobat cap categoria amb id: ' . $categoria);
        }
        $em->remove($categoria);
        $em->flush();

        $this->get('session')->getFlashBag()->add('notice', 'Categoria eliminada amb èxit!');

        return $this->forward('IkukoAdminBundle:Categoria:llistaCategories');
    }

}
