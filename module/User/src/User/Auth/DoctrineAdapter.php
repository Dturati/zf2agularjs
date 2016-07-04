<?php

namespace User\Auth;

use Doctrine\ORM\EntityManager;
use Zend\Authentication\Adapter\AdapterInterface,
    Zend\Authentication\Result;


class DoctrineAdapter implements AdapterInterface
{

    /**
     * @var EntityManager
     */
    protected $em;

    protected $userName;
    protected $password;

    public function __contruct(EntityManager $em)
    {
        $this->em = $em;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUserName()
    {
        return $this->userName;
    }

    /**
     * @param mixed $userName
     */
    public function setUserName($userName)
    {
        $this->userName = $userName;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }



    public function authenticate()
    {
        $repository = $this->em->getRepository('User\Entity\User');
        $user = $repository->findOneBy(['userName' => $this->getUserName(),'password' => $this->getPassword()]);

        if($user)
        {
            return new Result(Result::SUCCESS,array('user' => $user, array('ok')));
        }else{
            return new Result(Result::FAILURE_CREDENTIAL_INVALID,null,array());
        }
    }

}