<?php echo $this->Html->docType('html5'); ?>
<html>
	<?php echo $this->Html->charset(); ?>
	<head>
		<title>404 NotFound</title>
		
		<?php echo $this->fetch('meta'); ?>
		<?php echo $this->fetch('css'); ?>
		<?php echo $this->fetch('script'); ?>
		
	</head>
	<body>
		<!-- HEADER -->
		<header>
			<h1>404 NotFound</h1>
		</header>
		<!-- #HEADER -->
		
		<div id="content">
			<?php echo $this->fetch('content'); ?>
		</div>
		
		<!-- FOOTER -->
		<footer>
			<?php echo $this->element('sql_dump');?>
		</footer>
		<!-- #FOOTER -->
	</body>
</html>