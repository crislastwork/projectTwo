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
    protected $comentari_ca;
    
    /** @ORM\Column(type="text") */
    protected $comentari_es;

    /** @ORM\Column(type="boolean") */
    protected $aprovat;
    
    /** @ORM\Column(type="datetime") */
    protected $data_publicacio;

    /**
     * @ORM\ManyToOne(targetEntity="Blog", inversedBy="comentaris_ca")
     * @ORM\JoinColumn(name="blog_ca_id", referencedColumnName="id")
     */
    protected $blog_ca;
    
    /**
     * @ORM\ManyToOne(targetEntity="Blog", inversedBy="comentaris_es")
     * @ORM\JoinColumn(name="blog_es_id", referencedColumnName="id")
     */
    protected $blog_es;

    
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

    public function getComentariCa()
    {
        return $this->comentari_ca;
    }

    public function setComentariCa($comentari_ca)
    {
        $this->comentari_ca = $comentari_ca;
    }
    
    public function getComentariEs()
    {
        return $this->comentari_es;
    }

    public function setComentariEs($comentari_es)
    {
        $this->comentari_es = $comentari_es;
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
        return $this->data_publicacio;
    }
    
    public function setDataPublicacio($dataPublicacio)
    {
        $this->data_publicacio = $dataPublicacio;
    }

    public function getBlogCa()
    {
        return $this->blog_ca;
    }
    
    public function setBlogCa(\Ikuko\BlogBundle\Entity\Blog $blogCa = null)
    {
        $this->blog_ca = $blogCa;
    }
    
    public function getBlogEs()
    {
        return $this->blog_es;
    }
    
    public function setBlogEs(\Ikuko\BlogBundle\Entity\Blog $blogEs = null)
    {
        $this->blog_es = $blogEs;
    }
    
}
