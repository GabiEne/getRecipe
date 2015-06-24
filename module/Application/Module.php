<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Zend\Mvc\ModuleRouteListener;
use Zend\Authentication\AuthenticationService;
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
        return array(
        		'factories' => array(
        				'Zend\Authentication\AuthenticationService' => function($serviceManager) {
        					// If you are using DoctrineORMModule:
        					return $serviceManager->get('doctrine.authenticationservice.orm_default');
        
        					// If you are using DoctrineODMModule:
        					//return $serviceManager->get('doctrine.authenticationservice.odm_default');
        				}
              )
        				
        );
    }
				
    

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                		//'Client' => __DIR__ . '/src/Application/Client/',
                		
                ),
            ),
        );
    }
}
