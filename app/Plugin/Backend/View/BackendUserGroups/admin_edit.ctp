<?php $this->Html->addCrumb(__('Backend User Groups'),array('action'=>'index'),array()); ?>
<?php $this->Html->addCrumb(__('Edit %s',__('Backend User Group')),array('action'=>'edit',$this->Form->value('BackendUserGroup.id')),array('class'=>'active')); ?>
<div class="backendUserGroups form">

	<h2><?php echo __('Backend User Group'); ?></h2>
	<div class="actions">
		<ul>
	
				<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('BackendUserGroup.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('BackendUserGroup.id'))); ?></li>
				<li><?php echo $this->Html->link(__('List %s',__('Backend User Groups')), array('action' => 'index')); ?></li>
			<li><?php echo $this->Html->link(__('List %s',__('Backend Users')), array('controller' => 'backend_users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New %s',__('Backend User')), array('controller' => 'backend_users', 'action' => 'add')); ?> </li>
		</ul>
	</div>
<?php echo $this->Form->create('BackendUserGroup'); ?>
	<fieldset>
		<legend><?php echo __('Edit %s', __('Backend User Group')); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
	?>
	</fieldset>
<div class="form-actions"><?php echo $this->Form->button(__('Submit')); ?>
</div><?php echo $this->Form->end(); ?>
</div>