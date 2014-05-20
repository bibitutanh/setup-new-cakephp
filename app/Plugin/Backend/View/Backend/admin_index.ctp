<?php $this->Html->addCrumb(__('Backend'), array('controller'=>'backend', 'action'=>'index')); ?>

<style>
.dashboard-item {
	border-top: 1px solid #CCC;
	margin: 0 0 1em 0;
	min-height: 150px;
	padding: 0 1em;
}

.dashboard-item:HOVER {
	border-top: 1px solid #000;
	background-color: #f8f8f8;	
}

.dashboard-item > a {
}

.dashboard-item > ul {
}
</style>
<div class="index backend">
	<h2>Backend Dashboard</h2>
	
	<div class="actions">
		<?php echo $this->Html->link(__('Goto My Dashboard'),array('action'=>'dashboard')); ?><br />
	</div>

	<?php foreach((array) $this->get('backend_sidebar_menu') as $n):?>
	<?php echo $this->Dashboard->itemFromArray($n); ?>
	<?php endforeach; ?>
	
</div>