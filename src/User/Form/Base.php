<?php

namespace User\Form;

use Zend\Form\Form,
    Edp\Common\DbMapper;

class Base extends Form
{
    protected $userMapper;

    public function initLate()
    {
        $this->setMethod('post');

        $this->addElement('text', 'email', array(
            'filters'    => array('StringTrim'),
            'validators' => array(
                'EmailAddress',
                array('Db\NoRecordExists', true, array(
                    'adapter'   => $this->userMapper->getReadAdapter(),
                    'table'     => $this->userMapper->getTableName(),
                    'field'     => 'email'
                ))
            ),
            'required'   => true,
            'label'      => 'Email',
        ));

        $this->addElement('text', 'display_name', array(
            'filters'    => array('StringTrim'),
            'validators' => array(
                array('StringLength', true, array(3, 128))
            ),
            'required'   => true,
            'label'      => 'Display Name',
        ));

        $this->addElement('password', 'password', array(
            'filters'    => array('StringTrim'),
            'validators' => array(
                array('StringLength', true, array(6, 128))
            ),
            'required'   => true,
            'label'      => 'Password',
        ));

        $this->addElement('password', 'passwordVerify', array(
            'filters'    => array('StringTrim'),
            'validators' => array(
               array('Identical', false, array('token' => 'password'))
            ),
            'required'   => true,
            'label'      => 'Password Verify',
        ));

        $this->addElement('submit', 'submit', array(
            'ignore'   => true,
        ));

        $this->addElement('hidden', 'userId', array(
            'filters'    => array('StringTrim'),
            'required'   => true,
        ));
    }
 
    /**
     * Set userMapper.
     *
     * @param $userMapper the value to be set
     */
    public function setUserMapper(DbMapper $userMapper)
    {
        $this->userMapper = $userMapper;
        // There's gotta be a better way?
        $this->initLate();
        return $this;
    }
}

