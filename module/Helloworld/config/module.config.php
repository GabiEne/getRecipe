<?php
return array(
	'view_manager' => array(
		'template_path_stack' => array(
			__DIR__ . '/../view',
		),
	),
	'router' => array(
		'routes' => array(
			'sayhello' => array(
			'type' => 'Zend\Mvc\Router\Http\Literal',
			'options' => array(
				'route' => '/sayhello',
				'defaults' => array(
					'controller' => 'Helloworld\Controller\Index',
					'action' => 'index',
				),
			),
		),
	)
 ),
	'controllers' => array(
		'invokables' => array(
			'Helloworld\Controller\Index'
					=> 'Helloworld\Controller\IndexController'
				),
		)
);
?>
<?php /* At this time, we
transfer an array with individual routes, one of which we have named “sayhello”. It should always
take effect when the “/sayhello” string follows the host information (in our case localhost) in the
URL. If this is the case, Framework should ensure that the IndexController, which we have just
prepared, and in it the action index is executed. And that is actually everything. Due to the nested
array notation, the configuration initially appears to be a bit unclear. But after a short time, one has
quickly become accustomed to it.
It is interesting to note that we specified Helloworld\Controller\Index as the value for the
controller although the control is indeed named IndexController. The explanation is to be found
somewhat further on.*/?>