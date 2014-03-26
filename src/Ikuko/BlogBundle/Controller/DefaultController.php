<?php

namespace Ikuko\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Ikuko\BlogBundle\Entity\Comentari;
use Ikuko\BlogBundle\Form\ComentariType;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction($page)
    {
        $repository = $this->getDoctrine()
                ->getRepository('IkukoBlogBundle:Blog');
        
        $query = $repository->createQueryBuilder('b')
                ->orderBy('b.dataPublicacio', 'DESC')
                ->getQuery();
        
        $blogs = $query->getResult();
        
        // paginador
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
                        $blogs,
                        $this->get('request')->query->get('page', $page)/*page number*/,
                        10/*limit per page*/
                        );

        return $this->render('IkukoBlogBundle:Default:index_blog.html.twig', array(
                'pagination' => $pagination
        ));
    }
    
    public function categoriaBlogAction($id,$page)
    {
        $repository = $this->getDoctrine()
                ->getRepository('IkukoBlogBundle:Blog');
        
        $query = $repository->createQueryBuilder('b')
                ->where('b.categoriaCa = :id')
                ->setParameter('id', $id)
                ->orderBy('b.dataPublicacio', 'DESC')
                ->getQuery();
        
        $blogs = $query->getResult();
        
        // paginador
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
                        $blogs,
                        $this->get('request')->query->get('page', $page)/*page number*/,
                        10/*limit per page*/
                        );
        
        return $this->render('IkukoBlogBundle:Default:categories_blog.html.twig', array(
                'pagination' => $pagination
        ));
    }
    
    public function detallBlogAction($id)
    {
        $repository = $this->getDoctrine()
                ->getRepository('IkukoBlogBundle:Blog');
        
        $blog = $repository->findOneById($id);
        
        $repository2 = $this->getDoctrine()
                ->getRepository('IkukoBlogBundle:Comentari');
        
        $query = $repository2->createQueryBuilder('c')
                ->where('c.blogCa = :id')
                ->setParameter('id', $id)
                ->orderBy('c.dataPublicacio', 'DESC')
                ->getQuery();

        $em = $this->getDoctrine ()->getManager ();
        $paginator = $this->get( 'knp_paginator' );
        $comments_page = $this->getRequest()->query->get( 'page', 1 ); //La pàg decomentaris, si no hi ha petició(null) per defecte és 1
        $data["comentaris"] = $paginator->paginate( $query, $comments_page, 10 ); //Els comentaris de la pàgina (10 por pàg)
    
        if ($this->getRequest()->query->get( 'page' ) == null) { //Si no hi ha petició de paginació vol dir que no s'ha fet click en un número de pàgina.
            //Recòrre les dades de la notícia.
            $data ["blog"] = $em->getRepository( 'IkukoBlogBundle:Blog' )->find ( $id );
            //Mostra la notícia i la primera pàgina de comentaris (per defecte).
            return $this->render( 'IkukoBlogBundle:Default:detall_blog.html.twig', $data);
        } else { //Si hi ha petició de paginació vol dir que s'ha fet click en un número de pàgina (PETICIÓ AJAX)
            //Mostra només la part dels comentaris de la pàgina escollida.
            return $this->render( 'IkukoBlogBundle:Comentari:comentaris.html.twig', $data );
        }
    }
    
    public function nouComentariAction(Request $request, $id, $slug)
    {

        $repository = $this->getDoctrine()->getRepository('IkukoBlogBundle:Blog');
        $blog =$repository->findOneById($id);
                
        $comentari = new Comentari();
        $form = $this->createForm(new ComentariType(), $comentari);
        
        if ($request->isMethod('POST')) {
            $form->bind($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()
                       ->getManager();
                $comentari->setComentari($form->getData()->getComentari());
                $comentari->setBlogCa($blog);
                $em->persist($comentari);
                $em->flush();

                return $this->redirect($this->generateUrl('ikuko_blog_detall', array(
                    'id' => $id,
                    'slug'  => $slug
                )));
            }
        }

        return $this->render('IkukoBlogBundle:Comentari:nou_comentari.html.twig', array(
            'form'   => $form->createView(),
            'id' => $id,
            'slug' => $slug,
                'valid' => 'no valid'
        ));
    }
    
    public function blogSidebarAction()
    {
        $repository = $this->getDoctrine()
                ->getRepository('IkukoBlogBundle:Categoria');
        
        $categories = $repository->findAll();
        
        $repository2 = $this->getDoctrine()
                ->getRepository('IkukoBlogBundle:Lloc');
        
        $llocs = $repository2->findAll();
        
        return $this->render('IkukoBlogBundle:Default:blog_sidebar.html.twig', array(
                'categories' => $categories,
                'llocs' => $llocs
        ));
    }

}
