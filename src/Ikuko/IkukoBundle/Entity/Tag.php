<?php

namespace Ikuko\IkukoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Ikuko\IkukoBundle\Util\Util;

/**
 * @ORM\Entity
 */
class Tag
{
    /** @ORM\Id 
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /** @ORM\Column(type="string", length=100)*/
    protected $tag_ca;
    
    /** @ORM\Column(type="string", length=100)*/
    protected $tag_es;
    
    /** @ORM\Column(type="string", length=100)*/
    protected $slug;
    
    /**
     * @ORM\OneToMany(targetEntity="Producte", mappedBy="tag_ca")
     */
    protected $productes_ca;
    
    /**
     * @ORM\OneToMany(targetEntity="Producte", mappedBy="tag_es")
     */
    protected $productes_es;
    
    
    public function __construct() {
        $this->productes_ca = new ArrayCollection();
        $this->productes_es = new ArrayCollection();
    }
    
    public function getId(){
        return $this->id;
    }
    
    public function getTagCa(){
        return $this->tag_ca;
    }
    
    public function setTagCa($tag_ca){
        $this->tag_ca = $tag_ca;
        $this->slug = Util::getSlug($tag_ca);
    }
    
    public function getTagEs(){
        return $this->tag_es;
    }
    
    public function setTagEs($tag_es){
        $this->tag_es = $tag_es;
    }
    
    public function getSlug(){
        return $this->slug;
    }
    
    public function getProductesCa()
    {
        return $this->productes_ca;
    }

    public function setProductesCa(ArrayCollection $productes_ca)
    {
        $this->productes_ca = $productes_ca;
    }
    
    public function getProductesEs()
    {
        return $this->productes_es;
    }

    public function setProductesEs(ArrayCollection $productes_es)
    {
        $this->productes_es = $productes_es;
    }
    
    public function __toString()
    {
        return $this->getTagCa();
    }
}
