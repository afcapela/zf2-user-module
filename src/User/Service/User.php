<?php

namespace User\Service;

use Zend\Form\Form,
    User\Form\Login as LoginForm;

class User
{
    protected $loginForm;

    /**
     * Get loginForm.
     *
     * @return Form
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
     */
    public function setLoginForm(Form $loginForm)
    {
        $this->loginForm = $loginForm;
        return $this;
    }
}
