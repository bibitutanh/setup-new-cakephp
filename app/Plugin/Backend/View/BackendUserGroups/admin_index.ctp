
<?php $this->Html->addCrumb(__('Backend User Groups'),array('action'=>'index'),array('class'=>'active')); ?>
<div class="backendUserGroups index">
	<h2><?php echo __('Backend User Groups'); ?></h2>
	

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New %s',__('Backend User Group')), array('action' => 'add')); ?></li>
			<li><?php echo $this->Html->link(__('List %s',__('Backend Users')), array('controller' => 'backend_users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New %s',__('Backend User')), array('controller' => 'backend_users', 'action' => 'add')); ?> </li>
		</ul>
	</div>
	
	<table>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
	foreach ($backendUserGroups as $backendUserGroup): ?>
	<tr>
		<td><?php echo h($backendUserGroup['BackendUserGroup']['id']); ?>&nbsp;</td>
		<td><?php echo h($backendUserGroup['BackendUserGroup']['name']); ?>&nbsp;</td>
		<td class="actions">
		<ul class="actions">
			<li><?php echo $this->Html->link(__('View'), array('action' => 'view', $backendUserGroup['BackendUserGroup']['id'])); ?></li>
			<li><?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $backendUserGroup['BackendUserGroup']['id'])); ?></li>
			<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $backendUserGroup['BackendUserGroup']['id']), null, __('Are you sure you want to delete # %s?', $backendUserGroup['BackendUserGroup']['id'])); ?></li>
		</ul>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<?php echo $this->element('Backend.pagination/default'); ?>		
</div>
