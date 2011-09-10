<?php

namespace User\Controller;

use Zf2Mvc\Controller\ActionController,
    Zf2Mvc\Router\RouteStack,
    User\Service\User as UserService;

class UserController extends ActionController
{
    protected $router;
    protected $userService;

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
        return array(
            'loginForm' => $this->userService->getLoginForm()
        );
    }

    public function setRouter(RouteStack $router)
    {
        $this->router = $router;
        return $this;
    }
    
    public function setUserService(UserService $userService)
    {
        $this->userService = $userService;
        return $this;
    }
}

