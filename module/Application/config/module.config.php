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
						'Client\Auth' => 'Application\Controller\Client\AuthController',
						'Doctor\Index' => 'Application\Controller\Doctor\IndexController',
						'Doctor\Recipe' => 'Application\Controller\Doctor\RecipeController',
						'Doctor\Auth' =>'Application\Controller\Doctor\AuthController',
						'Pharmacy\Index' => 'Application\Controller\Pharmacy\IndexController',
						'Pharmacy\Auth' => 'Application\Controller\Pharmacy\AuthController',
						'Admin\Index' => 'Application\Controller\Admin\IndexController',
						'Admin\Auth' => 'Application\Controller\Admin\AuthController',
						'Home' => 'Application\Controller\HomeController',
 						
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
			        								'route'    => '[/:controller[/:action[/:idpharma[/:id]]]]',
			        								'constraints' => array(
			        										'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
			        										'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
			        										'id'		 => '[0-9]*',
			        										'idpharma'  => '[0-9]*',
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
	                        'controller' => 'Home',
	                        'action'     => 'index',
	                    ),
	                ),
            	),
        		
            	
    	),
 	),
 	
       'doctrine' => array(
       // 1) for Aithentication
       'authentication' => array( // this part is for the Auth adapter from DoctrineModule/Authentication
       		'orm_default' => array(
       				'object_manager' => 'Doctrine\ORM\EntityManager',
       				// object_repository can be used instead of the object_manager key
       				'identity_class' => 'Application\Entity\Account', //'Application\Entity\User',
       				'identity_property' => 'username', // 'username', // 'email',
       				'credential_property' => 'password', // 'password',
       				'credential_callable' => function(Application\Entity\Account $user, $passwordGiven) { // not only User
       				// return my_awesome_check_test($user->getPassword(), $passwordGiven);
       		// echo '<h1>callback user->getPassword = ' .$user->getPassword() . ' passwordGiven = ' . $passwordGiven . '</h1>';
       		//- if ($user->getPassword() == md5($passwordGiven)) { // original
       		// ToDo find a way to access the Service Manager and get the static salt from config array
       		if ($user->getPassword()== $passwordGiven &&
       				$user->getisActive() == 0) {
       					return true;
       				}
       				else {
       					return false;
       				}
       		},
       		),
       ),
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
