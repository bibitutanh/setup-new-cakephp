<?php $this->Helpers->load('Backend.BackendHtml'); ?>
<?php $this->Helpers->load('SyntaxHighlighter.SyntaxHighlighter'); ?>
<?php $this->SyntaxHighlighter->loadBrush('html'); ?>
<?php $this->SyntaxHighlighter->loadBrush('php'); ?>
<?php $this->SyntaxHighlighter->loadBrush('js'); ?>
<?php $this->Html->css('/backend/css/appearance',null,array('inline'=>false)); ?>
<div>
	<h1>Collapsable</h1>
	
	<div class="section">
		<h2>Collapsable List</h2>
		<?php 
		$list = array(
			'RootNode1' => array(
				'SubNode1' => array(
					'SubNode1-1' => array(
						'SubNode1-1-1' => array(
							'key' => 'val',		
							'key2' => 'val',		
							'key3' => 'val',		
						)		
					),
					'Subnode1-2' => 'some-value'
				)		
			),
			'RootNode2' => array(
				'IsSomething' => 'True',		
				'IsSomethingElse' => 'False',
				'SubNode2-1' => array(
					'key' => 'val',		
					'key2' => 'val',		
					'key3' => 'val',		
				)		
			),
			'RootNode3' => 'node3-value'
		);
		?>
		<div class="example">
			<?php 
			$collapsableNestedList = $this->BackendHtml->collapsableNestedList($list,array(
					'collapse'=>true,
					'pathActive' => array('RootNode1.SubNode1.Subnode1-1','RootNode2'),
					'pathHidden' => array('RootNode3'),
			));
			echo $collapsableNestedList;
			?>
			<pre class="brush: html">
				<?php echo h($collapsableNestedList);?>
			</pre>
		</div>
	</div>
	
	<div class="section">
		<h2>Collapsable Form Fieldsets</h2>
		<div class="example">
		
		</div>
	</div>
	
</div>