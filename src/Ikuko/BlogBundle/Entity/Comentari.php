<?php

namespace Ikuko\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Comentari
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /** @ORM\Column(type="string", length=50) */
    protected $usuari;

    /** @ORM\Column(type="text") */
    protected $comentari;

    /** @ORM\Column(type="boolean") */
    protected $aprovat;
    
    /** @ORM\Column(type="datetime") */
    protected $dataPublicacio;

    /**
     * @ORM\ManyToOne(targetEntity="Blog", inversedBy="comentaris")
     * @ORM\JoinColumn(name="blogCaId", referencedColumnName="id")
     */
    protected $blogCa;

    
    public function __construct()
    {
        $this->setDataPublicacio(new \DateTime());
        $this->setAprovat(true);
    }

    public function getId()
    {
        return $this->id;
    }
    
    public function getUsuari()
    {
        return $this->usuari;
    }
    
    public function setUsuari($usuari)
    {
        $this->usuari = $usuari;
    }

    public function getComentari()
    {
        return $this->comentari;
    }

    public function setComentari($comentari)
    {
        $this->comentari = $comentari;
    }
    
    public function getAprovat()
    {
        return $this->aprovat;
    }
    
    public function setAprovat($aprovat)
    {
        $this->aprovat = $aprovat;
    }

    public function getDataPublicacio()
    {
        return $this->dataPublicacio;
    }
    
    public function setDataPublicacio($dataPublicacio)
    {
        $this->dataPublicacio = $dataPublicacio;
    }

    public function getBlogCa()
    {
        return $this->blogCa;
    }
    
    public function setBlogCa($blogCa)
    {
        $this->blogCa = $blogCa;
    }
    
}
