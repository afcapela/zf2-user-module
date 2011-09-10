<?php

namespace User\Model;

use \DateTime;

class User
{
    /**
     * @var int
     */
    protected $userId;

    /**
     * @var string Email for login credential / communication
     */
    protected $email;

    /**
     * @var string Name for public display
     */
    protected $displayName;

    /**
     * @var string sha256, salted password
     */
    protected $password;
    /**
     * @var string 16 byte random binary salt
     */
    protected $salt;

    /**
     * @var DateTime Date/time of the user's last login
     */
    protected $lastLogin;

    /**
     * @var string IP address user last logged in from
     */
    protected $lastIp;

    /**
     * @var DateTime Date/time the user registered
     */
    protected $registerTime;

    /**
     * @var string IP address the user registered from
     */
    protected $registerIp;

 
    /**
     * Get userId.
     *
     * @return int
     */
    public function getUserId()
    {
        return $this->userId;
    }
 
    /**
     * Set userId.
     *
     * @param $userId the value to be set
     * @return User\Model\User
     */
    public function setUserId($userId)
    {
        $this->userId = (int) $userId;
        return $this;
    }
 
    /**
     * Get email.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }
 
    /**
     * Set email.
     *
     * @param $email the value to be set
     * @return User\Model\User
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }
 
    /**
     * Get displayName.
     *
     * @return string
     */
    public function getDisplayName()
    {
        return $this->displayName;
    }
 
    /**
     * Set displayName.
     *
     * @param $displayName the value to be set
     * @return User\Model\User
     */
    public function setDisplayName($displayName)
    {
        $this->displayName = $displayName;
        return $this;
    }
 
    /**
     * Get password.
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }
 
    /**
     * Set password.
     *
     * @param $password the value to be set
     * @return User\Model\User
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }
 
    /**
     * Get salt.
     *
     * @return string
     */
    public function getSalt()
    {
        return $this->salt;
    }
 
    /**
     * Set salt.
     *
     * @param $salt the value to be set
     * @return User\Model\User
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;
        return $this;
    }
 
    /**
     * Get lastLogin.
     *
     * @return DateTime
     */
    public function getLastLogin()
    {
        return $this->lastLogin;
    }
 
    /**
     * Set lastLogin.
     *
     * @param $lastLogin the value to be set
     * @return User\Model\User
     */
    public function setLastLogin($lastLogin)
    {
        $this->lastLogin = new DateTime($lastLogin);
        return $this;
    }
 
    /**
     * Get lastIp.
     *
     * @return string
     */
    public function getLastIp()
    {
        return $this->lastIp;
    }
 
    /**
     * Set lastIp.
     *
     * @param $lastIp the value to be set
     * @return User\Model\User
     */
    public function setLastIp($lastIp)
    {
        $this->lastIp = $lastIp;
        return $this;
    }
 
    /**
     * Get registerTime.
     *
     * @return DateTime
     */
    public function getRegisterTime()
    {
        return $this->registerTime;
    }
 
    /**
     * Set registerTime.
     *
     * @param $registerTime the value to be set
     * @return User\Model\User
     */
    public function setRegisterTime($registerTime)
    {
        $this->registerTime = new DateTime($registerTime);
        return $this;
    }
 
    /**
     * Get registerIp.
     *
     * @return string
     */
    public function getRegisterIp()
    {
        return $this->registerIp;
    }
 
    /**
     * Set registerIp.
     *
     * @param $registerIp the value to be set
     */
    public function setRegisterIp($registerIp)
    {
        $this->registerIp = $registerIp;
        return $this;
    }
}
