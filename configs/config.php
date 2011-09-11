<?php
$config = array(
    'di' => array('instance' => array(
        'alias' => array(
            'user' => 'User\Controller\UserController',
        ),
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
        'User\Service\User' => array(
            'parameters' => array(
                'userMapper'   => 'User\Model\Mapper\User',
                'registerForm' => 'User\Form\Register',
                'loginForm'    => 'User\Form\Login',
            ),
        ),
        'User\Model\Mapper\User' => array(
            'parameters' => array(
                'readAdapter'  => 'Zend\Db\Adapter\PdoMysql',
                'writeAdapter' => 'Zend\Db\Adapter\PdoMysql',
            ),
        ),
        'User\Form\Register' => array (
            'parameters' => array(
                'userMapper' => 'User\Model\Mapper\User',
            ),
        ),
        'User\Controller\UserController' => array(
            'parameters' => array(
                'router'       => 'Zf2Mvc\Router\SimpleRouteStack',
                'userService'  => 'User\Service\User',
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
if (file_exists(__DIR__ . '/config.' . APPLICATION_ENV . '.php')) {
    $config = new Zend\Config\Config($config, true);
    $config->merge(new Zend\Config\Config(include __DIR__ . '/config.' . APPLICATION_ENV . '.php'));
    return $config->toArray();
}
return $config;
