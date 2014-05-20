<div id="users_login">
	<?php if ($this->get('redirect')):?>
	<div class="login-redirect">
		<?php echo $this->Html->link($this->get('redirect')); ?>
	</div>
	<?php endif; ?>
	<div id="login_form">
		<?php echo $this->Form->create('BackendUser'); ?>
		<fieldset>
			<legend><?php echo __d('backend',"Login");?></legend>
			<div class="row-fluid">
				<div class="span6">
				<?php echo $this->Form->input('username');	?>
				</div>
				<div class="span6">
				<?php echo $this->Form->input('password');	?>
				</div>
			</div>
			<?php
			echo $this->Form->submit(__d('backend',"Login"));
			?>
		</fieldset>
		<?php echo $this->Form->end(); ?>
		
		<div class="auth_info" style="font-size: 80%; color: #CCC; margin-top: 30px;">
			<?php echo date('d.M.Y H:i:s'); ?> |
			<?php echo $this->request->clientIp(); ?><br />
			<?php echo env('HTTP_USER_AGENT') ?> 
		</div>
	</div>
	<?php debug($this->Session->read());?>
</div>