<?php $this->Html->addCrumb('Cronjobs',array('action'=>'index')); ?>
<?php $this->Helpers->load('Time'); ?>
<div class="index">
	<h2>Cronjobs</h2>
	
	<div class="actions">
		<?php echo $this->Html->link(__('Run all cronjobs'),array('action'=>'run_all')); ?>
	</div>
	<table>
		<tr>
			<th>Id</th>
			<th>Enabled</th>
			<th>Url</th>
			<th>Interval</th>
			<th>Last Run</th>
			<th>Offset</th>
			<th>Last Response</th>
			<th>Last Message</th>
			<th class="actions">Actions</th>
		</tr>
		<?php foreach($cronjobs as $id => $cronjob): ?>
		<tr>
			<td><?php echo Inflector::humanize($id); ?></td>
			<td><?php 
				//TODO implement StatusHelper->html() here
				$class = ($cronjob['enabled']) ? 'success' : 'important';
			$enabled = ($cronjob['enabled']) ? __('Yes') : __('No');
				echo $this->Html->tag('span', $enabled,array('class'=>'label label-'.$class)); 
			?></td>
			<td><?php echo $cronjob['url']; ?></td>
			<td><?php echo $cronjob['interval']; ?> sec</td>
			<td><?php 
				if ($stats[$id]) {
					echo $this->Time->timeAgoInWords($stats[$id]['time']);
				} else {
					echo "Never";
				}
			?>&nbsp;</td>
			<td><?php 
				if ($stats[$id]) {
					$next = $stats[$id]['time'] + $cronjob['interval'];
					$nextOffset = $next - time();
					if ($nextOffset < $cronjob['interval']*-1) {
						$class = 'important';
					}
					elseif ($nextOffset < 0) {
						$class = 'warning';
					}
					else {
						$class = 'success';
					}
					echo $this->Html->tag('span',sprintf("%+d", $nextOffset),array('class'=>'label label-'.$class));
				}
			?>&nbsp;</td>
			<td><?php 
				if ($stats[$id]) {
					switch($stats[$id]['response']) {
						case $cronjob['expectOk']:
							$class = 'success'; break;
						case $cronjob['expectFail']:
							$class = 'warning'; break;
						case $cronjob['expectError']:
						default:
							$class = 'important'; break;
					}
					echo $this->Html->tag('span',h($stats[$id]['response']),array('class'=>'label label-'.$class));
				}
			?>&nbsp;</td>
			<td><?php 
				if ($stats[$id]) {
					echo h($stats[$id]['message']);
				}
			?>&nbsp;</td>
			<td class="actions">
				<?php echo $this->Html->link('View',array('action'=>'view',$id));?>
				<?php echo $this->Html->link('Run',array('action'=>'run',$id));?>
				<?php echo $this->Html->link('Force',array('action'=>'run',$id,'force'=>true));?>
			</td>
		</tr>
		<?php endforeach; ?>
	</table>
</div>