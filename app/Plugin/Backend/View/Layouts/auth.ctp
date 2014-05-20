<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo __d('backend',"Login"); ?>
	</title>
	<?php echo $this->Html->css('/backend/css/bootstrap/css/bootstrap'); ?>
	<?php echo $this->Html->css('/backend/css/bootstrap/css/bootstrap-responsive'); ?>
	<?php echo $this->Html->css('/backend/css/style'); ?>
	<?php echo $this->Html->css('/backend/css/forms'); ?>
	<?php
		echo $this->Html->meta('icon');
		echo $this->fetch('script');
		echo $this->fetch('css');
		
	?>
</head>
<body>
	<div class="container" style="max-width: 500px; padding-top: 50px;">
		
			<div id="flash">
				<?php echo $this->Session->flash(); ?>
				<?php echo $this->Session->flash('auth'); ?>
			</div>
			<?php echo $this->fetch('content'); ?>
			
	</div>

	<?php echo $this->Html->script('/backend/js/jquery-1.8.0.min.js'); ?>
	<?php echo $this->Html->script('/backend/js/bootstrap/bootstrap'); ?>
	<?php echo $this->Html->script('/backend/js/backend'); ?>
</body>
</html>