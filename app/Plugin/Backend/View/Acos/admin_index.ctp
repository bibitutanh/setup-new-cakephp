
<?php $this->Html->addCrumb(__('Acos'),array('action'=>'index'),array('class'=>'active')); ?>
<div class="acos index">
	<h2><?php echo __('Acos'); ?></h2>
	

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New %s',__('Aco')), array('action' => 'add')); ?></li>
			<li><?php echo $this->Html->link(__('List %s',__('Aros')), array('controller' => 'aros', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New %s',__('Aro')), array('controller' => 'aros', 'action' => 'add')); ?> </li>
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
	foreach ($acos as $aco): ?>
	<tr>
		<td><?php echo h($aco['Aco']['id']); ?>&nbsp;</td>
		<td><?php echo h($aco['Aco']['parent_id']); ?>&nbsp;</td>
		<td><?php echo h($aco['Aco']['model']); ?>&nbsp;</td>
		<td><?php echo h($aco['Aco']['foreign_key']); ?>&nbsp;</td>
		<td><?php echo h($aco['Aco']['alias']); ?>&nbsp;</td>
		<td><?php echo h($aco['Aco']['lft']); ?>&nbsp;</td>
		<td><?php echo h($aco['Aco']['rght']); ?>&nbsp;</td>
		<td class="actions">
		<ul class="actions">
			<li><?php echo $this->Html->link(__('View'), array('action' => 'view', $aco['Aco']['id'])); ?></li>
			<li><?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $aco['Aco']['id'])); ?></li>
			<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $aco['Aco']['id']), null, __('Are you sure you want to delete # %s?', $aco['Aco']['id'])); ?></li>
		</ul>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<?php echo $this->element('Backend.pagination/default'); ?>		
	
	<?php debug($acos);?>
</div>
