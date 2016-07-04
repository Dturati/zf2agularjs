<?php

namespace Application;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getServiceConfig()
    {
        return [
            'factories' => [
                'Application\Service\Categoria' => function($sm){
                    $em = $sm->get('Doctrine\ORM\EntityManager');
                    $categoriaServive = new \Application\Service\Categoria($em);
                    return $categoriaServive;
                },

                'Application\Service\Produto' => function($sm){
                    $em = $sm->get('Doctrine\ORM\EntityManager');
                    $produtoServive = new \Application\Service\Produto($em);
                    return $produtoServive;
                },
                
            ],

        ];
    }
}
