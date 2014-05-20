<?php echo $this->extend('Backend.Common/admin_form'); ?>
<?php echo $this->assign('title',__d('backend','Page')); ?>

	<div class="pages form">
	<?php echo $this->Form->create('Page',array());?>
		<fieldset>
			<legend><?php echo __d('backend','Admin Add %s', __d('backend','Page')); ?></legend>
		<?php
		echo $this->Form->input('parent_id',array('options'=>$parentPages,'empty'=>'- Root -'));
		echo $this->Form->input('title');
		echo $this->Form->input('url');
		echo $this->Form->input('alias');
		echo $this->Form->input('target');
		echo $this->Form->input('layout_view_id',array('empty'=>'-- Inherit --'));
		echo $this->Form->input('meta_title');
		echo $this->Form->input('meta_language');
		echo $this->Form->input('meta_robots_tag');
		echo $this->Form->input('meta_description');
		echo $this->Form->input('css_class');
		echo $this->Form->input('hide_from_nav');
		echo $this->Form->input('hide_from_sitemap');
		echo $this->Form->input('published');
		echo $this->Form->input('publish_start');
		echo $this->Form->input('publish_end');
	?>
	<?php echo $this->Form->submit(__d('backend','Submit'));?>
		</fieldset>
	<?php echo $this->Form->end();?>
	</div>
	
	<?php debug($this->Form->data);?>
	
	<?php $this->start('actions');?>
	<div class="actions dd-actions">
		<ul>
		<li><button class="ym-button ym-actions"><?php echo __d('backend','Actions'); ?></button>
			<ul>
				<li><?php echo $this->Html->link(__d('backend','List %s', __d('backend','Pages')), array('action' => 'index'));?></li>
				<li><?php echo $this->Html->link(__d('backend','New %s', __d('backend','Page')), array('action' => 'add'));?></li>
				<li><?php echo $this->Html->link(__d('backend','List %s', __d('backend','Pages')), array('controller' => 'pages', 'action' => 'index')); ?> </li>
				<li><?php echo $this->Html->link(__d('backend','New %s', __d('backend','Parent Page')), array('controller' => 'pages', 'action' => 'add')); ?> </li>
			</ul>
		</li>
		</ul>
	</div>
	<?php $this->end(); ?>
