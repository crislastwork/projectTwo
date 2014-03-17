<?php

namespace Ikuko\IkukoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Ikuko\IkukoBundle\Util\Util;

/**
 * @ORM\Entity
 */
class Colleccio 
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
    protected $nom_imatge;

    /** @ORM\Column(type="string", length=30)*/
    protected $ruta_imatge;
    
    /** @Assert\Image(maxSize= "1000k") */
    protected $imatge;
    
    /** @ORM\Column(type="string", length=30)*/
    protected $slug;

    /**
     * @ORM\OneToMany(targetEntity="Producte", mappedBy="colleccio_ca")
     */
    protected $productes_ca;
    
    /**
     * @ORM\OneToMany(targetEntity="Producte", mappedBy="colleccio_es")
     */
    protected $productes_es;
    
    
    public function __construct() {
        $this->productes_ca = new ArrayCollection();
        $this->productes_es = new ArrayCollection();
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
    
    public function getNomImatge(){
        return $this->nom_imatge;
    }
    
    public function setNomImatge($nom_imatge){
        $this->nom_imatge = $nom_imatge;
    }
    
    public function getRutaImatge(){
        return $this->ruta_imatge;
    }
    
    public function setRutaImatge($ruta_imatge){
        $this->ruta_imatge = $ruta_imatge;
    }
    
    /**
     * @return UploadedFile
     */
    public function getImatge() {
        return $this->imatge;
    }
    
    /**
     * @param \Symfony\Component\HttpFoundation\File\UploadedFile $imatge
     */
    public function setImatge(UploadedFile $imatge = null) {
        $this->imatge = $imatge;
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
        return $this->getTitolCa();
    }
}
