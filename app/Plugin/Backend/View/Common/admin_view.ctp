<div>
	<h1><?php echo $this->fetch('title'); ?></h1>
	
	<?php echo $this->fetch('actions');?>
	<?php echo $this->fetch('content'); ?>
	
	<?php debug($this->getVar('tabs'));?>
	<?php foreach((array)$this->getVar('tabs') as $tab) {
		echo $this->fetch($tab['content']);
	}?>
</div>