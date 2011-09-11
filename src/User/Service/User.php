<?php

namespace User\Service;

use Zend\Form\Form,
    User\Form\Login as LoginForm,
    User\Form\Register as RegisterForm,
    Edp\Common\DbMapper;

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
}
