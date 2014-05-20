
<?php $this->Html->addCrumb(__('Aros'),array('action'=>'index'),array('class'=>'active')); ?>
<div class="aros index">
	<h2><?php echo __('Aros'); ?></h2>
	

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New %s',__('Aro')), array('action' => 'add')); ?></li>
			<li><?php echo $this->Html->link(__('List %s',__('Acos')), array('controller' => 'acos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New %s',__('Aco')), array('controller' => 'acos', 'action' => 'add')); ?> </li>
		</ul>
	</div>
	
	<table>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('parent_id'); ?></th>
			<th><?php echo $this->Paginator->sort('model'); ?></th>
			<th><?php echo $this->Paginator->sort('foreign_key'); ?></th>
			<th><?php echo $this->Paginator->sort('alias'); ?></th>
			<th><?php echo $this->Paginator->sort('lft'); ?></th>
			<th><?php echo $this->Paginator->sort('rght'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
	foreach ($aros as $aro): ?>
	<tr>
		<td><?php echo h($aro['Aro']['id']); ?>&nbsp;</td>
		<td><?php echo h($aro['Aro']['parent_id']); ?>&nbsp;</td>
		<td><?php echo h($aro['Aro']['model']); ?>&nbsp;</td>
		<td><?php echo h($aro['Aro']['foreign_key']); ?>&nbsp;</td>
		<td><?php echo h($aro['Aro']['alias']); ?>&nbsp;</td>
		<td><?php echo h($aro['Aro']['lft']); ?>&nbsp;</td>
		<td><?php echo h($aro['Aro']['rght']); ?>&nbsp;</td>
		<td class="actions">
		<ul class="actions">
			<li><?php echo $this->Html->link(__('View'), array('action' => 'view', $aro['Aro']['id'])); ?></li>
			<li><?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $aro['Aro']['id'])); ?></li>
			<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $aro['Aro']['id']), null, __('Are you sure you want to delete # %s?', $aro['Aro']['id'])); ?></li>
		</ul>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<?php echo $this->element('Backend.pagination/default'); ?>		
</div>
