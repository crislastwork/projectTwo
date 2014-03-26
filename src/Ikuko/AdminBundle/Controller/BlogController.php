<?php

namespace Ikuko\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Ikuko\BlogBundle\Entity\Blog;
use Ikuko\AdminBundle\Form\NouBlogTypeForm;
use Symfony\Component\HttpFoundation\Request;


class BlogController extends Controller {

    public function llistaBlogsAction() {
        $repository = $this->getDoctrine()->getRepository('IkukoBlogBundle:Blog');
        $blogs = $repository->findAll();

        return $this->render('IkukoAdminBundle:Blog:llista_blogs.html.twig', array(
                    'blogs' => $blogs));
    }
    

    public function nouBlogAction(Request $request) {
        $blog = new Blog();
        
        $form = $this->createForm(new NouBlogTypeForm(), $blog);

        if ($request->isMethod('POST')) {

            $form->bind($request);
            
            if ($form->getData()->getImatge() == null) {
                $this->get('session')->getFlashBag()->add('notice', 'Afegeix una imatge abans de desar!');
                return $this->redirect($this->generateUrl('ikuko_admin_nou_blog'));
            } else {
                
                if ($form->isValid()) {
                    $em = $this->getDoctrine()->getManager();
                    
                    $blog->setCategoriaEs($form->getData()->getCategoriaCa());
                    
                    $directori_desti = $this->container->getParameter('ikuko.directori.imatges');
                    $nom_imatge = uniqid('blogprin-') . '-img.jpg';
                    $blog->setRutaImatge($nom_imatge);
                    $form->getData()->getImatge()->move($directori_desti, $nom_imatge);
                    $em->persist($blog);
                    $em->flush();

                    $this->get('session')->getFlashBag()->add('notice', 'Blog desat correctament!');
                }
                return $this->redirect($this->generateUrl('ikuko_admin_nou_blog')
                );
            }
        }
        return $this->render('IkukoAdminBundle:Blog:nou_blog.html.twig', array(
                    'form' => $form->createView()
        ));
    }

    public function editaBlogAction(Request $request, $id_blog) {

        $em = $this->getDoctrine()->getManager();
        $blog = $em->getRepository('IkukoBlogBundle:Blog')
                ->findOneBy(array('id' => $id_blog));

        $form = $this->createForm(new NouBlogTypeForm(), $blog);

        if ($request->isMethod('POST')) {
            $form->bind($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                
                 if ($form->getData()->getImatge() != null) {
                    $directori_desti = $this->container->getParameter('ikuko.directori.imatges');
                    $nom_imatge = uniqid('blogprin-') . '-img.jpg';
                    $blog->setRutaImatge($nom_imatge);
                    $form->getData()->getImatge()->move($directori_desti, $nom_imatge);
                }
                
                $em->persist($blog);
                $em->flush();

                $this->get('session')->getFlashBag()->add('notice', 'Blog modificat correctament!');

                return $this->forward('IkukoAdminBundle:Blog:llistaBlogs');
            }
        }
        return $this->render('IkukoAdminBundle:Blog:edita_blog.html.twig', array(
                    'form' => $form->createView(),
                    'blog' => $blog
        ));
    }

    public function eliminaBlogAction($id_blog) {
        $em = $this->getDoctrine()->getManager();
        $blog = $em->getRepository('IkukoBlogBundle:Blog')
                ->findOneBy(array('id' => $id_blog));

        if (!$id_blog) {
            throw $this->createNotFoundException('No s\'ha trobat cap blog amb id: ' . $id_blog);
        }
        $em->remove($blog);
        $em->flush();

        $this->get('session')->getFlashBag()->add('notice', 'Blog eliminat amb èxit!');

        return $this->forward('IkukoAdminBundle:Blog:llistaBlogs');
    }

}
