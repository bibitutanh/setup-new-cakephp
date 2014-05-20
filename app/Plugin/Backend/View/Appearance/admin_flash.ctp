<div class="view">
	<h2>Appeareance - Flash</h2>
	
	<p>You should see the flash message '<?php echo $message; ?>' of type '<?php echo $element; ?>'</p>
	<ul>
		<li><?php echo $this->Html->link('Flash default',array('action'=>'flash'))?></li>
		<li><?php echo $this->Html->link('Flash error',array('action'=>'flash','error'))?></li>
		<li><?php echo $this->Html->link('Flash warning',array('action'=>'flash','warning'))?></li>
		<li><?php echo $this->Html->link('Flash info',array('action'=>'flash','info'))?></li>
		<li><?php echo $this->Html->link('Flash success',array('action'=>'flash','success'))?></li>
	</ul>
</div>