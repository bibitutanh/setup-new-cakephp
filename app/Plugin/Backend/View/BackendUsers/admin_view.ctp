<?php $this->Html->addCrumb(__('Backend'), array('controller'=>'backend', 'action'=>'index')); ?>
<?php $this->Html->addCrumb(__('Backend User'), array('action'=>'index')); ?>
<div class="backendUsers view">
		<h2><?php  echo __d('backend','Backend User');?></h2>
		
		<div class="actions">
			<ul class="actions">
				<li><?php echo $this->Html->link(__d('backend','Edit %s',__d('backend','Backend User')), array('action' => 'edit', $backendUser['BackendUser']['id'])); ?> </li>
				<li><?php echo $this->Form->postLink(__d('backend','Delete %s',__d('backend','Backend User')), array('action' => 'delete', $backendUser['BackendUser']['id']), null, __d('backend','Are you sure you want to delete # %s?', $backendUser['BackendUser']['id'])); ?> </li>
				<li><?php echo $this->Html->link(__d('backend','List %s',__d('backend','Backend Users')), array('action' => 'index')); ?> </li>
				<li><?php echo $this->Html->link(__d('backend','New %s',__d('backend','Backend User')), array('action' => 'add')); ?> </li>
			</ul>
		</div>
			<dl>
				<dt><?php echo __d('backend','Id'); ?></dt>
	<dd>
		<?php echo h($backendUser['BackendUser']['id']); ?>
		&nbsp;
	</dd>
	<dt><?php echo __d('backend','Backend User Group'); ?></dt>
	<dd>
		<?php echo h($backendUser['BackendUserGroup']['name']); ?>
		&nbsp;
	</dd>
	<dt><?php echo __d('backend','Username'); ?></dt>
	<dd>
		<?php echo h($backendUser['BackendUser']['username']); ?>
		&nbsp;
	</dd>
	<dt><?php echo __d('backend','Password'); ?></dt>
	<dd>
		<?php echo h($backendUser['BackendUser']['password']); ?>
		&nbsp;
	</dd>
	<dt><?php echo __d('backend','First Name'); ?></dt>
	<dd>
		<?php echo h($backendUser['BackendUser']['first_name']); ?>
		&nbsp;
	</dd>
	<dt><?php echo __d('backend','Last Name'); ?></dt>
	<dd>
		<?php echo h($backendUser['BackendUser']['last_name']); ?>
		&nbsp;
	</dd>
	<dt><?php echo __d('backend','Mail'); ?></dt>
	<dd>
		<?php echo h($backendUser['BackendUser']['mail']); ?>
		&nbsp;
	</dd>
	<dt><?php echo __d('backend','Last Login'); ?></dt>
	<dd>
		<?php echo h($backendUser['BackendUser']['last_login']); ?>
		&nbsp;
	</dd>
	<dt><?php echo __d('backend','Published'); ?></dt>
	<dd>
		<?php echo h($backendUser['BackendUser']['published']); ?>
		&nbsp;
	</dd>
	<dt><?php echo __d('backend','Created'); ?></dt>
	<dd>
		<?php echo h($backendUser['BackendUser']['created']); ?>
		&nbsp;
	</dd>
			</dl>
	</div>