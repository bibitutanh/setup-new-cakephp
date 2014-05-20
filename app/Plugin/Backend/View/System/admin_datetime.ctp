<?php $this->Html->addCrumb(__('Backend'),array('controller'=>'backend', 'action'=>'index')); ?>
<?php $this->Html->addCrumb(__d('backend','Systeminfo'),array('action'=>'index')); ?>
<?php $this->Html->addCrumb(__d('backend','Date & Time'),array('action'=>'datetime')); ?>
<div>
	<h2><?php echo __d('backend','Date & Time'); ?></h2>
	<dl>
		<?php foreach($data as $key => $val):?>
			<dt><?php echo Inflector::humanize($key); ?>&nbsp;</dt>
			<dd><?php echo $val;?>&nbsp;</dd>
		<?php endforeach;?>
	</dl>
</div>