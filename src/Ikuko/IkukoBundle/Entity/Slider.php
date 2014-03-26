<?php

namespace Ikuko\IkukoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @ORM\Entity
 */
class Slider 
{
    /** @ORM\Id 
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /** @ORM\Column(type="string", length=30)*/
    protected $nom;
    
    /** @ORM\Column(type="text")*/
    protected $textCa;
    
    /** @ORM\Column(type="text")*/
    protected $textEs;
    
    /** @ORM\Column(type="string", length=20)*/
    protected $color;
    
    /** @ORM\Column(type="string", length=20)*/
    protected $posicio;
    
    /** @ORM\Column(type="string", length=30)*/
    protected $rutaSlider;
    
    /** @Assert\Image(maxSize= "1000k") */
    protected $imatge;
    
    
    public function getId(){
        return $this->id;
    }
    
    public function getNom(){
        return $this->nom;
    }
    
    public function setNom($nom){
        $this->nom = $nom;
    }
    
    public function getTextCa(){
        return $this->textCa;
    }
    
    public function setTextCa($text_ca){
        $this->textCa = $text_ca;
    }
    
    public function getTextEs(){
        return $this->textEs;
    }
    
    public function setTextEs($text_es){
        $this->textEs = $text_es;
    }
    
    public function getColor(){
        return $this->color;
    }
    
    public function setColor($color){
        $this->color = $color;
    }
    
    public function getPosicio(){
        return $this->posicio;
    }
    
    public function setPosicio($posicio){
        $this->posicio = $posicio;
    }
    
    public function getRutaSlider(){
        return $this->rutaSlider;
    }
    
    public function setRutaSlider($ruta_slider){
        $this->rutaSlider = $ruta_slider;
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
}
