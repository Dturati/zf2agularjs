<?php
namespace User;

return [

    'router' => [
        'routes' => [

            'user-auth' => [
                'type' => 'Literal',
                'options' => [
                    'route' => '/auth',
                    'defaults' => [
                        'controller' => 'User\Controller\Auth',
                        'action'    => 'index',
                    ]
                ]
            ]

        ]
    ],

    'controllers' => [
          'invokables' => [
              'User\Controller\Auth' => 'User\Controller\AuthController',

          ]
    ],

    'view_manager' => [
            'strategies' => [
                'ViewJsonStrategy'
            ]
    ],

    'doctrine' => array(
        'driver' => array(
            __NAMESPACE__. '_driver' => array(
                'class'  => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache'  => 'array',
                'paths'  => array(__DIR__ . '/../src/'.__NAMESPACE__.'/Entity'),
            ),
            'orm_default' => array(
                'drivers' => array(
                    __NAMESPACE__.'\Entity' => __NAMESPACE__ . '_driver'
                )
            )
        )
    ),
  

];