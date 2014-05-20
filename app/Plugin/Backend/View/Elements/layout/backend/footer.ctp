<div style="padding: 1em;">
	<p style="text-align: right; font-size: 10px; color: #CCC; line-height: 11px;">
	<?php 
		echo 'Backend Plugin Version ' . h(file_get_contents(App::pluginPath('Backend').DS.'VERSION.txt')); 
	?><br />
	<?php echo 'IP: '. $this->request->clientIp(); ?><br />
	<?php echo 'UserAgent: '.env('HTTP_USER_AGENT') ?><br />
	<?php echo date('d.M.Y H:i:s'); ?>
	</p>
</div>