<?php

namespace User\Controller;

use Zf2Mvc\Controller\ActionController,
    Zf2Mvc\Router\RouteStack,
    User\Service\User as UserService,
    Zend\Controller\Action\Helper\FlashMessenger;

class UserController extends ActionController
{
    protected $router;
    protected $userService;
    protected $flashMessenger;
    protected $registerForm;
    protected $loginForm;

    public function indexAction()
    {
        if (!$this->userService->getAuth()->hasIdentity()) {
            return $this->redirect('user', 'login');
        }
        return array('user' => $this->userService->getAuth()->getIdentity());
    }

    public function loginAction()
    {
        if ($this->userService->getAuth()->hasIdentity()) {
            return $this->redirect('user', 'index');
        }
        $request    = $this->getRequest();
        $form       = $this->getLoginForm();
        if ($request->isPost()) {
            $auth = $this->userService->authenticate(
                $request->post()->get('email'),
                $request->post()->get('password')
            );
            if ($auth) {
                return $this->redirect('user', 'index');
            } else {
                $this->getFlashMessenger('login')->addMessage('Authentication failed. Please try again.');
                return $this->redirect('user', 'login');
            }
        }
        return array(
            'loginForm' => $form,
        );
    }

    public function logoutAction()
    {
        $this->userService->logout();
        return $this->redirect('user','login');
    }

    public function registerAction()
    {
        $request    = $this->getRequest();
        $form       = $this->getRegisterForm();
        if ($request->isPost()) {
            if (false === $form->isValid($request->post()->toArray())) {
                $this->getFlashMessenger('register')->addMessage($request->post()->toArray());
                return $this->redirect('user', 'register');
            } else {
                $this->userService->createFromForm($form);
                return $this->redirect('user', 'index');
            }
        }
        return array(
            'registerForm' => $form,
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

    public function getRegisterForm()
    {
        if (null === $this->registerForm) {
            $this->registerForm = $this->userService->getRegisterForm();
            $fm = $this->getFlashMessenger('register')->getMessages(); 
            if (count($fm) > 0) $this->registerForm->isValid($fm[0]);
        }
        return $this->registerForm;
    }

    public function getLoginForm()
    {
        if (null === $this->loginForm) {
            $this->loginForm = $this->userService->getLoginForm();
            $fm = $this->getFlashMessenger('login')->getMessages(); 
            if (count($fm) > 0) $this->loginForm->setDescription($fm[0]);
        }
        return $this->loginForm;
    }
 
    protected function redirect($controller, $action)
    {
        $redirect = $this->router->assemble(
            array('controller' => $controller, 'action' => $action), 
            array('name' => 'default')
        );
        $this->response->setStatusCode(302);
        $this->response->headers()->addHeaderLine('Location', $redirect);
        return $this->response;
    }

    public function getFlashMessenger($namespace = false)
    {
        if (!$this->flashMessenger) {
            $this->flashMessenger = new FlashMessenger;
        }
        if ($namespace) {
            $this->flashMessenger->setNamespace($namespace);
        }
        return $this->flashMessenger;
    }
 
}

