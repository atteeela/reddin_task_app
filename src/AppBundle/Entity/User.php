<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 */
class User implements AdvancedUserInterface, \Serializable
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $first_name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $last_name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $password;

    /**
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $is_active;

    public function __construct()
    {
        $this->is_active = true;
    }

    /**
     * Set Id (Only use for testing!)
     * @return integer
     */

    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Get Id
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get first name
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->first_name;
    }

    /**
     * Set first name
     *
     * @param $firstName
     */
    public function setFirstName($firstName)
    {
        $this->first_name = $firstName;
    }

    /**
     * Get first name
     * @return mixed
     */
    public function getLastName()
    {
        return $this->last_name;
    }

    /**
     * Set last name
     *
     * @param $lastName
     */
    public function setLastName($lastName)
    {
        $this->last_name = $lastName;
    }

    /**
     * Get whether user is active
     * @return bool
     */
    public function getIsActive()
    {
        return !!$this->is_active;
    }

    /**
     * Set whether user is active
     *
     * @param $isActive
     */
    public function setIsActive($isActive)
    {
        $this->is_active = $isActive;
    }

    /**
     * Get username
     * @return mixed
     */
    public function getUsername()
    {
        return $this->email;
    }

    /**
     * Get email
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set email (Ensure it is lower case)
     *
     * @param $email
     */
    public function setEmail($email)
    {
        $this->email = strtolower($email);
    }

    /**
     * Get password hash
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set password hash
     *
     * @param $password Hashed using password_hash
     */
    public function setPassword($password)
    {
        $this->password = password_hash($password, PASSWORD_BCRYPT);
    }

    /**
     * Roles available in the system
     *
     * @return array
     */
    public function getRoles()
    {
        return array('ROLE_USER');
    }

    /**
     * Remove user credentials
     * NOT USED FOR NOW
     */
    public function eraseCredentials()
    {
        return false;
    }

    /**
     * We do not need to get the salt since it is already in the password field by default (using password_hash)
     * @return null
     */
    public function getSalt()
    {
        // you *may* need a real salt depending on your encoder
        // see section on salt below
        return null;
    }

    public function isAccountNonExpired()
    {
        return true;
    }

    public function isAccountNonLocked()
    {
        return true;
    }

    public function isCredentialsNonExpired()
    {
        return true;
    }

    public function isEnabled()
    {
        return $this->is_active;
    }

    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->first_name,
            $this->last_name,
            $this->email,
            $this->password,
            $this->is_active
            // see section on salt below
            // $this->salt,
        ));
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->first_name,
            $this->last_name,
            $this->email,
            $this->password,
            $this->is_active
            // see section on salt below
            // $this->salt
            ) = unserialize($serialized);
    }
}