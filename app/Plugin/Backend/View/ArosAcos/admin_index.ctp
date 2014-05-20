
<?php $this->Html->addCrumb(__('Aros Acos'),array('action'=>'index'),array('class'=>'active')); ?>
<div class="arosAcos index">
	<h2><?php echo __('Aros Acos'); ?></h2>
	

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New %s',__('Aros Aco')), array('action' => 'add')); ?></li>
			<li><?php echo $this->Html->link(__('List %s',__('Aros')), array('controller' => 'aros', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New %s',__('Aro')), array('controller' => 'aros', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List %s',__('Acos')), array('controller' => 'acos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New %s',__('Aco')), array('controller' => 'acos', 'action' => 'add')); ?> </li>
		</ul>
	</div>
	
	<table>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('aro_id'); ?></th>
			<th><?php echo $this->Paginator->sort('aco_id'); ?></th>
			<th><?php echo $this->Paginator->sort('_create'); ?></th>
			<th><?php echo $this->Paginator->sort('_read'); ?></th>
			<th><?php echo $this->Paginator->sort('_update'); ?></th>
			<th><?php echo $this->Paginator->sort('_delete'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
	foreach ($arosAcos as $arosAco): ?>
	<tr>
		<td><?php echo h($arosAco['ArosAco']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($arosAco['Aro']['id'], array('controller' => 'aros', 'action' => 'view', $arosAco['Aro']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($arosAco['Aco']['id'], array('controller' => 'acos', 'action' => 'view', $arosAco['Aco']['id'])); ?>
		</td>
		<td><?php echo h($arosAco['ArosAco']['_create']); ?>&nbsp;</td>
		<td><?php echo h($arosAco['ArosAco']['_read']); ?>&nbsp;</td>
		<td><?php echo h($arosAco['ArosAco']['_update']); ?>&nbsp;</td>
		<td><?php echo h($arosAco['ArosAco']['_delete']); ?>&nbsp;</td>
		<td class="actions">
		<ul class="actions">
			<li><?php echo $this->Html->link(__('View'), array('action' => 'view', $arosAco['ArosAco']['id'])); ?></li>
			<li><?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $arosAco['ArosAco']['id'])); ?></li>
			<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $arosAco['ArosAco']['id']), null, __('Are you sure you want to delete # %s?', $arosAco['ArosAco']['id'])); ?></li>
		</ul>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<?php echo $this->element('Backend.pagination/default'); ?>		
</div>
