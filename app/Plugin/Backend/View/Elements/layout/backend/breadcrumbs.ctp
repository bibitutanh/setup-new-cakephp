<div class="breadcrumbs">
<?php echo __('Your are here');?>:
<?php
	$startText = array(
		'text'=> (Configure::read('Backend.Dashboard.title')) ? Configure::read('Backend.Dashboard.title') : __('Dashboard'),
		'url'=> (Configure::read('Backend.Dashboard.url')) ? Configure::read('Backend.Dashboard.url') : '/admin'
	);
	echo $this->Html->getCrumbs('&raquo;', $startText);
	unset($startText);
?>
</div>