<?php echo $this->Html->docType('html5'); ?>
<html>
	<?php echo $this->Html->charset(); ?>
	<head>
		<title><?php echo $title_for_layout; ?></title>
		
		<?php echo $this->fetch('meta'); ?>
		<?php echo $this->Html->css('/backend/css/bootstrap/css/bootstrap'); ?>
		<?php echo $this->Html->css('/backend/css/bootstrap/css/bootstrap-responsive'); ?>
		<?php echo $this->Html->css('/backend/css/chosen/chosen'); ?>
		<?php echo $this->fetch('css'); ?>
		<?php echo $this->Html->css('/backend/css/style'); ?>
		<?php echo $this->Html->css('/backend/css/forms'); ?>
		
		<?php echo $this->Html->script('/backend/js/jquery-1.9.1.min.js'); ?>
		<?php echo $this->fetch('css'); ?>
		<?php echo $this->fetch('script'); ?>
	</head>
	<body>
		<header>
			<?php echo $this->fetch('header'); ?>
		</header>
		<div id="main">
			<div class="container-fluid">
			<?php echo $this->Session->flash(); ?>
			<?php echo $this->fetch('content'); ?>
			</div>
		</div>
		<footer>
			<div class="container-fluid">
			<a href="#" onclick="window.location.reload()">Reload frame</a>
			</div>
		</footer>
		<?php echo $this->Html->script('/backend/js/bootstrap/bootstrap'); ?>
		<?php echo $this->Html->script('/backend/js/chosen/chosen.jquery.js'); ?>
		<?php echo $this->Html->script('/backend/js/backend'); ?>
	</body>
</html>