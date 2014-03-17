<?php

namespace Ikuko\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Ikuko\IkukoBundle\Util\Util;

/**
 * 
 * @ORM\Entity
 * 
 */
class Blog {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /** @ORM\Column(type="string", length=100) */
    protected $titol_ca;
    
    /** @ORM\Column(type="string", length=100) */
    protected $titol_es;

    /** @ORM\Column(type="text") */
    protected $blog_ca;
    
    /** @ORM\Column(type="text") */
    protected $blog_es;
    
    /** @ORM\Column(type="string", length=50) */
    protected $autor;
    
    /** @ORM\Column(type="string", length=30, nullable=true)*/
    protected $ruta_imatge;

    /** @Assert\Image(maxSize= "1000k") */
    protected $imatge;
        
    /**
     * @ORM\ManyToOne(targetEntity="Categoria", inversedBy="blogs_ca")
     * @ORM\JoinColumn(name="categoria_ca_id", referencedColumnName="id")
     */
    protected $categoria_ca;
    
    /**
     * @ORM\ManyToOne(targetEntity="Categoria", inversedBy="blogs_es")
     * @ORM\JoinColumn(name="categoria_es_id", referencedColumnName="id")
     */
    protected $categoria_es;
    
    /** @ORM\Column(type="datetime") */
    protected $data_publicacio;
    
    /** @ORM\Column(type="string", length=50) */
    protected $slug;
    
    /** @ORM\OneToMany(targetEntity="Comentari", mappedBy="blog_ca") */
    protected $comentaris_ca;
    
    /** @ORM\OneToMany(targetEntity="Comentari", mappedBy="blog_es") */
    protected $comentaris_es;
    

    public function __construct() {
        $this->comentaris_ca = new ArrayCollection();
        $this->comentaris_es = new ArrayCollection();
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
    
    public function getBlogCa(){
        return $this->blog_ca;
    }
    
    public function setBlogCa($blog_ca){
        $this->blog_ca = $blog_ca;
    }
    
    public function getBlogEs(){
        return $this->blog_es;
    }
    
    public function setBlogEs($blog_es){
        $this->blog_es = $blog_es;
    }
    
    public function getAutor(){
        return $this->autor;
    }
    
    public function setAutor($autor){
        $this->autor = $autor;
    }
    
    public function getRutaImatge(){
        return $this->ruta_imatge;
    }
    
    public function setRutaImatge($rutaImatge){
        $this->ruta_imatge = $rutaImatge;
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
    
    public function getCategoriaCa()
    {
        return $this->categoria_ca;
    }

    public function setCategoriaCa($categoria_ca)
    {
        $this->categoria_ca = $categoria_ca;
    }
    
    public function getCategoriaEs()
    {
        return $this->categoria_es;
    }

    public function setCategoriaEs($categoria_es)
    {
        $this->categoria_es = $categoria_es;
    }
    
    public function getDataPublicacio()
    {
        return $this->data_publicacio;
    }

    public function setDataPublicacio($data_publicacio)
    {
        $this->data_publicacio = $data_publicacio;
    }
        
    public function getSlug(){
        return $this->slug;
    }

    /**
     * @param \Ikuko\BlogBundle\Entity\Comentari $comentaris_ca
     * @return Blog
     */
    public function addComentariCa(\Ikuko\BlogBundle\Entity\Comentari $comentaris_ca)
    {
        $this->comentaris_ca[] = $comentaris_ca;

        return $this;
    }

    /**
     * @param \Ikuko\BlogBundle\Entity\Comentari $comentaris_ca
     */
    public function removeComentariCa(\Ikuko\BlogBundle\Entity\Comentari $comentaris_ca)
    {
        $this->comentaris_ca->removeElement($comentaris_ca);
    }

    /**
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getComentarisCa()
    {
        return $this->comentaris_ca;
    }
    
    /**
     * @param \Ikuko\BlogBundle\Entity\Comentari $comentaris_es
     * @return Blog
     */
    public function addComentariEs(\Ikuko\BlogBundle\Entity\Comentari $comentaris_es)
    {
        $this->comentaris_es[] = $comentaris_es;

        return $this;
    }

    /**
     * @param \Ikuko\BlogBundle\Entity\Comentari $comentaris_es
     */
    public function removeComentariEs(\Ikuko\BlogBundle\Entity\Comentari $comentaris_es)
    {
        $this->comentaris_es->removeElement($comentaris_es);
    }

    /**
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getComentarisEs()
    {
        return $this->comentaris_es;
    }
    
}
