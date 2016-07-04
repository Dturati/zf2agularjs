<?php

return  [

    'router' => [
      'routes' => [
        'rest' => [
            'type'      => 'Segment',
            'options'   => [
                'route' => '/api/:controller[/:id][/]',
                'constraints' => [
                    'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                ]
            ]
        ]
      ]

    ],

    'controllers'  => [
        'invokables' => [
            'categoria' => 'Rest\Controller\CategoriaController',
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
                'paths'  => array(__DIR__ . '/../src/' .__NAMESPACE__.'/Entity'),
            ),
            'orm_default' => array(
                'drivers' => array(
                    __NAMESPACE__.'\Entity' => __NAMESPACE__ . '_driver'
                )
            )
        )
    ),

];