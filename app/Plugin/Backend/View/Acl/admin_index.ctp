<div class="index">
	<h2>Access Control List</h2>
	
	<?php 
	$defaultPermission = array(
		'create' => 0,
		'read'=> 0,
		'update'=> 0,
		'delete' => 0
	);
	
	$status = array(
		1 => array(__('Allow'), 'success'),
		0 => array(__('?'), 'default'),
		-1 => array(__('Deny'), 'important'),		
	)
	?>
	<table>
		<tr>
			<th>ACO Alias</th>
			<?php foreach($aros as $aro):?>
			<th colspan="4">BackendUserGroup: <?php echo $aro['Aro']['id']; ?></th>
			<?php endforeach;?>
		</tr>
		<tr>
			<th>&nbsp;</th>
			<?php foreach($aros as $aro):?>
			<?php foreach(array_keys($defaultPermission) as $crud):?>
			<th><?php echo $crud; ?></th>
			<?php endforeach;?>
			<?php endforeach;?>
		</tr>
		<?php foreach($acos as $aco):?>
		<?php 
		/*
		$root = ($aco['Aco']['parent_id']) ? '' : $aco['Aco']['id'];
		$firstLevel = ($aco['Aco']['parent_id'] == $root) ? $aco['Aco']['id'] : '';
		$secondLevel = ($aco['Aco']['parent_id'] == $firstLevel) ? $aco['Aco']['id'] : '';
		$class = ($root || $firstLevel) ? '' : 'collapsed';
		*/
		$class = '';
		?>
		<tr class="<?php echo $class; ?>">
			<td><?php echo $this->Html->link($aco['Aco']['alias'],array('action'=>'index',$aco['Aco']['id'])); ?>
			 (<?php echo $aco['Aco']['id']; ?>)</td>
			<?php foreach($aros as $aro):?>
				<?php 
				$_extractPath = sprintf('{n}.Permission[aro_id=%s][aco_id=%s]',$aro['Aro']['id'],$aco['Aco']['id']);
				$_permissions = Hash::extract($permissions, $_extractPath);
				
				$_permission = $defaultPermission;
				if (isset($_permissions[0])) {
					$_permission = am($_permission, array(
						'create' => $_permissions[0]['_create'],
						'read' => $_permissions[0]['_read'],
						'update' => $_permissions[0]['_update'],
						'delete' => $_permissions[0]['_delete'],
					));
				}
				?>
				<?php foreach($_permission as $_k => $_p):?>
				<td><?php list($label,$class) = $status[$_p]; 
					echo sprintf("<span class=\"label label-%s\">%s</span> %s",$class, $label, $this->BackendHtml->icon($_p));
					echo $this->Html->link(__('Allow'),array('action'=>'allow',$aro['Aro']['id'],$aco['Aco']['id'],$_k));
					echo $this->Html->link(__('Reset'),array('action'=>'reset',$aro['Aro']['id'],$aco['Aco']['id'],$_k));
					echo $this->Html->link(__('Deny'),array('action'=>'deny',$aro['Aro']['id'],$aco['Aco']['id'],$_k));
					?>
				</td>
				<?php endforeach; ?>
			<?php endforeach;?>
		</tr>
		<?php endforeach; ?>
	</table>
</div>
<script>
$(document).ready(function() {
	//$("tr.collapsed").hide();
});
</script>