<?php

namespace CoreSystemBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * CoreSystemBundle\Entity\User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="CoreSystemBundle\Repository\UserRepository")
 * @UniqueEntity("email")
 * @UniqueEntity("username")
 */
class User implements AdvancedUserInterface, \Serializable{

    /**
     * @ORM\Column(name="first_name", type="string", length=255)
     * @Assert\NotBlank()
     */
    protected $firstName;

    /**
     * @ORM\Column(name="last_name", type="string", length=255)
     * @Assert\NotBlank()
     */
    protected $lastName;

    /**
     * @ORM\Column(name="email", type="string", length=255, unique=true)
     * @Assert\Email()
     * @Assert\NotBlank()
     */
    protected $email;

    /**
     * @ORM\Column(name="username", type="string", length=255, unique=true)
     * @Assert\NotBlank()
     */
    protected $username;

    /**
     * @ORM\Column(name="password", type="string", length=255)
     */
    protected $password;

    /**
     * @ORM\Column(name="role", type="string", length=50)
     */
    protected $role;

    /**
    * @ORM\Column(name="date_create", type="datetime", nullable=true)
    */
    protected $dateCreate;

    /**
    * @ORM\Column(name="last_active", type="datetime", nullable=true)
    */
    protected $lastActive;

    /**
     * @ORM\Column(name="is_active", type="boolean")
     */
    protected $isActive = true;

    /**
     * @ORM\Column(name="id_user", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $idUser;

    /**
     * @ORM\Column(name="salt", type="string", length=40)
     */
    protected $salt;

     /**
     * @ORM\OneToMany(targetEntity="GeneralEntity", mappedBy="user")
     */
    private $entities;

    /**
     * @ORM\OneToMany(targetEntity="GeneralEntity", mappedBy="updateuser")
     */
    private $entitiesUser;


    /**
     * @ORM\OneToMany(targetEntity="Locale", mappedBy="user")
     */
    private $locales;



    public function __construct(){
        $this->salt = base_convert(sha1(uniqid(mt_rand(), true)), 16, 36);
        $this->dateCreate = new \DateTime('now');
        $this->entities = new \Doctrine\Common\Collections\ArrayCollection();
        $this->locales = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     * @return User
     */
    public function setFirstName($firstName){
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string 
     */
    public function getFirstName(){
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     * @return User
     */
    public function setLastName($lastName){
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string 
     */
    public function getLastName(){
        return $this->lastName;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return User
     */
    public function setEmail($email){
        $this->email = $email;
        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail(){
        return $this->email;
    }

    /**
     * Set username
     *
     * @param string $username
     * @return User
     */
    public function setUsername($username){
        $this->username = $username;
        return $this;
    }

    /**
     * Get username
     *
     * @return string 
     */
    public function getUsername(){
        return $this->username;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return User
     */
    public function setPassword($password){
        $this->password = $password;
        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword(){
        return $this->password;
    }

    /**
     * Set role
     *
     * @param string $role
     * @return User
     */
    public function setRole($role){
        $this->role = $role;
        return $this;
    }

    /**
     * Get role
     *
     * @return string 
     */
    public function getRole(){
        return $this->role;
    }

    /**
     * Set dateCreate
     *
     * @param \DateTime $dateCreate
     * @return User
     */
    public function setDateCreate($dateCreate){
        $this->dateCreate = $dateCreate;
        return $this;
    }

    /**
     * Get dateCreate
     *
     * @return \DateTime 
     */
    public function getDateCreate(){
        return $this->dateCreate;
    }

    /**
     * Set lastActive
     *
     * @param \DateTime $lastActive
     * @return User
     */
    public function setLastActive($lastActive){
        $this->lastActive = $lastActive;
        return $this;
    }

    /**
     * Get lastActive
     *
     * @return \DateTime 
     */
    public function getLastActive(){
        return $this->lastActive;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     * @return User
     */
    public function setIsActive($isActive){
        $this->isActive = $isActive;
        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean 
     */
    public function getIsActive(){
        return $this->isActive;
    }

    /**
     * Get idUser
     *
     * @return integer 
     */
    public function getIdUser(){
        return $this->idUser;
    }



     /**
     * @inheritDoc
     */
    public function getSalt(){
        return $this->salt;
    }

    /**
     * @inheritDoc
     */
    public function getRoles(){
        return array($this->role);
    }


     /**
     * @inheritDoc
     */
    public function eraseCredentials(){
    }

    /**
     * @see \Serializable::serialize()
     */
    public function serialize(){
        return serialize(array(
            $this->idUser,
        ));
    }

    /**
     * @see \Serializable::unserialize()
     */
    public function unserialize($serialized){
        list (
            $this->idUser,
        ) = unserialize($serialized);
    }

    public function isEqualTo(UserInterface $user){
        return $this->username === $user->getUsername();
    }


    public function isAccountNonExpired(){
        return true;
    }

    public function isAccountNonLocked(){
        return true;
    }

    public function isCredentialsNonExpired(){
        return true;
    }

    public function isEnabled(){
        return $this->isActive;
    }

    public function __toString(){
        return $this->getFirstName().' '.$this->getLastName();
    }



    /**
     * Set salt
     *
     * @param string $salt
     * @return User
     */
    public function setSalt($salt){
        $this->salt = $salt;

        return $this;
    }




    /**
     * Add entity
     *
     * @param \CoreSystemBundle\Entity\GeneralEntity $entity
     *
     * @return User
     */
    public function addEntity(\CoreSystemBundle\Entity\GeneralEntity $entity)
    {
        $entity->setUser($this);
        $this->entities[] = $entity;

        return $this;
    }

    /**
     * Remove entity
     *
     * @param \CoreSystemBundle\Entity\Entity $entity
     */
    public function removeEntity(\CoreSystemBundle\Entity\GeneralEntity $entity)
    {
        $this->entities->removeElement($entity);
    }

    /**
     * Get entities
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEntities()
    {
        return $this->entities;
    }

    /**
     * Add locale
     *
     * @param \CoreSystemBundle\Entity\Locale $locale
     *
     * @return User
     */
    public function addLocale(\CoreSystemBundle\Entity\Locale $locale)
    {
        $locale->setUser($this);
        $this->locales[] = $locale;

        return $this;
    }

    /**
     * Remove locale
     *
     * @param \CoreSystemBundle\Entity\Locale $locale
     */
    public function removeLocale(\CoreSystemBundle\Entity\Locale $locale)
    {
        $this->locales->removeElement($locale);
    }

    /**
     * Get locales
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLocales()
    {
        return $this->locales;
    }

    /**
     * Add entitiesUser
     *
     * @param \CoreSystemBundle\Entity\GeneralEntity $entitiesUser
     *
     * @return User
     */
    public function addEntitiesUser(\CoreSystemBundle\Entity\GeneralEntity $entitiesUser)
    {
        $this->entitiesUser[] = $entitiesUser;

        return $this;
    }

    /**
     * Remove entitiesUser
     *
     * @param \CoreSystemBundle\Entity\GeneralEntity $entitiesUser
     */
    public function removeEntitiesUser(\CoreSystemBundle\Entity\GeneralEntity $entitiesUser)
    {
        $this->entitiesUser->removeElement($entitiesUser);
    }

    /**
     * Get entitiesUser
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEntitiesUser()
    {
        return $this->entitiesUser;
    }
}
