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
    protected $tagCa;
    
    /** @ORM\Column(type="string", length=100)*/
    protected $tagEs;
    
    /** @ORM\Column(type="string", length=100)*/
    protected $slug;
    
    /**
     * @ORM\OneToMany(targetEntity="Producte", mappedBy="tagCa")
     */
    protected $productesCa;
    
    /**
     * @ORM\OneToMany(targetEntity="Producte", mappedBy="tagEs")
     */
    protected $productesEs;
    
    
    public function __construct() {
        $this->productesCa = new ArrayCollection();
        $this->productesEs = new ArrayCollection();
    }
    
    public function getId(){
        return $this->id;
    }
    
    public function getTagCa(){
        return $this->tagCa;
    }
    
    public function setTagCa($tag_ca){
        $this->tagCa = $tag_ca;
        $this->slug = Util::getSlug($tag_ca);
    }
    
    public function getTagEs(){
        return $this->tagEs;
    }
    
    public function setTagEs($tag_es){
        $this->tagEs = $tag_es;
    }
    
    public function getSlug(){
        return $this->slug;
    }
    
    public function getProductesCa()
    {
        return $this->productesCa;
    }

    public function setProductesCa(ArrayCollection $productes_ca)
    {
        $this->productesCa = $productes_ca;
    }
    
    public function getProductesEs()
    {
        return $this->productesEs;
    }

    public function setProductesEs(ArrayCollection $productes_es)
    {
        $this->productesEs = $productes_es;
    }
    
    public function __toString()
    {
        return $this->getTagCa();
    }
}
