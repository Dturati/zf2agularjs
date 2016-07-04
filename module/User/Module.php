<?php

namespace User;

class Module
{
    public function getAutoloaderConfig()
    {
        return [
            'Zend\Loader\StandardAutoloader' => [
                'namespaces' => [
                    __NAMESPACE__ => __DIR__.'/src/'.__NAMESPACE__,
                ]
            ]
        ];
    }

    public function getConfig()
    {
        return include __DIR__.'/config/module.config.php';
    }

    public function getServiceConfig()
    {
        return [
          'factories' => [
              'User\Auth\DoctrineAdapter' => function($em)
              {
                  return Auth\DoctrineAdapter($em->get('Doctrine\ORM\EntityManager'));
              }
          ]
        ];
    }
}