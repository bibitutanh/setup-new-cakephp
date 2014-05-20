<?php 
$this->Js->loadPlugin('Jquery.Jquery');
$this->Js->loadPlugin('JqueryIphoneswitch.JqueryIphoneswitch');
?>
<?php $this->Helpers->load('SyntaxHighlighter.SyntaxHighlighter'); ?>
<?php $this->SyntaxHighlighter->loadBrush('html'); ?>
<?php $this->SyntaxHighlighter->loadBrush('php'); ?>
<?php $this->SyntaxHighlighter->loadBrush('js'); ?>

<style>


.left{
float:left;
width:120px;}

#ajax{
float:left;
width:300px;
padding-top:5px;
font-weight:700;
}

.clear{clear:both;}

</style>

<div class="backend jquery">
	<section>
		<h2>Tinymce Editor</h2>
		<?php
		$script = $this->Js->get('#1')->plugin('JqueryIphoneswitch')->switcher();
		?>
		<pre class="brush: php">$this->Js->plugin('Jquery')->ajax($url[, $options])<br />$this->Js->plugin('Jquery')->ajax($options)</pre>
		<pre class="brush: js"><?php echo h($script); ?></pre> 

		 <div class="left" id="1"></div>
		 <div id="ajax"></div>
		  <div class="clear"></div>
		
		  <script type="text/javascript">
		  /**
		    $('#1').iphoneSwitch("on", 
		     function() {
		       //$('#ajax').load('on.html');
			    console.log('on');
		      },
		      function() {
		       //$('#ajax').load('off.html');
			    console.log('off');
		      },
		      {
		        switch_on_container_path: 'iphone_switch_container_off.png'
		      });
	      **/
		  </script>
		
		<script><?php echo $script; ?></script>
	</section>
</div>
<?php echo $this->Js->writeBuffer(); ?>
<?php $this->Js->render(); ?>