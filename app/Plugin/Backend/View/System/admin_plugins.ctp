<?php $this->Html->addCrumb(__('Backend'),array('controller'=>'backend', 'action'=>'index')); ?>
<?php $this->Html->addCrumb(__d('backend','Systeminfo'),array('action'=>'index')); ?>
<?php $this->Html->addCrumb(__d('backend','Plugins'),array('action'=>'plugins')); ?>
<div>
	<h2><?php echo __d('backend','Plugins'); ?></h2>
	<dl>
		<?php foreach($plugins as $plugin):?>
			<dt><?php echo $this->Html->link(Inflector::humanize($plugin),array(
				'plugin'=>Inflector::underscore($plugin),
				'controller'=>Inflector::underscore($plugin),
				'action' => 'index' 
			)); ?>&nbsp;</dt>
			<dd><?php echo CakePlugin::path($plugin);?>&nbsp;</dd>
		<?php endforeach;?>
	</dl>
</div>