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
    protected $titolCa;
    
    /** @ORM\Column(type="string", length=30)*/
    protected $titolEs;
    
    /** @ORM\Column(type="string", length=30)*/
    protected $nomImatge;

    /** @ORM\Column(type="string", length=30)*/
    protected $rutaImatge;
    
    /** @Assert\Image(maxSize= "1000k") */
    protected $imatge;
    
    /** @ORM\Column(type="string", length=30)*/
    protected $slug;
    
    /** @ORM\Column(type="datetime") */
    protected $dataCreacio;

    /**
     * @ORM\OneToMany(targetEntity="Producte", mappedBy="colleccioCa")
     */
    protected $productesCa;
    
    /**
     * @ORM\OneToMany(targetEntity="Producte", mappedBy="colleccioEs")
     */
    protected $productesEs;
    
    
    public function __construct() {
        $this->productesCa = new ArrayCollection();
        $this->productesEs = new ArrayCollection();
        $this->dataCreacio = new \DateTime();
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
    
    public function getNomImatge(){
        return $this->nomImatge;
    }
    
    public function setNomImatge($nom_imatge){
        $this->nomImatge = $nom_imatge;
    }
    
    public function getRutaImatge(){
        return $this->rutaImatge;
    }
    
    public function setRutaImatge($ruta_imatge){
        $this->rutaImatge = $ruta_imatge;
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
    
    public function setDataCreacio($dataCreacio){
        $this->dataCreacio = $dataCreacio;
    }
    
    public function getDataCreacio(){
        return $this->dataCreacio;
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
        return $this->getTitolCa();
    }
}
