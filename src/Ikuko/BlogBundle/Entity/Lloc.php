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
    protected $nom_ca;
    
    /** @ORM\Column(type="string", length=30)*/
    protected $nom_es;
    
    /** @ORM\Column(type="string", length=100)*/
    protected $link;
    
    
    public function getId(){
        return $this->id;
    }
    
    public function getNomCa(){
        return $this->nom_ca;
    }
    
    public function setNomCa($nom_ca){
        $this->nom_ca = $nom_ca;
    }
    
    public function getNomEs(){
        return $this->nom_es;
    }
    
    public function setNomEs($nom_es){
        $this->nom_es = $nom_es;
    }
    
    public function getLink(){
        return $this->link;
    }
    
    public function setLink($link){
        $this->link = $link;
    }
}
