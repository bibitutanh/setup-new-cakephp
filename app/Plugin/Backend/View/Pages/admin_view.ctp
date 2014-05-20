<?php echo $this->extend('Backend.Common/admin_view'); ?>
<?php echo $this->assign('title',__d('backend','Page')); ?>
	<div class="pages view">
			<h2><?php  echo __d('backend','Page');?></h2>
				<dl>
					<dt><?php echo __d('backend','Id'); ?></dt>
		<dd>
			<?php echo h($page['Page']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('backend','Parent Page'); ?></dt>
		<dd>
			<?php echo $this->Html->link($page['ParentPage']['title'], array('controller' => 'pages', 'action' => 'view', $page['ParentPage']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('backend','Lft'); ?></dt>
		<dd>
			<?php echo h($page['Page']['lft']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('backend','Rght'); ?></dt>
		<dd>
			<?php echo h($page['Page']['rght']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('backend','Title'); ?></dt>
		<dd>
			<?php echo h($page['Page']['title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('backend','Url'); ?></dt>
		<dd>
			<?php echo h($page['Page']['url']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('backend','Alias'); ?></dt>
		<dd>
			<?php echo h($page['Page']['alias']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('backend','Target'); ?></dt>
		<dd>
			<?php echo h($page['Page']['target']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('backend','Layout View'); ?></dt>
		<dd>
			<?php echo $this->Html->link($page['LayoutView']['title'], array('controller' => 'layout_views', 'action' => 'view', $page['LayoutView']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('backend','Meta Title'); ?></dt>
		<dd>
			<?php echo h($page['Page']['meta_title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('backend','Meta Language'); ?></dt>
		<dd>
			<?php echo h($page['Page']['meta_language']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('backend','Meta Robots Tag'); ?></dt>
		<dd>
			<?php echo h($page['Page']['meta_robots_tag']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('backend','Meta Description'); ?></dt>
		<dd>
			<?php echo h($page['Page']['meta_description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('backend','Css Class'); ?></dt>
		<dd>
			<?php echo h($page['Page']['css_class']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('backend','Hide From Nav'); ?></dt>
		<dd>
			<?php echo h($page['Page']['hide_from_nav']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('backend','Hide From Sitemap'); ?></dt>
		<dd>
			<?php echo h($page['Page']['hide_from_sitemap']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('backend','Published'); ?></dt>
		<dd>
			<?php echo h($page['Page']['published']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('backend','Publish Start'); ?></dt>
		<dd>
			<?php echo h($page['Page']['publish_start']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('backend','Publish End'); ?></dt>
		<dd>
			<?php echo h($page['Page']['publish_end']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('backend','Modified'); ?></dt>
		<dd>
			<?php echo h($page['Page']['modified']); ?>
			&nbsp;
		</dd>
				</dl>
		</div>
	
	
	<?php $this->start('actions');?>
	<div class="actions dd-actions">
		<ul>
		<li><button class="ym-button ym-actions"><?php echo __d('backend','Actions'); ?></button>
		<ul>
			<li><?php echo $this->Html->link(__d('backend','Edit %s',__d('backend','Page')), array('action' => 'edit', $page['Page']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__d('backend','Delete %s',__d('backend','Page')), array('action' => 'delete', $page['Page']['id']), null, __d('backend','Are you sure you want to delete # %s?', $page['Page']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__d('backend','List %s',__d('backend','Pages')), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__d('backend','New %s',__d('backend','Page')), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__d('backend','List %s',__d('backend','Layout Views')), array('controller' => 'layout_views', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__d('backend','New %s',__d('backend','Layout View')), array('controller' => 'layout_views', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__d('backend','List %s',__d('backend','Pages')), array('controller' => 'pages', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__d('backend','New %s',__d('backend','Parent Page')), array('controller' => 'pages', 'action' => 'add')); ?> </li>
		</ul>
		</li>
		</ul>
	</div>
	<?php $this->end(); ?>

	<?php
	$blockId = uniqid();
	$this->start($blockId);
	?>
<div class="related">
	<h3><?php echo __d('backend','Related %s',__d('backend','Pages'));?></h3>
	<?php if (!empty($page['ChildPage'])):?>
	<div class="index">
		<table cellpadding = "0" cellspacing = "0">
		<tr>
			<th><?php echo __d('backend','Id'); ?></th>
		<th><?php echo __d('backend','Parent Id'); ?></th>
		<th><?php echo __d('backend','Lft'); ?></th>
		<th><?php echo __d('backend','Rght'); ?></th>
		<th><?php echo __d('backend','Title'); ?></th>
		<th><?php echo __d('backend','Url'); ?></th>
		<th><?php echo __d('backend','Alias'); ?></th>
		<th><?php echo __d('backend','Target'); ?></th>
		<th><?php echo __d('backend','Layout View Id'); ?></th>
		<th><?php echo __d('backend','Meta Title'); ?></th>
		<th><?php echo __d('backend','Meta Language'); ?></th>
		<th><?php echo __d('backend','Meta Robots Tag'); ?></th>
		<th><?php echo __d('backend','Meta Description'); ?></th>
		<th><?php echo __d('backend','Css Class'); ?></th>
		<th><?php echo __d('backend','Hide From Nav'); ?></th>
		<th><?php echo __d('backend','Hide From Sitemap'); ?></th>
		<th><?php echo __d('backend','Published'); ?></th>
		<th><?php echo __d('backend','Publish Start'); ?></th>
		<th><?php echo __d('backend','Publish End'); ?></th>
		<th><?php echo __d('backend','Modified'); ?></th>
			<th class="actions"><?php echo __d('backend','Actions');?></th>
		</tr>
		<?php
			$i = 0;
			foreach ($page['ChildPage'] as $childPage): ?>
		<tr>
			<td><?php echo $childPage['id'];?></td>
			<td><?php echo $childPage['parent_id'];?></td>
			<td><?php echo $childPage['lft'];?></td>
			<td><?php echo $childPage['rght'];?></td>
			<td><?php echo $childPage['title'];?></td>
			<td><?php echo $childPage['url'];?></td>
			<td><?php echo $childPage['alias'];?></td>
			<td><?php echo $childPage['target'];?></td>
			<td><?php echo $childPage['layout_view_id'];?></td>
			<td><?php echo $childPage['meta_title'];?></td>
			<td><?php echo $childPage['meta_language'];?></td>
			<td><?php echo $childPage['meta_robots_tag'];?></td>
			<td><?php echo $childPage['meta_description'];?></td>
			<td><?php echo $childPage['css_class'];?></td>
			<td><?php echo $childPage['hide_from_nav'];?></td>
			<td><?php echo $childPage['hide_from_sitemap'];?></td>
			<td><?php echo $childPage['published'];?></td>
			<td><?php echo $childPage['publish_start'];?></td>
			<td><?php echo $childPage['publish_end'];?></td>
			<td><?php echo $childPage['modified'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__d('backend','View'), array('controller' => 'pages', 'action' => 'view', $childPage['id'])); ?>
				<?php echo $this->Html->link(__d('backend','Edit'), array('controller' => 'pages', 'action' => 'edit', $childPage['id'])); ?>
				<?php echo $this->Form->postLink(__d('backend','Delete'), array('controller' => 'pages', 'action' => 'delete', $childPage['id']), null, __d('backend','Are you sure you want to delete # %s?', $childPage['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
		</table>
	</div>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__d('backend','New %s',__d('backend','Child Page')), array('controller' => 'pages', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="clearfix"></div>
<?php

	$this->end();

	$this->viewVars['tabs'][] = array(
		'title' => __d('backend','Related %s',__d('backend','Pages')),
		'content' => $blockId,
		'type' => 'block'
	);
	?>
