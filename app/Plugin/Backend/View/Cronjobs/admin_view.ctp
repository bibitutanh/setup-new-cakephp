<style>
.cron-chart {
	display: inline-block;
}

.cron-chart span {
	display: inline-block;
	width: 16px;
	height: 16px;
	background-color: gray;
	margin: 0 1px 0 0;
}

.cron-chart span[data-status="<?php echo $cronjob['expectOk']; ?>"] {
	background-color: green;
}

.cron-chart span[data-status="<?php echo $cronjob['expectFail']; ?>"] {
	background-color: orange;
}

.cron-chart span[data-status="<?php echo $cronjob['expectError']; ?>"] {
	background-color: red;
}

.cron-chart span[data-status="UNKNOWN"] {
	background-color: yellow;
}

</style>
<?php $this->Html->addCrumb('Cronjobs',array('action'=>'index')); ?>
<div class="view">
	<h2>Cronjob <?php echo $id; ?></h2>
	<div class="actions">
		<?php echo $this->Html->link(__('Run cronjob'),array('action'=>'run',$id)); ?>
		<?php echo $this->Html->link(__('Force cronjob'),array('action'=>'run',$id,'force'=>true)); ?>
		<ul>
			<li><?php echo $this->Html->link(__('List %s', __('Cronjobs')),array('action'=>'index')); ?></li>
			<li><?php echo $this->Html->link('Run external',
					array('admin'=>false,'action'=>'run',$id),
					array('target'=>'_blank')); ?></li>
			<li><?php echo $this->Html->link('Run external (force)',
					array('admin'=>false,'action'=>'run',$id,'force'=>true),
					array('target'=>'_blank')); ?></li>
		</ul>
	</div>
	<dl>
		<dt>Id</dt>
		<dd><?php echo $id; ?>&nbsp;</dd>
		<dt>Enabled</dt>
		<dd><?php 
			//TODO implement StatusHelper->html() here
			$class = ($cronjob['enabled']) ? 'success' : 'important';
			$enabled = ($cronjob['enabled']) ? __('Yes') : __('No');
			echo $this->Html->tag('span', $enabled,array('class'=>'label label-'.$class));
		?>&nbsp;</dd>
		<dt>Url</dt>
		<dd><?php echo $cronjob['url']; ?>&nbsp;</dd>
		<dt>Interval</dt>
		<dd><?php echo intval($cronjob['interval']); ?>&nbsp;seconds</dd>
		<dt>Expect Ok</dt>
		<dd><?php echo $cronjob['expectOk']; ?>&nbsp;</dd>
		<dt>Expect Fail</dt>
		<dd><?php echo $cronjob['expectFail']; ?>&nbsp;</dd>
		<dt>Expect Error</dt>
		<dd><?php echo $cronjob['expectError']; ?>&nbsp;</dd>
		<dt>Health</dt>
		<dd>
			<div class="cron-chart">
				<?php 
				$i = 0;
				foreach(array_reverse($stats) as $stat) {
					echo $this->Html->tag('span','',array(
						'data-status'=>strtoupper($stat['response']),
						'title' => sprintf("%s (%s): %s",$this->Time->niceShort($stat['time']), $stat['time_elapsed'], $stat['response'])
					));

					#if (++$i % 10 == 0)
					#	echo "<br />";
				}?>
			</div>
		</dd>
	</dl>
	
</div>

<div class="related">
	<h3><?php echo __('Related %s', 'Responses'); ?></h3>
	<table>
		<tr>
			<th>#</th>
			<th>Time</th>
			<th>Time Elapsed</th>
			<th>Last Response</th>
			<th>Last Message</th>
			<th class="actions">Actions</th>
		</tr>
		<?php foreach($stats as $n => $stat): ?>
		<tr>
			<td><?php echo $n; ?></td>
			<td><?php 
				if ($stat) {
					echo $this->Time->nice($stat['time']);
				} else {
					echo "Never";
				}
			?>&nbsp;</td>
			<td><?php 
				if ($stat) {
					echo $stat['time_elapsed'];
				}
			?>&nbsp;</td>
			<td><?php 
				if ($stat) {
					echo h($stat['response']);
				}
			?>&nbsp;</td>
			<td><?php 
				if ($stat) {
					echo h($stat['message']);
				}
			?>&nbsp;</td>
			<td class="actions">
				<?php echo $this->Html->link('Run',array('action'=>'run',$id)); ?>
			</td>
		</tr>
		<?php endforeach; ?>
	</table>
</div>