<div class="view backend auth">
	<h2>Auth user</h2>
	<div class="actions">
		<ul class="actions">
			<li><?php echo $this->Html->link(__d('backend','Change Password'),
					array('plugin'=>'backend','controller'=>'backend_users','action'=>'passc','admin'=>true)
			); ?></li>
			<li><?php echo $this->Html->link(__d('backend','Logout'),
					array('plugin'=>'backend','controller'=>'auth','action'=>'logout','admin'=>true)
			); ?></li>
		</ul>
	</div>
	<dl>
		<?php foreach($authUser as $key => $val): ?>
		<dt><?php echo h(Inflector::humanize($key)); ?>&nbsp;</dt>
		<dd><?php echo $val; ?>&nbsp;</dd>
		<?php endforeach;?>
	</dl>
</div>