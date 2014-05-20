<?php $this->Html->addCrumb(__d('backend','LogViewer'),array('action'=>'index')); ?>
<?php $this->Html->addCrumb(h($logFile),array('action'=>'view',$logFile)); ?>
<div class="view">
	<h1><?php echo h($logFile); ?></h1>
	
	<div class="actions">
		<ul class="actions">
			<li><?php echo $this->Html->link(__d('backend','Go back'),array('action'=>'index')); ?></li>
			<li><?php echo $this->Html->link(__d('backend','Backup & Clear'),array('action'=>'backup',$logFile)); ?></li>
			<li><?php echo $this->Html->link(__d('backend','Clear'),array('action'=>'clear',$logFile)); ?></li>
			<li><?php echo $this->Html->link(__d('backend','Delete'),array('action'=>'delete',$logFile)); ?></li>
		</ul>
	</div>
	
	<div style="margin: 10px 0;">
		<textarea style="width:98%; height:90%; min-height: 500px;"><?php echo $log; ?></textarea>
	</div>
</div>