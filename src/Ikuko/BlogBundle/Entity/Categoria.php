<?php

namespace Ikuko\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Ikuko\IkukoBundle\Util\Util;

/**
 * @ORM\Entity
 * 
 */
class Categoria 
{
    /** @ORM\Id 
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /** @ORM\Column(type="string", length=30)*/
    protected $titolCa;
    
    /** @ORM\Column(type="string", length=30)*/
    protected $titolEs;
    
    /** @ORM\Column(type="string", length=30)*/
    protected $slug;

    /**
     * @ORM\OneToMany(targetEntity="Blog", mappedBy="categoriaCa")
     */
    protected $blogsCa;
    
    /**
     * @ORM\OneToMany(targetEntity="Blog", mappedBy="categoriaEs")
     */
    protected $blogsEs;
    
    
    public function __construct() {
        $this->blogsCa = new ArrayCollection();
        $this->blogsEs = new ArrayCollection();
    }
    
    public function getId(){
        return $this->id;
    }
    
    public function getTitolCa(){
        return $this->titolCa;
    }
    
    public function setTitolCa($titol_ca){
        $this->titolCa = $titol_ca;
        $this->slug = Util::getSlug($titol_ca);
    }
    
    public function getTitolEs(){
        return $this->titolEs;
    }
    
    public function setTitolEs($titol_es){
        $this->titolEs = $titol_es;
    }
        
    public function getSlug(){
        return $this->slug;
    }
    
    public function getBlogsCa()
    {
        return $this->blogsCa;
    }

    public function setBlogsCa(ArrayCollection $blogs_ca)
    {
        $this->blogsCa = $blogs_ca;
    }
    
    public function getBlogsEs()
    {
        return $this->blogsEs;
    }

    public function setBlogsEs(ArrayCollection $blogs_es)
    {
        $this->blogsEs = $blogs_es;
    }
    
    public function __toString()
    {
        return $this->getTitolCa();
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Categoria
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Add blogsCa
     *
     * @param \Ikuko\BlogBundle\Entity\Blog $blogsCa
     * @return Categoria
     */
    public function addBlogsCa(\Ikuko\BlogBundle\Entity\Blog $blogsCa)
    {
        $this->blogsCa[] = $blogsCa;

        return $this;
    }

    /**
     * Remove blogsCa
     *
     * @param \Ikuko\BlogBundle\Entity\Blog $blogsCa
     */
    public function removeBlogsCa(\Ikuko\BlogBundle\Entity\Blog $blogsCa)
    {
        $this->blogsCa->removeElement($blogsCa);
    }

    /**
     * Add blogsEs
     *
     * @param \Ikuko\BlogBundle\Entity\Blog $blogsEs
     * @return Categoria
     */
    public function addBlogsE(\Ikuko\BlogBundle\Entity\Blog $blogsEs)
    {
        $this->blogsEs[] = $blogsEs;

        return $this;
    }

    /**
     * Remove blogsEs
     *
     * @param \Ikuko\BlogBundle\Entity\Blog $blogsEs
     */
    public function removeBlogsE(\Ikuko\BlogBundle\Entity\Blog $blogsEs)
    {
        $this->blogsEs->removeElement($blogsEs);
    }
}
