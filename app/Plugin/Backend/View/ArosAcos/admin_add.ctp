<?php $this->Html->addCrumb(__('Aros Acos'),array('action'=>'index'),array()); ?>
<?php $this->Html->addCrumb(__('Add %s',__('Aros Aco')),array('action'=>'add'),array('class'=>'active')); ?>
<div class="arosAcos form">

	<h2><?php echo __('Aros Aco'); ?></h2>
	<div class="actions">
		<ul>
	
				<li><?php echo $this->Html->link(__('List %s',__('Aros Acos')), array('action' => 'index')); ?></li>
			<li><?php echo $this->Html->link(__('List %s',__('Aros')), array('controller' => 'aros', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New %s',__('Aro')), array('controller' => 'aros', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List %s',__('Acos')), array('controller' => 'acos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New %s',__('Aco')), array('controller' => 'acos', 'action' => 'add')); ?> </li>
		</ul>
	</div>
<?php echo $this->Form->create('ArosAco'); ?>
	<fieldset>
		<legend><?php echo __('Add %s', __('Aros Aco')); ?></legend>
	<?php
		echo $this->Form->input('aro_id');
		echo $this->Form->input('aco_id');
		echo $this->Form->input('_create');
		echo $this->Form->input('_read');
		echo $this->Form->input('_update');
		echo $this->Form->input('_delete');
	?>
	</fieldset>
<div class="form-actions"><?php echo $this->Form->button(__('Submit')); ?>
</div><?php echo $this->Form->end(); ?>
</div>