<?php $this->Helpers->load('Backend.BackendHtml'); ?>
<?php $this->Helpers->load('SyntaxHighlighter.SyntaxHighlighter'); ?>
<?php $this->SyntaxHighlighter->loadBrush('html'); ?>
<?php $this->SyntaxHighlighter->loadBrush('php'); ?>

	<div class="pages index">
		<h2><?php echo __d('backend','Pages');?></h2>
		
		<table cellpadding="0" cellspacing="0">
		<tbody>
		<tr>
					<th><?php echo $this->Paginator->sort('id');?></th>
					<th><?php echo $this->Paginator->sort('parent_id');?></th>
					<th><?php echo $this->Paginator->sort('lft');?></th>
					<th><?php echo $this->Paginator->sort('rght');?></th>
					<th><?php echo $this->Paginator->sort('title');?></th>
					<th><?php echo $this->Paginator->sort('alias');?></th>
					<th class="actions"><?php echo __d('backend','Actions');?></th>
		</tr>
		<?php
		foreach ($pages as $page): ?>
	<tr>
		<td><?php echo h($page['Page']['id']); ?>&nbsp;</td>
		<td>
			<?php #echo $this->Html->link($page['ParentPage']['title'], array('controller' => 'pages', 'action' => 'view', $page['ParentPage']['id'])); ?>
			<?php echo $page['Page']['parent_id'];?>
		</td>
		<td><?php echo h($page['Page']['lft']); ?>&nbsp;</td>
		<td><?php echo h($page['Page']['rght']); ?>&nbsp;</td>
		<td><?php echo h($treeList[$page['Page']['id']]); ?>&nbsp;</td>
		<td><?php echo h($page['Page']['alias']); ?>&nbsp;</td>
		<td class="actions">
		<ul class="actions dd-actions">
			<li><button class="ym-button ym-actions">Actions</button>
			<ul>
			<li><?php echo $this->Html->link(__d('backend','View'), array('action' => 'view', $page['Page']['id'])); ?></li>
			<li><?php echo $this->Html->link(__d('backend','Edit'), array('action' => 'edit', $page['Page']['id'])); ?></li>
			<li><?php echo $this->Form->postLink(__d('backend','Delete'), array('action' => 'delete', $page['Page']['id']), null, __d('backend','Are you sure you want to delete # %s?', $page['Page']['id'])); ?></li>
			</ul>
		</ul>
		
		</td>
	</tr>
<?php endforeach; ?>
		</tbody>
		</table>
		
		<?php echo $this->element('Backend.pagination/default'); ?>	</div>
	
	<?php $this->start('actions');?>
	<div class="actions">
		<ul class="dd-actions">
		<li><button class="ym-button ym-actions"><?php echo __d('backend','Actions'); ?></button>
			<ul>
				<li><?php echo $this->Html->link(__d('backend','New %s',__d('backend','Page')), array('action' => 'add')); ?></li>
				<li><?php echo $this->Html->link(__d('backend','List %s',__d('backend','Pages')), array('controller' => 'pages', 'action' => 'index')); ?> </li>
				<li><?php echo $this->Html->link(__d('backend','New %s',__d('backend','Parent Page')), array('controller' => 'pages', 'action' => 'add')); ?> </li>
			</ul>
		</li>
		</ul>
	</div>
	<?php $this->end(); ?>
	
	<?php $this->Helpers->load('CakeLayout.Page'); ?>
	
	<h2>Yaml Vertical Navigation</h2>	
	<div class="ym-vlist">
	<?php #$html = $this->element('CakeLayout.Pages/templates/ym-vlist',array('pages'=>$treeNested, 'options'=>array('hideRoot'=>true))); ?>
	<?php $html = $this->Page->templatedList($treeNested); ?>
	<?php echo $html; ?>
	</div>
	<pre class="brush: xml"><?php echo h($html);?></pre>
	<?php echo $this->SyntaxHighlighter->highlight('function() { echo "Test"; }','php'); ?>
	<!-- Finally, to actually run the highlighter, you need to include this JS on your page -->
	
	<h2>Yaml Vertical Navigation</h2>	
	<?php #$html = $this->element('CakeLayout.Pages/templates/ym-hlist',array('pages'=>$treeNested, 'options'=>array('hideRoot'=>true))); ?>
	<?php echo $html; ?>
	<pre class="brush: html"><?php echo h($html);?></pre>
	
	<h2>INAV Horizontal</h2>	
	<?php $html = $this->Page->templatedList($treeNested,'inav-hlist'); ?>
	<?php echo $html; ?>
	<pre class="brush: html"><?php echo h($html);?></pre>
	
	<?php debug($treeNested);?>
	<?php debug($pages);?>
