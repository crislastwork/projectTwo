<?php

namespace Ikuko\IkukoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Ikuko\IkukoBundle\Util\Util;

/**
 * @ORM\Entity
 */
class Producte
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
    
    /** @ORM\Column(type="text")*/
    protected $descripcioCa;
    
    /** @ORM\Column(type="text")*/
    protected $descripcioEs;
    
    /** @ORM\Column(type="decimal", precision=6, scale=2)*/
    protected $preu;
    
    /** @ORM\Column(type="string", length=30)*/
    protected $talles;
    
    /** @ORM\Column(type="string", length=100, nullable=true)*/
    protected $linkCompra;
    
    /** @ORM\Column(type="boolean")*/
    protected $venut;
      
    /** @ORM\Column(type="string", length=30, nullable=true)*/
    protected $rutaImatgeA;
    
    /** @ORM\Column(type="string", length=30, nullable=true)*/
    protected $rutaImatgeB;
    
    /** @ORM\Column(type="string", length=30, nullable=true)*/
    protected $rutaImatgeC;
    
    /** @ORM\Column(type="string", length=30, nullable=true)*/
    protected $rutaImatgeD;
    
    /** @Assert\Image(maxSize= "1000k") */
    protected $imatgeA;
    
    /** @Assert\Image(maxSize= "1000k") */
    protected $imatgeB;
    
    /** @Assert\Image(maxSize= "1000k") */
    protected $imatgeC;
    
    /** @Assert\Image(maxSize= "1000k") */
    protected $imatgeD;
    
    /** @ORM\Column(type="string", length=30)*/
    protected $slug;
    
    /**
     * @ORM\ManyToOne(targetEntity="Colleccio", inversedBy="productesCa")
     * @ORM\JoinColumn(name="colleccioCaId", referencedColumnName="id")
     */
    protected $colleccioCa;
    
    /**
     * @ORM\ManyToOne(targetEntity="Colleccio", inversedBy="productesEs")
     * @ORM\JoinColumn(name="colleccioEsId", referencedColumnName="id")
     */
    protected $colleccioEs;
    
    /**
     * @ORM\ManyToOne(targetEntity="Tag", inversedBy="productesCa")
     * @ORM\JoinColumn(name="tagCaId", referencedColumnName="id") 
     */
    protected $tagCa;
    
    /**
     * @ORM\ManyToOne(targetEntity="Tag", inversedBy="productesEs")
     * @ORM\JoinColumn(name="tagEsId", referencedColumnName="id") 
     */
    protected $tagEs;
   
    
    public function getId(){
        return $this->id;
    }
    
    public function getNomCa(){
        return $this->nomCa;
    }
    
    public function setNomCa($nom_ca){
        $this->nomCa = $nom_ca;
        $this->slug = Util::getSlug($nom_ca);
    }
    
    public function getNomEs(){
        return $this->nomEs;
    }
    
    public function setNomEs($nom_es){
        $this->nomEs = $nom_es;
    }
    
    public function getDescripcioCa(){
        return $this->descripcioCa;
    }
    
    public function setDescripcioCa($descripcio_ca){
        $this->descripcioCa = $descripcio_ca;
    }
    
    public function getDescripcioEs(){
        return $this->descripcioEs;
    }
    
    public function setDescripcioEs($descripcio_es){
        $this->descripcioEs = $descripcio_es;
    }
    
    public function getPreu(){
        return $this->preu;
    }
    
    public function setPreu($preu){
        $this->preu = $preu;
    }
    
    public function getTalles(){
        return $this->talles;
    }
    
    public function setTalles($talles){
        $this->talles = $talles;
    }
    
    public function getLinkCompra(){
        return $this->linkCompra;
    }
    
    public function setLinkCompra($link_compra){
        $this->linkCompra = $link_compra;
    }
    
    public function getVenut(){
        return $this->venut;
    }
    
    public function setVenut($venut){
        $this->venut = $venut;
    }
    
    public function getRutaImatgeA(){
        return $this->rutaImatgeA;
    }
    
    public function setRutaImatgeA($ruta_imatge_a){
        $this->rutaImatgeA = $ruta_imatge_a;
    }
    
    public function getRutaImatgeB(){
        return $this->rutaImatgeB;
    }
    
    public function setRutaImatgeB($ruta_imatge_b){
        $this->rutaImatgeB = $ruta_imatge_b;
    }
    
    public function getRutaImatgeC(){
        return $this->rutaImatgeC;
    }
    
    public function setRutaImatgeC($ruta_imatge_c){
        $this->rutaImatgeC = $ruta_imatge_c;
    }
    
    public function getRutaImatgeD(){
        return $this->rutaImatgeD;
    }
    
    public function setRutaImatgeD($ruta_imatge_d){
        $this->rutaImatgeD = $ruta_imatge_d;
    }
    
    /**
     * @param \Symfony\Component\HttpFoundation\File\UploadedFile $imatgeA
     */
    public function setImatgeA(UploadedFile $imatgeA = null) {
        $this->imatgeA = $imatgeA;
    }

    /**
     * @return UploadedFile
     */
    public function getImatgeA() {
        return $this->imatgeA;
    }
    
    /**
     * @param \Symfony\Component\HttpFoundation\File\UploadedFile $imatgeB
     */
    public function setImatgeB(UploadedFile $imatgeB = null) {
        $this->imatgeB = $imatgeB;
    }

    /**
     * @return UploadedFile
     */
    public function getImatgeB() {
        return $this->imatgeB;
    }
    
    /**
     * @param \Symfony\Component\HttpFoundation\File\UploadedFile $imatgeC
     */
    public function setImatgeC(UploadedFile $imatgeC = null) {
        $this->imatgeC = $imatgeC;
    }

    /**
     * @return UploadedFile
     */
    public function getImatgeC() {
        return $this->imatgeC;
    }
    
    /**
     * @param \Symfony\Component\HttpFoundation\File\UploadedFile $imatgeD
     */
    public function setImatgeD(UploadedFile $imatgeD = null) {
        $this->imatgeD = $imatgeD;
    }

    /**
     * @return UploadedFile
     */
    public function getImatgeD() {
        return $this->imatgeD;
    }
    
    public function getSlug() {
        return $this->slug;
    }
    
    public function getColleccioCa()
    {
        return $this->colleccioCa;
    }

    public function setColleccioCa($colleccio_ca)
    {
        $this->colleccioCa = $colleccio_ca;
    }
    
    public function getColleccioEs()
    {
        return $this->colleccioEs;
    }

    public function setColleccioEs($colleccio_es)
    {
        $this->colleccioEs = $colleccio_es;
    }
    
    public function getTagCa()
    {
        return $this->tagCa;
    }

    public function setTagCa($tag_ca)
    {
        $this->tagCa = $tag_ca;
    }
    
    public function getTagEs()
    {
        return $this->tagEs;
    }

    public function setTagEs($tag_es)
    {
        $this->tagEs = $tag_es;
    }
}
