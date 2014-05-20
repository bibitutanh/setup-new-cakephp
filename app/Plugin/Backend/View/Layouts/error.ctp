<?php echo $this->Html->docType('html5'); ?>
<html>
	<?php echo $this->Html->charset(); ?>
	<head>
		<title>Backend Error</title>
		
		<?php echo $this->fetch('meta'); ?>
		<?php echo $this->fetch('css'); ?>
		<?php echo $this->fetch('script'); ?>
		
	</head>
	<body>
	<div class="page">
	
		<header>
			<h1>Uups, something went wrong</h1>
		</header> <!-- #HEADER -->
		
		<div id="main">
			<div id="content">
				<?php echo $this->Session->flash(); ?>
				<?php echo $this->fetch('content'); ?>
			</div>
		</div><!-- #MAIN -->
		
		<footer>
			<?php echo $this->element('sql_dump');?>
		</footer> <!-- #FOOTER -->
		
	</div> <!-- #page -->
	</body>
</html>