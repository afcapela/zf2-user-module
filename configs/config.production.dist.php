<?php
return array(
    'di' => array('instance' => array(
        'Zend\Db\Adapter\PdoMysql' => array(
            'parameters' => array(
                'config' => array(
                    'host'     => 'changeme',
                    'dbname'   => 'changeme',
                    'username' => 'changeme',
                    'password' => 'changeme',
                    'charset'  => 'UTF8',
                ),
            ),
        ),
    ),
));
