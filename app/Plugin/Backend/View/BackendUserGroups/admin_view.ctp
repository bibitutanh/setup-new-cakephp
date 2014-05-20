<?php $this->Html->addCrumb(__('Backend User Groups'),array('action'=>'index'),array()); ?>
<?php $this->Html->addCrumb(__('View %s','#'.$this->request->params['pass'][0]),array('action'=>'view',$this->request->params['pass'][0]),array('class'=>'active')); ?>
<div class="backendUserGroups view">
<h2><?php  echo __('Backend User Group'); ?></h2>

<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Edit %s',__('Backend User Group')), array('action' => 'edit', $backendUserGroup['BackendUserGroup']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete %s',__('Backend User Group')), array('action' => 'delete', $backendUserGroup['BackendUserGroup']['id']), null, __('Are you sure you want to delete # %s?', $backendUserGroup['BackendUserGroup']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List %s',__('Backend User Groups')), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New %s',__('Backend User Group')), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List %s',__('Backend Users')), 
					array('controller' => 'backend_users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New %s',__('Backend User')), 
					array('controller' => 'backend_users', 'action' => 'add')); ?> </li>
	</ul>
</div>

	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($backendUserGroup['BackendUserGroup']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($backendUserGroup['BackendUserGroup']['name']); ?>
			&nbsp;
		</dd>
	</dl>
</div>

<div class="related">
	<h3><?php echo __('Related %s',__('Backend Users')); ?></h3>
	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New %s',__('Backend User')), 
				array('controller' => 'backend_users', 'action' => 'add')); ?> </li>
		</ul>
	</div>
	<table cellpadding = "0" cellspacing = "0">
	<?php if (!empty($backendUserGroup['BackendUser'])): ?>
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Root'); ?></th>
		<th><?php echo __('Backend User Group Id'); ?></th>
		<th><?php echo __('Username'); ?></th>
		<th><?php echo __('Password'); ?></th>
		<th><?php echo __('First Name'); ?></th>
		<th><?php echo __('Last Name'); ?></th>
		<th><?php echo __('Mail'); ?></th>
		<th><?php echo __('Last Login'); ?></th>
		<th><?php echo __('Published'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($backendUserGroup['BackendUser'] as $backendUser): ?>
		<tr>
			<td><?php echo $backendUser['id']; ?></td>
			<td><?php echo $backendUser['root']; ?></td>
			<td><?php echo $backendUser['backend_user_group_id']; ?></td>
			<td><?php echo $backendUser['username']; ?></td>
			<td><?php echo $backendUser['password']; ?></td>
			<td><?php echo $backendUser['first_name']; ?></td>
			<td><?php echo $backendUser['last_name']; ?></td>
			<td><?php echo $backendUser['mail']; ?></td>
			<td><?php echo $backendUser['last_login']; ?></td>
			<td><?php echo $backendUser['published']; ?></td>
			<td><?php echo $backendUser['created']; ?></td>
			<td class="actions">
			<ul class="actions">
				<li><?php echo $this->Html->link(__('View'), 
				array('controller' => 'backend_users', 'action' => 'view', $backendUser['id'])); ?></li>
				<li><?php echo $this->Html->link(__('Edit'), 
				array('controller' => 'backend_users', 'action' => 'edit', $backendUser['id'])); ?></li>
				<li><?php echo $this->Form->postLink(__('Delete'), 
				array('controller' => 'backend_users', 'action' => 'delete', $backendUser['id']), null, __('Are you sure you want to delete # %s?', $backendUser['id'])); ?></li>
			</ul>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

</div>
