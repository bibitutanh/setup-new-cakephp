<?php $this->Html->addCrumb(__d('backend','Backend'),array('plugin'=>'backend','controller'=>'backend','action'=>'index')); ?>
<?php $this->Html->addCrumb(__d('backend','Unit Tests'),array('plugin'=>'backend','controller'=>'unit_tests','action'=>'index')); ?>
<div class="index">
	<div>
		<?php echo $this->Html->link(__d('backend','Open in new window'),$testUrl,array('target'=>'_blank')); ?>
		<?php echo $this->Html->tag('iframe',__d('backend','Iframes are not supported by your browser'),array(
			'src' => $testUrl,
			'style' => 'width: 98%; margin: 10px 0; min-height: 700px;'
		));?>
	</div>
</div>