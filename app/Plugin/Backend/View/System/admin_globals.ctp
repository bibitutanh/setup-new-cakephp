<?php $this->Html->addCrumb(__('Backend'),array('controller'=>'backend', 'action'=>'index')); ?>
<?php $this->Html->addCrumb(__d('backend','System'),array('action'=>'index')); ?>
<?php $this->Html->addCrumb(__d('backend','Globals'),array('action'=>'globals')); ?>
<div>
	<h2><?php echo __d('backend','CAKEPHP Globals'); ?></h2>
	<dl>
		<?php foreach($globals as $global):?>
			<dt><?php echo $global; ?>&nbsp;</dt>
			<dd><?php echo constant($global);?>&nbsp;</dd>
		<?php endforeach;?>
	</dl>
</div>