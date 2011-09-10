<?php

namespace User\Form;

use Zend\Form\Form;

class Register extends Base
{
    public function init()
    {
        parent::init();
        $this->removeElement('userId');
        $this->getElement('submit')->setLabel('Register');
    }
}
