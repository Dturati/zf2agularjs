<?php

namespace Rest;

use Zend\Mvc\MvcEvent;
use Zend\Navigation\Page\Mvc;

class Module
{

    public function onBootstrap(MvcEvent $e)
    {
        $sharedEvents = $e->getApplication()->getEventManager()->getSharedManager();
        $sharedEvents->attach('Zend\Mvc\Controller\AbstractRestfulController',
            MvcEvent::EVENT_DISPATCH,
            array($this,'postProcess'),-100);
    }

    public function getAutoloaderConfig()
    {
        return [
            'Zend\Loader\StandardAutoloader' => [
                'namespaces' => [
                    __NAMESPACE__ => __DIR__ . '/src/' .__NAMESPACE__,
                ]
            ]
        ];
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getServiceConfig()
    {
        return [
            'factories' => [
                'Rest\Service\ProcessJson' => function($sm)
                {
                    $serializer = $sm->get('jms_serializer.serializer');
                   return new Service\ProcessJson(null,null,$serializer);
                 },
                ]
            ];
    }

    public function postProcess(MvcEvent $e)
    {
        $processJson = $e->getTarget()->getServiceLocator()->get('Rest\Service\ProcessJson');
        $data = $e->getResult();
        $response = new \Zend\Http\Response();
        $processJson->setResponse($response);
        $processJson->setData($data);

        return $processJson->process();
    }

}