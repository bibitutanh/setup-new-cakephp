<?php 
$this->Js->loadPlugin('Jquery.Jquery');
$this->Js->loadPlugin('JqueryColorbox.JqueryColorbox');
?>
<?php $this->Helpers->load('SyntaxHighlighter.SyntaxHighlighter'); ?>
<?php $this->SyntaxHighlighter->loadBrush('html'); ?>
<?php $this->SyntaxHighlighter->loadBrush('php'); ?>
<?php $this->SyntaxHighlighter->loadBrush('js'); ?>
<div class="backend jquery">
	<section>
		<h2>Loading/Configuring Jquery Plugins</h2>
		
		<h3>Loading Jquery Plugin</h3>
		<pre class="brush: php">$this->Js->loadPlugin('Jquery.Jquery' [,$config]);</pre>
		
		<h3>Jquery</h3>
		
		<h4>jQuery.ajax( url [, settings] )</h4>
		<?php
		$script = $this->Js->plugin('Jquery')->ajax('index.php',array(
				'accepts'=>'text/html',
				'complete' => "alert(textStatus);",
		));
		?>
		<pre class="brush: php">$this->Js->plugin('Jquery')->ajax($url[, $options])<br />$this->Js->plugin('Jquery')->ajax($options)</pre>
		<pre class="brush: js"><?php echo h($script); ?></pre> 
		
		<h2>Using Jquery Plugins</h2>
		
		<h3>Colorbox</h3>
		
		<h4>Use without selector</h4>
		<?php $script = $this->Js->plugin('JqueryColorbox')->colorbox(array()); ?>
		<pre class="brush: php">$this->Js->plugin('Colorbox')->colorbox([$options])</pre>
		<pre class="brush: js"><?php echo h($script); ?></pre>
		
		
		<h4>Use with selector</h4>
		<?php $script = $this->Js->get('#cbSelector1')->plugin('JqueryColorbox')->colorbox(array(
				'innerWidth' => '50%', 
				'innerHeight' => '50%', 
				'html' => '<h1>Hello Colorbox</h1>'
		),array('buffer'=>false)); 
		$this->Js->buffer($script);
		?>
		<p>Use array('buffer'=>true) to enable buffering. Does not buffer by default</p> 
		<pre class="brush: php">$this->Js->get('#cbSelector1')->plugin('JqueryColorbox')->colorbox(array(
				'innerWidth' => '50%', 
				'innerHeight' => '50%', 
				'html' => '-html-goes-here-'
		)),array('buffer'=>false)); ?>
		</pre>
		<pre class="brush: js"><?php echo h($script); ?></pre>
		<button id="cbSelector1">Test Me</button>
		
		
		<h4>Use with events</h4>
		<?php 
		$cbScript = $this->Js->plugin('JqueryColorbox')->colorbox(array(
					'noSelector' => true,
					'innerWidth' => '50%', 
					'innerHeight' => '50%', 
					'html' => '<h1>Colorbox with events</h1>',
					'open' => true
			),array('stop'=>false));
		$script = $this->Js->get('#cbSelector2')->event('click', $cbScript); 
		$this->Js->buffer($script);
		?>
		<p>Use array('buffer' => false) to disable buffering. Events will be buffered by default (default JsHelper behavior).<br />
			<strong>Important:</strong>You have to use the 'noSelector' option, otherwise colorbox binds to the event's selector 
		</p> 
		<pre class="brush: php">$cbScript = $this->Js->plugin('JqueryColorbox')->colorbox(array(
					'noSelector' => true,
					'innerWidth' => '50%', 
					'innerHeight' => '50%', 
					'html' => '-html-goes-here-'
			));
			
			$script = $this->Js->get('#cbSelector2')->event('click', $cbScript,array('buffer'=>false));
		</pre>
		<pre class="brush: js"><?php echo h($cbScript); ?><?php echo h($script); ?></pre>
		<button id="cbSelector2">Test Me</button>

	</section>
</div>
<?php echo $this->Js->writeBuffer(); ?>
<?php $this->Js->render(); ?>