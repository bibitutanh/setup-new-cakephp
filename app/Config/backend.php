<?php
/**
 * Default Backend config
 */
$config = array(
	'Backend' => array(
		'Dashboard' => array(
			'title' => 'Dashboard',
			'url' => array('plugin'=>'backend','controller'=>'backend','action'=>'dashboard'),
			'plugins' => 'Backend'
		),
		'Auth' => array(
			'enabled' => true,
		),
		'Acl' => array(
			'enabled' => false,
		),
	)
);
?>