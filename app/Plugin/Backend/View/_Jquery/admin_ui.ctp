<?php 
$this->Js->loadPlugin('Jquery.Jquery');
$this->Js->loadPlugin('JqueryUi.JqueryTimepicker');
?>
<?php $this->Helpers->load('SyntaxHighlighter.SyntaxHighlighter'); ?>
<?php $this->SyntaxHighlighter->loadBrush('html'); ?>
<?php $this->SyntaxHighlighter->loadBrush('php'); ?>
<?php $this->SyntaxHighlighter->loadBrush('js'); ?>

<div class="backend jquery">
	<section>
		<h2>Datepicker</h2>
		<?php
		$script = $this->Js->get('.datepicker')->plugin('JqueryTimepicker')->datepicker();
		?>
		<pre class="brush: js"><?php echo h($script); ?></pre> 

		<?php
		echo $this->Form->create('Test');	
		echo $this->Form->input('publish_start',array('type'=>'text','class'=>'datepicker'));
		echo $this->Form->end();
		?>
		
		<script><?php echo $script; ?></script>
	</section>
</div>
<?php echo $this->Js->writeBuffer(); ?>
<?php $this->Js->render(); ?>