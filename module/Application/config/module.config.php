<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
return array(
		'controllers' => array(
				'invokables' => array(
						'Index' => 'Application\Controller\IndexController',
						'Client\Index'=> 'Application\Controller\Client\IndexController',
						'Doctor\Index' => 'Application\Controller\Doctor\IndexController',
						'Doctor\Recipe' => 'Application\Controller\Doctor\RecipeController',
						'Pharmacy\Index' => 'Application\Controller\Pharmacy\IndexController',
						'Admin\Index' => 'Application\Controller\Admin\IndexController',
						'Admin\Auth' => 'Application\Controller\Admin\AuthController'
 						
				),
			
		),
    	'router' => array(
        	'routes' => array(
			        'doctor' => array(
			            'type'    => 'Zend\Mvc\Router\Http\Literal',
						 'options' => array(
								'route'    => '/doctor',
								'defaults' => array(
										'__NAMESPACE__' => 'Doctor',
										'controller' => 'Doctor\Index',
										'action'     => 'index',
								),
						),
						'may_terminate' => true,
						'child_routes' => array(
								'index1' => array(
										'type'    => 'Zend\Mvc\Router\Http\Segment',
										'options' => array(
												'route'    => '[/:controller[/:action[/:id]]]',
												'constraints' => array(
														'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
														'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
														'id'		 => '[0-9]*',
												),
											
										),
										'may_terminate' => true,
								),
						),
			        ),
			        'pharmacy' => array(
			        		'type'    => 'Zend\Mvc\Router\Http\Literal',
			        		'options' => array(
			        				'route'    => '/pharmacy',
			        				'defaults' => array(
			        						'__NAMESPACE__' => 'Pharmacy',
			        						'controller' => 'Pharmacy\Index',
			        						'action'     => 'index',
			        				),
			        		),
			        		//lalalala
			        		'may_terminate' => true,
			        		'child_routes' => array(
			        				'index2' => array(
			        						'type'    => 'Zend\Mvc\Router\Http\Segment',
			        						'options' => array(
			        								'route'    => '[/:controller[/:action[/:id]]]',
			        								'constraints' => array(
			        										'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
			        										'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
			        										'id'		 => '[0-9]*',
			        								),
			        									
			        						),
			        						'may_terminate' => true,
			        				),
			        		),
			        ),
			        'client' => array(
			        		'type'    => 'Zend\Mvc\Router\Http\Literal',
			        		'options' => array(
			        				'route'    => '/client',
			        				'defaults' => array(
			        						'__NAMESPACE__' => 'Client',
			        						'controller' => 'Client\Index',
			        						'action'     => 'index',
			        				),
			        		),
			        		'may_terminate' => true,
			        		'child_routes' => array(
			        				'index3' => array(
			        						'type'    => 'Zend\Mvc\Router\Http\Segment',
			        						'options' => array(
			        								'route'    => '[/:controller[/:action[/:id]]]',
			        								'constraints' => array(
			        										'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
			        										'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
			        										'id'		 => '[0-9]*',
			        								),
			        
			        						),
			        						'may_terminate' => true,
			        				),
			        		),
			        ),
			        'admin' => array(
			        		'type'    => 'Zend\Mvc\Router\Http\Literal',
			        		'options' => array(
			        				'route'    => '/admin',
			        				'defaults' => array(
			        						'__NAMESPACE__' => 'Admin',
			        						'controller' => 'Admin\Index',
			        						'action'     => 'index',
			        				),
			        		),
			        		'may_terminate' => true,
			        		'child_routes' => array(
			        				'index4' => array(
			        						'type'    => 'Zend\Mvc\Router\Http\Segment',
			        						'options' => array(
			        								'route'    => '[/:controller[/:action[/:id]]]',
			        								'constraints' => array(
			        										'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
			        										'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
			        										'id'		 => '[0-9]*',
			        								),
			        								 
			        						),
			        						'may_terminate' => true,
			        				),
			        		),
			        ),
        			
            	'home' => array(
                	'type' => 'Zend\Mvc\Router\Http\Literal',
                 	'options' => array(
	                    'route'    => '/',
	                     'defaults' => array(
	                        'controller' => 'Index',
	                        'action'     => 'index',
	                    ),
	                ),
            	),
        		
            	
    	),
 	),
 	
       'doctrine' => array(
 					'driver' => array(
 							'application_entities' => array(
 									'class' =>'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
 									'cache' => 'array',
 									'paths' => array(__DIR__ . '/../src/Application/Entity')
 							),
 	
 							'orm_default' => array(
 									'drivers' => array(
 											'Application\Entity' => 'application_entities'
 									)
 							))),
 
    'service_manager' => array(
        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
        ),
        'aliases' => array(
            'translator' => 'MvcTranslator',
        ),
    ),
    'translator' => array(
        'locale' => 'en_US',
        'translation_file_patterns' => array(
            array(
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.mo',
            ),
        ),
    ),
    
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml'
          
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    // Placeholder for console routes
    'console' => array(
        'router' => array(
            'routes' => array(
            ),
        ),
    ),
);
