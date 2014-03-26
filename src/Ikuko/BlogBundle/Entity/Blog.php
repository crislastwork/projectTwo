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
    protected $titolCa;
    
    /** @ORM\Column(type="string", length=100) */
    protected $titolEs;

    /** @ORM\Column(type="text") */
    protected $blogCa;
    
    /** @ORM\Column(type="text") */
    protected $blogEs;
    
    /** @ORM\Column(type="string", length=50) */
    protected $autor;
    
    /** @ORM\Column(type="string", length=30, nullable=true)*/
    protected $rutaImatge;

    /** @Assert\Image(maxSize= "1000k") */
    protected $imatge;
        
    /**
     * @ORM\ManyToOne(targetEntity="Categoria", inversedBy="blogsCa")
     * @ORM\JoinColumn(name="categoriaCaId", referencedColumnName="id")
     */
    protected $categoriaCa;
    
    /**
     * @ORM\ManyToOne(targetEntity="Categoria", inversedBy="blogsEs")
     * @ORM\JoinColumn(name="categoriaEsId", referencedColumnName="id")
     */
    protected $categoriaEs;
    
    /** @ORM\Column(type="datetime") */
    protected $dataPublicacio;
    
    /** @ORM\Column(type="string", length=50) */
    protected $slug;
    
    /** @ORM\OneToMany(targetEntity="Comentari", mappedBy="blogCa",  orphanRemoval=true) */
    protected $comentaris;
    

    public function __construct() {
        $this->comentaris = new ArrayCollection();

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
    
    public function getBlogCa(){
        return $this->blogCa;
    }
    
    public function setBlogCa($blog_ca){
        $this->blogCa = $blog_ca;
    }
    
    public function getBlogEs(){
        return $this->blogEs;
    }
    
    public function setBlogEs($blog_es){
        $this->blogEs = $blog_es;
    }
    
    public function getAutor(){
        return $this->autor;
    }
    
    public function setAutor($autor){
        $this->autor = $autor;
    }
    
    public function getRutaImatge(){
        return $this->rutaImatge;
    }
    
    public function setRutaImatge($rutaImatge){
        $this->rutaImatge = $rutaImatge;
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
        return $this->categoriaCa;
    }

    public function setCategoriaCa($categoria_ca)
    {
        $this->categoriaCa = $categoria_ca;
    }
    
    public function getCategoriaEs()
    {
        return $this->categoriaEs;
    }

    public function setCategoriaEs($categoria_es)
    {
        $this->categoriaEs = $categoria_es;
    }
    
    public function getDataPublicacio()
    {
        return $this->dataPublicacio;
    }

    public function setDataPublicacio($data_publicacio)
    {
        $this->dataPublicacio = $data_publicacio;
    }
        
    public function getSlug(){
        return $this->slug;
    }

    /**
     * @param \Ikuko\BlogBundle\Entity\Comentari $comentaris
     * @return Blog
     */
    public function addComentari(\Ikuko\BlogBundle\Entity\Comentari $comentaris)
    {
        $this->comentaris[] = $comentaris;

        return $this;
    }

    /**
     * @param \Ikuko\BlogBundle\Entity\Comentari $comentaris
     */
    public function removeComentari(\Ikuko\BlogBundle\Entity\Comentari $comentaris)
    {
        $this->comentaris->removeElement($comentaris);
    }

    /**
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getComentaris()
    {
        return $this->comentaris;
    }

    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }
    
    public function __toString()
    {
        return $this->getBlogCa();
    }
}
