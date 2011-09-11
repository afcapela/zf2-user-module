<?php

namespace User\Service;

use Zend\Form\Form,
    User\Form\Login as LoginForm,
    User\Form\Register as RegisterForm,
    Edp\Common\DbMapper,
    User\Model\User as UserModel;

class User
{
    /**
     * @var Zend\Form\Form
     */
    protected $loginForm;

    /**
     * @var Zend\Form\Form
     */
    protected $registerForm;

    /**
     * @var Edp\Common\DbMapper
     */
    protected $userMapper;

    public function createFromForm(Form $form)
    {
        $user = new UserModel();
        $user->setEmail($form->getValue('email'))
             ->setDisplayName($form->getValue('display_name'))
             ->setSalt($this->randomBytes(16))
             ->setPassword($this->hashPassword($form->getValue('password'), $user->getSalt()));
        $userId = $this->getUserMapper()->insert($user);
    }

    /**
     * Get loginForm.
     *
     * @return Zend\Form\Form
     */
    public function getLoginForm()
    {
        if (!$this->loginForm instanceof Form) {
            $this->loginForm = new LoginForm;
        }
        return $this->loginForm;
    }
 
    /**
     * Set loginForm.
     *
     * @param $loginForm the value to be set
     * @return User\Service\User
     */
    public function setLoginForm(Form $loginForm)
    {
        $this->loginForm = $loginForm;
        return $this;
    }
 
    /**
     * Get registerForm.
     *
     * @return Zend\Form\Form
     */
    public function getRegisterForm()
    {
        if (!$this->registerForm instanceof Form) {
            $this->registerForm = new RegisterForm;
        }
        return $this->registerForm;
    }
 
    /**
     * Set registerForm.
     *
     * @param $registerForm the value to be set
     * @return User\Service\User
     */
    public function setRegisterForm(Form $registerForm)
    {
        $this->registerForm = $registerForm;
        return $this;
    }
 
    /**
     * Get userMapper.
     *
     * @return Edp\Common\DbMapper
     */
    public function getUserMapper()
    {
        return $this->userMapper;
    }
 
    /**
     * Set userMapper.
     *
     * @param $userMapper the value to be set
     */
    public function setUserMapper(DbMapper $userMapper)
    {
        $this->userMapper = $userMapper;
        return $this;
    }

    /**
     * hashPassword 
     * 
     * @param string $password 
     * @param string $salt 
     * @return string
     */
    public function hashPassword($password, $salt)
    {
        return hash('sha512', $password.$salt);
    }

    /**
     * randomBytes 
     *
     * returns X random raw binary bytes
     * 
     * @param int $byteLength 
     * @return string
     */
    public function randomBytes($byteLength)
    {
        if (function_exists('openssl_random_pseudo_bytes')) {
           $data = openssl_random_pseudo_bytes($byteLength);
        } elseif (is_readable('/dev/urandom')) {
            $fp = @fopen('/dev/urandom','rb');
            if ($fp !== false) {
                $data = fread($fp, $byteLength);
                fclose($fp);
            }
        } elseif (class_exists('COM')) {
            // @TODO: Someone care to test on Windows? Not it!
            try {
                $capi = new COM('CAPICOM.Utilities.1');
                $data = $capi->GetRandom($btyeLength,0);
            } catch (Exception $ex) {
                // Fail silently
            }
        }
        return $data;
    }
}
