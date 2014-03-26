<?php

namespace Ikuko\IkukoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class ColleccioController extends Controller 
{
    // controller que et linka a la pagina de productes d'una col.lecció des del index
    public function colleccioAction($id,$page)
    {
        $repository = $this->getDoctrine()
                ->getRepository('IkukoIkukoBundle:Producte');

        $colleccio = $repository->findByColleccioCa($id);
        
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(
                    'SELECT t, p
                       FROM IkukoIkukoBundle:Tag t
                       JOIN t.productesCa p
                      WHERE p.colleccioCa = :colleccio'
                        )->setParameter('colleccio', $id);
        
        $tags = $query->getResult();
        
        // paginador
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
                        $colleccio,
                        $this->get('request')->query->get('page', $page)/*page number*/,
                        5/*limit per page*/
                        );
        
        return $this->render('IkukoIkukoBundle:Colleccio:colleccio.html.twig', array(
            'colleccio' => $colleccio,
            'tags' => $tags,
            'pagination' => $pagination));
    }
    
    // controller que busca tots els productes d'una col.lecció amb un tag concret
    public function productesTagAction($tag,$id,$page){
        
        $repository = $this->getDoctrine()
                ->getRepository('IkukoIkukoBundle:Producte');

        $query = $repository->createQueryBuilder('p')
                ->where('p.tagCa = :tag')
                ->andwhere('p.colleccioCa = :colleccio')
                ->setParameter('tag', $tag)
                ->setParameter('colleccio', $id)
                ->getQuery();

        $productes = $query->getResult();
        
        // paginador
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
                        $productes,
                        $this->get('request')->query->get('page', $page)/*page number*/,
                        5/*limit per page*/
                        );
        
        return $this->render('IkukoIkukoBundle:Colleccio:productes_tag.html.twig', array(
            'pagination' => $pagination));
        
    }
}
