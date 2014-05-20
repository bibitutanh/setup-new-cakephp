<?php $this->Html->addCrumb(__('Backend'),array('controller'=>'backend', 'action'=>'index')); ?>
<?php $this->Html->addCrumb(__d('backend','Systeminfo'),array('action'=>'index')); ?>
<?php $this->Html->addCrumb(__d('backend','PHP Info'),array('action'=>'phpinfo')); ?>

<div class="system phpinfo">
	<?php echo $phpinfo; ?>
</div>
