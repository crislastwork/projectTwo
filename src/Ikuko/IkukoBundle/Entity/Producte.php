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
    protected $nom_ca;
    
    /** @ORM\Column(type="string", length=30)*/
    protected $nom_es;
    
    /** @ORM\Column(type="text")*/
    protected $descripcio_ca;
    
    /** @ORM\Column(type="text")*/
    protected $descripcio_es;
    
    /** @ORM\Column(type="decimal", precision=6, scale=2)*/
    protected $preu;
    
    /** @ORM\Column(type="string", length=30)*/
    protected $talles;
    
    /** @ORM\Column(type="string", length=100, nullable=true)*/
    protected $link_compra;
    
    /** @ORM\Column(type="boolean")*/
    protected $venut;
      
    /** @ORM\Column(type="string", length=30, nullable=true)*/
    protected $ruta_imatge_a;
    
    /** @ORM\Column(type="string", length=30, nullable=true)*/
    protected $ruta_imatge_b;
    
    /** @ORM\Column(type="string", length=30, nullable=true)*/
    protected $ruta_imatge_c;
    
    /** @ORM\Column(type="string", length=30, nullable=true)*/
    protected $ruta_imatge_d;
    
    /** @Assert\Image(maxSize= "1000k") */
    protected $imatge_a;
    
    /** @Assert\Image(maxSize= "1000k") */
    protected $imatge_b;
    
    /** @Assert\Image(maxSize= "1000k") */
    protected $imatge_c;
    
    /** @Assert\Image(maxSize= "1000k") */
    protected $imatge_d;
    
    /** @ORM\Column(type="string", length=30)*/
    protected $slug;
    
    /**
     * @ORM\ManyToOne(targetEntity="Colleccio", inversedBy="productes_ca")
     * @ORM\JoinColumn(name="colleccio_ca_id", referencedColumnName="id")
     */
    protected $colleccio_ca;
    
    /**
     * @ORM\ManyToOne(targetEntity="Colleccio", inversedBy="productes_es")
     * @ORM\JoinColumn(name="colleccio_es_id", referencedColumnName="id")
     */
    protected $colleccio_es;
    
    /**
     * @ORM\ManyToOne(targetEntity="Tag", inversedBy="productes_ca")
     * @ORM\JoinColumn(name="tag_ca_id", referencedColumnName="id") 
     */
    protected $tag_ca;
    
    /**
     * @ORM\ManyToOne(targetEntity="Tag", inversedBy="productes_es")
     * @ORM\JoinColumn(name="tag_es_id", referencedColumnName="id") 
     */
    protected $tag_es;
   
    
    public function getId(){
        return $this->id;
    }
    
    public function getNomCa(){
        return $this->nom_ca;
    }
    
    public function setNomCa($nom_ca){
        $this->nom_ca = $nom_ca;
        $this->slug = Util::getSlug($nom_ca);
    }
    
    public function getNomEs(){
        return $this->nom_es;
    }
    
    public function setNomEs($nom_es){
        $this->nom_es = $nom_es;
    }
    
    public function getDescripcioCa(){
        return $this->descripcio_ca;
    }
    
    public function setDescripcioCa($descripcio_ca){
        $this->descripcio_ca = $descripcio_ca;
    }
    
    public function getDescripcioEs(){
        return $this->descripcio_es;
    }
    
    public function setDescripcioEs($descripcio_es){
        $this->descripcio_es = $descripcio_es;
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
        return $this->link_compra;
    }
    
    public function setLinkCompra($link_compra){
        $this->link_compra = $link_compra;
    }
    
    public function getVenut(){
        return $this->venut;
    }
    
    public function setVenut($venut){
        $this->venut = $venut;
    }
    
    public function getRutaImatgeA(){
        return $this->ruta_imatge_a;
    }
    
    public function setRutaImatgeA($ruta_imatge_a){
        $this->ruta_imatge_a = $ruta_imatge_a;
    }
    
    public function getRutaImatgeB(){
        return $this->ruta_imatge_b;
    }
    
    public function setRutaImatgeB($ruta_imatge_b){
        $this->ruta_imatge_b = $ruta_imatge_b;
    }
    
    public function getRutaImatgeC(){
        return $this->ruta_imatge_c;
    }
    
    public function setRutaImatgeC($ruta_imatge_c){
        $this->ruta_imatge_c = $ruta_imatge_c;
    }
    
    public function getRutaImatgeD(){
        return $this->ruta_imatge_d;
    }
    
    public function setRutaImatgeD($ruta_imatge_d){
        $this->ruta_imatge_d = $ruta_imatge_d;
    }
    
    /**
     * @param \Symfony\Component\HttpFoundation\File\UploadedFile $imatgeA
     */
    public function setImatgeA(UploadedFile $imatgeA = null) {
        $this->imatge_a = $imatgeA;
    }

    /**
     * @return UploadedFile
     */
    public function getImatgeA() {
        return $this->imatge_a;
    }
    
    /**
     * @param \Symfony\Component\HttpFoundation\File\UploadedFile $imatgeB
     */
    public function setImatgeB(UploadedFile $imatgeB = null) {
        $this->imatge_b = $imatgeB;
    }

    /**
     * @return UploadedFile
     */
    public function getImatgeB() {
        return $this->imatge_b;
    }
    
    /**
     * @param \Symfony\Component\HttpFoundation\File\UploadedFile $imatgeC
     */
    public function setImatgeC(UploadedFile $imatgeC = null) {
        $this->imatge_c = $imatgeC;
    }

    /**
     * @return UploadedFile
     */
    public function getImatgeC() {
        return $this->imatge_c;
    }
    
    /**
     * @param \Symfony\Component\HttpFoundation\File\UploadedFile $imatgeD
     */
    public function setImatgeD(UploadedFile $imatgeD = null) {
        $this->imatge_d = $imatgeD;
    }

    /**
     * @return UploadedFile
     */
    public function getImatgeD() {
        return $this->imatge_d;
    }
    
    public function getSlug() {
        return $this->slug;
    }
    
    public function getColleccioCa()
    {
        return $this->colleccio_ca;
    }

    public function setColleccioCa($colleccio_ca)
    {
        $this->colleccio_ca = $colleccio_ca;
    }
    
    public function getColleccioEs()
    {
        return $this->colleccio_es;
    }

    public function setColleccioEs($colleccio_es)
    {
        $this->colleccio_es = $colleccio_es;
    }
    
    public function getTagCa()
    {
        return $this->tag_ca;
    }

    public function setTagCa($tag_ca)
    {
        $this->tag_ca = $tag_ca;
    }
    
    public function getTagEs()
    {
        return $this->tag_es;
    }

    public function setTagEs($tag_es)
    {
        $this->tag_es = $tag_es;
    }
}
