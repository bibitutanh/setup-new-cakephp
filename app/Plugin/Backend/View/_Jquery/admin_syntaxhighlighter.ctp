<?php 
$this->Js->loadPlugin('JquerySyntaxHighlighter.JquerySyntaxHighlighter');
?>
<div>
	<section>
		<h2>Syntax Highlighter</h2>
		
		<h3>Jquery Beauty Of Code - Syntax Highlighter</h3>
		<?php #$script = $this->Js->get('#highlight1')->plugin('JquerySyntaxHighlighter')->highlightAll(); ?>
		<?php debug ($this->Js->selection);?>
		<?php $script = $this->Js->getObject()->plugin('JquerySyntaxHighlighter')->highlightAll(); ?>
		<?php $this->Js->buffer($script);?>
		<pre class="code" id="highlight1">
			<code class="php">
			public function testHighlighter($arg1 = array()) {
				//method would be here
			}
			</code>
		</pre>
		<pre>
			<code>
			$script = $this->Js->get('#highlight1')->plugin('JquerySyntaxHighlighter')->script();
			</code>
		</pre>
		<pre><?php echo h($script);?></pre>
	</section>	
		
</div>
<script>
/*
$(function(){
    $.beautyOfCode.init('clipboard.swf',{
		baseUrl: "<?php echo Router::url('/',true); ?>"
    });
    $.beautyOfCode.beautifyAll();
});
*/
</script>

<?php echo $this->Js->writeBuffer(); ?>
<?php $this->Js->render(); ?>
		