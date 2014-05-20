<?php $this->Helpers->load('Backend.BackendHtml'); ?>
<?php $this->Html->addCrumb(__('Backend'), array('controller'=>'backend', 'action'=>'index')); ?>
<?php $this->Html->addCrumb(__('Backend User'), array('action'=>'index')); ?>
<div class="backendUsers index">
	<h2><?php echo __d('backend','Backend Users');?></h2>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__d('backend','New %s',__d('backend','Backend User')), array('action' => 'add')); ?></li>
		</ul>
	</div>
	
	<table>
	<tr>
		<th><?php echo $this->Paginator->sort('id');?></th>
		<th><?php echo $this->Paginator->sort('backend_user_group_id');?></th>
		<th><?php echo $this->Paginator->sort('username');?></th>
		<th><?php echo $this->Paginator->sort('first_name');?></th>
		<th><?php echo $this->Paginator->sort('last_name');?></th>
		<th><?php echo $this->Paginator->sort('mail');?></th>
		<th><?php echo $this->Paginator->sort('published');?></th>
		<th><?php echo $this->Paginator->sort('last_login');?></th>
		<th class="actions"><?php echo __d('backend','Actions');?></th>
	</tr>
	<?php
	foreach ($backendUsers as $backendUser): ?>
<tr>
	<td><?php echo h($backendUser['BackendUser']['id']); ?>&nbsp;</td>
	<td><?php echo h($backendUser['BackendUserGroup']['name']); ?>&nbsp;</td>
	<td><?php echo h($backendUser['BackendUser']['username']); ?>&nbsp;</td>
	<td><?php echo h($backendUser['BackendUser']['first_name']); ?>&nbsp;</td>
	<td><?php echo h($backendUser['BackendUser']['last_name']); ?>&nbsp;</td>
	<td><?php echo h($backendUser['BackendUser']['mail']); ?>&nbsp;</td>
	<td><?php echo h($backendUser['BackendUser']['published']); ?>&nbsp;</td>
	<td><?php echo h($backendUser['BackendUser']['last_login']); ?>&nbsp;</td>
	<td class="actions">
	<ul class="actions">
		<li><?php echo $this->Html->link(__d('backend','View'), array('action' => 'view', $backendUser['BackendUser']['id'])); ?></li>
		<li><?php echo $this->Html->link(__d('backend','Edit'), array('action' => 'edit', $backendUser['BackendUser']['id'])); ?></li>
		<li><?php echo $this->Form->postLink(__d('backend','Delete'), array('action' => 'delete', $backendUser['BackendUser']['id']), null, __d('backend','Are you sure you want to delete # %s?', $backendUser['BackendUser']['id'])); ?></li>
	</ul>
	</td>
</tr>
<?php endforeach; ?>
	</table>
	
	<?php echo $this->element('Backend.pagination/default'); ?>	
	<?php debug($backendUsers);?>
</div>
