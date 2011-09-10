<?php

namespace User\Form;

use Zend\Form\Form;

class Login extends Form
{

    public function init()
    {
        $this->setMethod('post');

        $this->addElement('text', 'email', array(
            'filters'    => array('StringTrim'),
            'validators' => array(
                'EmailAddress',
            ),
            'required'   => true,
            'label'      => 'Email',
        ));
        
        $this->addElement('password', 'password', array(
            'filters'    => array('StringTrim'),
            'validators' => array(
                array('StringLength', true, array(6, 999))
            ),
            'required'   => true,
            'label'      => 'Password',
        ));

        $this->addElement('submit', 'login', array(
            'ignore'   => true,
            'label'    => 'Sign In',
        ));

        //$this->setDecorators(array(
        //    'FormElements',
        //    array('HtmlTag', array('tag' => 'dl', 'class' => 'form')),
        //    array('Description', array('placement' => 'prepend', 'class' => 'error')),
        //    'Form'
        //));
        
        /*
         * Not currently working on ZF2 master
        $this->addElement('hash', 'csrf', array(
            'ignore' => true,
        ));
         */
    }
}
