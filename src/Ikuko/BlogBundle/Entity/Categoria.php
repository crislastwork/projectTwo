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
    protected $titol_ca;
    
    /** @ORM\Column(type="string", length=30)*/
    protected $titol_es;
    
    /** @ORM\Column(type="string", length=30)*/
    protected $slug;

    /**
     * @ORM\OneToMany(targetEntity="Blog", mappedBy="categoria_ca")
     */
    protected $blogs_ca;
    
    /**
     * @ORM\OneToMany(targetEntity="Blog", mappedBy="categoria_es")
     */
    protected $blogs_es;
    
    
    public function __construct() {
        $this->blogs_ca = new ArrayCollection();
        $this->blogs_es = new ArrayCollection();
    }
    
    public function getId(){
        return $this->id;
    }
    
    public function getTitolCa(){
        return $this->titol_ca;
    }
    
    public function setTitolCa($titol_ca){
        $this->titol_ca = $titol_ca;
        $this->slug = Util::getSlug($titol_ca);
    }
    
    public function getTitolEs(){
        return $this->titol_es;
    }
    
    public function setTitolEs($titol_es){
        $this->titol_es = $titol_es;
    }
        
    public function getSlug(){
        return $this->slug;
    }
    
    public function getBlogsCa()
    {
        return $this->blogs_ca;
    }

    public function setBlogsCa(ArrayCollection $blogs_ca)
    {
        $this->blogs_ca = $blogs_ca;
    }
    
    public function getBlogsEs()
    {
        return $this->blogs_es;
    }

    public function setBlogsEs(ArrayCollection $blogs_es)
    {
        $this->blogs_es = $blogs_es;
    }
    
    public function __toString()
    {
        return $this->getTitolCa();
    }
}
