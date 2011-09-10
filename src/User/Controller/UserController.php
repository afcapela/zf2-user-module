<?php

namespace User\Controller;

use Zf2Mvc\Controller\ActionController,
    Zf2Mvc\Router\RouteStack;

class UserController extends ActionController
{
    public function indexAction()
    {
        $redirect = $this->router->assemble(
            array('controller' => 'user', 'action' => 'login'), 
            array('name' => 'default')
        );

        $this->response->setStatusCode(302);
        $this->response->headers()->addHeaderLine('Location', $redirect);
        return $this->response;
    }

    public function loginAction()
    {
        return array();
    }

    public function setRouter(RouteStack $router)
    {
        $this->router = $router;
        return $this;
    }
}

