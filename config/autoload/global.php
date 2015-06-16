<?php
/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */


    return array(
 		'doctrine' => array(
 				'connection' => array(
 						'orm_default' => array(
 								'driverClass' =>'Doctrine\DBAL\Driver\PDOMySql\Driver',
 								'params' => array(
 										'host'     => 'localhost',
 										'port'     => '3306',
 										'user'     => 'root',
 										'password' => '',
 										'dbname'   => 'getrecipedb',
 								),
 						),
 				),
 		),
    		
    		'navigation' => array(
    				
    				'default' => array(
    					
    						'admin' => array(
    								'label' => 'Admin',
    								'route' => 'admin',
    								'pages' => array(
    										'users' => array(
    												'label' => 'users',
    												'route' => 'admin/index4',
    												'controller' => 'index',
    												'action'=>'viewusers',
    												),
    										'doctors' => array(
    										         'label' => 'doctors',
    										         'route' => 'admin/index4',
    										         'controller' => 'index',
    										         'action' =>'viewDoctors',
    			
    	                                 
    											    
    										),
    										
    								),
    						),
    				),
    		),

     'service_manager' => array(
         'factories' => array(
             'Zend\Db\Adapter\Adapter'
                     => 'Zend\Db\Adapter\AdapterServiceFactory',
                'Navigation'
                		 => 'Zend\Navigation\Service\DefaultNavigationFactory',
         ),
     ),
 );
