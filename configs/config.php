<?php
return array(
    'di' => array('instance' => array(
        'alias' => array(
            'user' => 'User\Controller\UserController',
        ),
        'User\Controller\UserController' => array(
            'parameters' => array(
                'router' => 'Zf2Mvc\Router\SimpleRouteStack',
            ),
        ),
        'Zend\View\PhpRenderer' => array('methods' => array(
            'setResolver' => array(
                'options' => array(
                    'script_paths' => array(
                        'user' => __DIR__ . '/../views',
                    ),
                ),
            ),
        )),
    )),
);

