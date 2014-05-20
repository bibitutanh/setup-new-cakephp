<?php $this->Helpers->load('Time','Number'); ?>
<?php $this->Html->addCrumb(__d('backend','LogViewer'),array('action'=>'index')); ?>
<div class="index">
	<h2><?php echo __d('backend','LogViewer'); ?></h2>
	
	<table>
		<tr>
			<th><?php echo __d('backend','Logfile');?></th>
			<th><?php echo __d('backend','Filesize');?></th>
			<th><?php echo __d('backend','Last modified');?></th>
			<th><?php echo __d('backend','Last access');?></th>
			<th class="actions"><?php echo __d('backend','Actions'); ?></th>
		</tr>
	<?php foreach($files as $file):?>
		<?php $id = basename($file['name']); ?>
		<tr>
			<td><?php echo $this->Html->link($file['dir'].$file['name'],array('action'=>'view',$id)); ?></td>
			<td><?php echo $this->Number->toReadableSize($file['size']); ?></td>
			<td><?php echo $this->Time->timeAgoInWords($file['last_modified']); ?></td>
			<td><?php echo $this->Time->timeAgoInWords($file['last_access']); ?></td>
			<td class="actions">
				<ul class="actions">
					<li><?php echo $this->Html->link(__d('backend','View'),array('action'=>'view',$id)); ?></li>
					<li><?php echo $this->Html->link(__d('backend','Backup & Clear'),array('action'=>'backup',$id)); ?></li>
					<li><?php echo $this->Html->link(__d('backend','Clear'),array('action'=>'clear',$id)); ?></li>
					<li><?php echo $this->Html->link(__d('backend','Delete'),array('action'=>'delete',$id)); ?></li>
				</ul>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
	
	
	<h2>Configured LogRotation</h2>
	<table>
		<tr>
			<th><?php echo __d('backend','Alias');?></th>
			<th><?php echo __d('backend','Path');?></th>
			<th><?php echo __d('backend','Keep');?></th>
			<th><?php echo __d('backend','Schedule');?></th>
			<th><?php echo __d('backend','Compress');?></th>
			<th><?php echo __d('backend','Compress Delay');?></th>
			<th><?php echo __d('backend','Rotate Empty');?></th>
			<th><?php echo __d('backend','Email To');?></th>
			<th class="actions"><?php echo __d('backend','Actions'); ?></th>
		</tr>
		<?php foreach ((array) Configure::read('Backend.LogRotation') as $alias => $config):?>
		<tr>
			<td><?php echo $alias; ?></td>
			<td><?php echo $config['path']; ?></td>
			<td><?php echo $config['keep']; ?></td>
			<td><?php echo $config['schedule']; ?></td>
			<td><?php echo $config['compress']; ?></td>
			<td><?php echo $config['compress_delay']; ?></td>
			<td><?php echo $config['rotate_empty']; ?></td>
			<td><?php echo $config['email_to']; ?></td>
			<td class="actions">
				<ul>
				<li><?php echo $this->Html->link('Rotate',array('action'=>'rotate',$alias))?></li>
				<li><?php echo $this->Html->link('Force',array('action'=>'rotate',$alias,'force'=>true)); ?></li>
				</ul>
			</td>
		</tr>
		<?php endforeach; ?>
	</table>
	
</div>