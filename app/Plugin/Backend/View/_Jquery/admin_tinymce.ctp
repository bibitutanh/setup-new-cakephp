<?php 
$this->Js->loadPlugin('Jquery.Jquery');
$this->Js->loadPlugin('JqueryTinymce.JqueryTinymce');
?>
<?php $this->Helpers->load('SyntaxHighlighter.SyntaxHighlighter'); ?>
<?php $this->SyntaxHighlighter->loadBrush('html'); ?>
<?php $this->SyntaxHighlighter->loadBrush('php'); ?>
<?php $this->SyntaxHighlighter->loadBrush('js'); ?>
<div class="backend jquery">
	<section>
		<h2>Tinymce Editor</h2>
		
		<?php
		$script = $this->Js->get('#tinymce-1')->plugin('JqueryTinymce',array('test'=>'xxx','buffer'=>true))->editor(array(
			//'script_url' => Router::url('/')."js/tiny_mce/tinymce.js",
			'plugin_preview_width' => "700",
			'paste_remove_styles' => true,
			'paste_remove_spans' => true,
			'relative_urls' => false,
			'content_css' => "css/reset.css,css/forms.css,css/site/style.css",
			//'external_image_list_url' => Router::url(array('controller'=>'news','action'=>'external_image_list','admin'=>true)),
		));
		?>
		<pre class="brush: php">$this->Js->plugin('Jquery')->ajax($url[, $options])<br />$this->Js->plugin('Jquery')->ajax($options)</pre>
		<pre class="brush: js"><?php echo h($script); ?></pre> 

		<textarea id="tinymce-1">Text here</textarea>
		
		<script><?php #echo $script; ?></script>
	</section>
</div>
<?php echo $this->Js->writeBuffer(); ?>
<?php $this->Js->render(); ?>