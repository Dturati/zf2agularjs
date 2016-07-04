<?php

namespace User\Controller;

use Zend\Mvc\Controller\AbstractActionController;

use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Storage\Session as SessionStorage;

use Zend\View\Model\JsonModel;

class AuthController extends AbstractActionController
{
    public function indexAction()
    {

        $request = $this->getRequest();
        if($request->isPost())
        {
            $data = $request->getPost();

            $auth = new AuthenticationService();
            $sessionStorage = new SessionStorage();
            $auth->setStorage($sessionStorage);

            $authAdapater = $this->getServiceLocator()->get('User\Auth\DoctrineAdapter');
            $authAdapater->setUserName($data['username'])
                        ->setPassword($data['password']);

            $result = $auth->authenticate($authAdapater);

            if($request->isValid()){
                $sessionStorage->write($auth->getIdentity()['user'],null);
                return new JsonModel(['sucesses' => false]);
            }else{
                    
            }

        }
        return new JsonModel(['sucesses' => false]);
    }
}