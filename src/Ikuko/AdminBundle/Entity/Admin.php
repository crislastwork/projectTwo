<?php

namespace Ikuko\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity
 */
class Admin implements UserInterface {
    
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\Column(type="string", length=10)
     */
    protected $login;
    
       /**
     * @ORM\Column(type="string", length=255)
     */
    protected $salt;
    
    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $password;
    
    /**
     * Set login
     *
     * @param string $login
     */
    public function setLogin($login)
    {
        $this->login = $login;
    }

    /**
     * Get login
     *
     * @return string
     */
    public function getLogin()
    {
        return $this->login;
    }
    
     /**
     * Get salt
     *
     * @return string
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * Set salt
     *
     * @param string $salt
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;
    }
    
    function eraseCredentials() {
        
    }

    function getRoles() {
        return array('ROLE_ADMIN');
    }

    function getUsername() {
        return $this->getLogin();
    }
    
    /**
     * Set password
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

   /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

}
