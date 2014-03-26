<?php

namespace Ikuko\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Lloc
{
    /** @ORM\Id 
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /** @ORM\Column(type="string", length=30)*/
    protected $nomCa;
    
    /** @ORM\Column(type="string", length=30)*/
    protected $nomEs;
    
    /** @ORM\Column(type="string", length=100)*/
    protected $link;
    
    
    public function getId(){
        return $this->id;
    }
    
    public function getNomCa(){
        return $this->nomCa;
    }
    
    public function setNomCa($nom_ca){
        $this->nomCa = $nom_ca;
    }
    
    public function getNomEs(){
        return $this->nomEs;
    }
    
    public function setNomEs($nom_es){
        $this->nomEs = $nom_es;
    }
    
    public function getLink(){
        return $this->link;
    }
    
    public function setLink($link){
        $this->link = $link;
    }
}
