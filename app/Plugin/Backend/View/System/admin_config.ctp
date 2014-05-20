<?php $this->Html->addCrumb(__('Backend'),array('controller'=>'backend', 'action'=>'index')); ?>
<?php $this->Html->addCrumb(__('Systeminfo'),array('action'=>'index')); ?>
<div class="view">
	<h2>Config</h2>
	
	<table>
		<tr>
			<th><?php echo __('Key'); ?></th>
			<th><?php echo __('Value'); ?></th>
		</tr>
		<?php foreach(Set::flatten($config) as $k => $v):?>
		<tr>
			<td><?php echo h($k); ?></td>
			<td><?php echo h($v); ?></td>
		</tr>
		<?php endforeach; ?>
	</table>
</div>