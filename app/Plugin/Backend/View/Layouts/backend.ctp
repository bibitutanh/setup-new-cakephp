<?php 
// preload elements to make assets available in the view blocks
// TODO better use view blocks instead of element
$sidebar = $this->BackendLayout->fetch('sidebar');
?>
<?php echo $this->Html->docType('html5'); ?>
<html>
	<?php echo $this->Html->charset(); ?>
	<head>
		<title><?php echo $title_for_layout; ?></title>
		
		<?php echo $this->fetch('meta'); ?>
		
		<?php echo $this->BackendLayout->css(); ?>
		<?php echo $this->fetch('css'); ?>
		
		<?php echo $this->BackendLayout->script(); ?>
		<?php echo $this->fetch('script'); ?>
	</head>
	<body style="padding: 40px 0 40px 0;">
		<!-- HEADER -->
		<header>
			<?php echo $this->BackendLayout->fetch('header'); ?>
		</header>
		<!-- #HEADER -->
		
		
		<aside id="be-sidebar" style="left: 0;
    padding: 10px 10px 10px 0;
    position: fixed;
    top: 40px;
    width: 200px;">
			<?php echo $sidebar; ?>
		</aside>
		
		<div id="be-main" style="margin:0 0 0 210px; min-height: 400px; box-shadow:-2px 0 5px #CCCCCC; padding: 1em 0 2em 0;">
			<div class="container-fluid">
				<?php echo $this->BackendLayout->fetch('breadcrumbs'); ?>
				<?php echo $this->Session->flash(); ?>
				<?php echo $this->Session->flash('auth'); ?>
				<?php echo $this->BackendLayout->fetch('content_before'); ?>
				<?php echo $this->fetch('content'); ?>
				<?php echo $this->BackendLayout->fetch('content_after'); ?>
			</div>
			
		</div>	
		
		<!-- FOOTER -->
		<footer>
			<div class="container-fluid">
				<?php echo $this->BackendLayout->fetch('footer'); ?>
			</div>
		</footer>
		<!-- #FOOTER -->
		
		<!-- MISC -->
		<div id="spinner"></div>
		<!-- #MISC -->
		<?php echo $this->element('Backend.debug/panel'); ?>
		<?php echo $this->BackendLayout->fetch('bottom'); ?>
		<?php echo $this->Js->writeBuffer(); ?>
	</body>
</html>