<?php $this->Html->addCrumb(__('Acos'),array('action'=>'index'),array()); ?>
<?php $this->Html->addCrumb(__('Add %s',__('Aco')),array('action'=>'add'),array('class'=>'active')); ?>
<div class="acos form">

	<h2><?php echo __('Aco'); ?></h2>
	<div class="actions">
		<ul>
	
				<li><?php echo $this->Html->link(__('List %s',__('Acos')), array('action' => 'index')); ?></li>
			<li><?php echo $this->Html->link(__('List %s',__('Aros')), array('controller' => 'aros', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New %s',__('Aro')), array('controller' => 'aros', 'action' => 'add')); ?> </li>
		</ul>
	</div>
<?php echo $this->Form->create('Aco'); ?>
	<fieldset>
		<legend><?php echo __('Add %s', __('Aco')); ?></legend>
	<?php
		echo $this->Form->input('parent_id');
		echo $this->Form->input('model');
		echo $this->Form->input('foreign_key');
		echo $this->Form->input('alias');
		echo $this->Form->input('lft');
		echo $this->Form->input('rght');
		echo $this->Form->input('Aro');
	?>
	</fieldset>
<div class="form-actions"><?php echo $this->Form->button(__('Submit')); ?>
</div><?php echo $this->Form->end(); ?>
</div>