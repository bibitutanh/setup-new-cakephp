<style>
div.be-user-auth {
	background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAACXBIWXMAAA3XAAAN1wFCKJt4AAAAB3RJTUUH1gENEyggv+o3tAAAA7JJREFUSMfFlc9vVFUUxz/vRzoz7XSYgdbaH0q09g8g7gyWCiRaysLowsQNkZUblxIiaozJJJP5CyQS3AINCUESYygkRBZA240LcCMaqZYy05npTN/MvN57z3ExBUVraSXGm5y8l3dfvp97znnfd+A/Xt5WXioU85PA+8A4sAOoAteAL48fO/HNU52gUMyfOjt9RsvLZXXOqYioc07Ly2U9O31GC8X8F08jfvLW7E0VEY3jtrbbbbXGqLVGjTEqInpr9ua/gxSK+cmz02dURLTRqGsjanQAzqi1VuO4rc1WU0XkYSaTG+n4mzCOHth/kKgZYa1BRRF1WOtwzuFEcNbSbrc5sP8gwNGNRMJNAOO5bI5KtYLvgScOa8H3BQAVxTmHtZZcNgewd7uAXZ7nYcwaYRCiniMQQXwfFFQ7GTkneJ4H0L9dQElVn8UD6ywBivgevut82Yoionieh6oClLbbg+vVWpVkIrVeCoO1Fussxlqs7ZSnq6uLaq0KcH27gNNXrs6Q3ZElDAKstThjMMbgrMEaQxAEZHp3cOXqDMDpLQMKxbyXy+U+NGuxzM3PMjAwSLqnFwWstSjQ3ZPmmf4B5uZnWV4ul4AbWwZkMpkLh96Ympg6dNhfWLjH9PlzKDA89By7n3+BocERVJXp8+e4t/ALb735dv/Q0Mh8oZj3n9jkQjH/7tjo2L50OuM5Z3htYj93f7rLxa8vUKlUsNYQhiG5bI49e15m9MVRwjBkYnxi98VLF74Cjmzq4FOnT841GnWt1+v64MGSVqsVbTTq2mxGurra0FqtplEUaavV1Cha1ZWVmpbLJW006vrd9Wu1QjHf848lKhTzg319/Tt93yeO2x0HqyAiqCpBEJBKJQkCv+MDEVQ7e61Wi5HhkV7f9z/YtAdhEKRVIYpW8X0fkY6Qc+6Rcx/eizhEBGMMIo6dO3f5YRju2xQQRU3TbK5SLpfXT9kR6ojajhcegwhhGFCr1RARms3WGpDYEHD82InS4v3Fn6Mool6vIyJ/E3fuz/HHXrVapd5YkQdLS98DwUPN4C8JSHdP6k4ct98Ze2msq6+vH1Cck87PQVmHPh6ZTJZSqaSXZ769/fln+U+AJUA3AnDn9g+lZDJxozvd/Xocxzo0OBxmMhlNJFKaSCQfRTKZ1FSqR8Mw1N8Wf21funRx/uOPPn1PRH4EzJNmcggMTB2efOXV8b3nnjScZi5fOTJz+eoMcB+Q7Qz9AEgDvevXnvVnAkTAKlBfD+X/WL8DZ/99vjWnsNQAAAAASUVORK5CYII=);
	background-position: left center;
	background-repeat: no-repeat;
	padding: 10px;
	color:#FFF;
	padding-left: 25px;
	margin-right: 10px;
}

div.be-user-auth:HOVER {
	background-color: #FFF;
	color: #000;
}
</style>
<div class="be-user-auth">
	<?php if (AuthComponent::user()):?>
		<?php echo 	$this->Html->link(AuthComponent::user('mail'),
						array('plugin'=>'backend','controller'=>'auth','action'=>'user','admin'=>true)
		);?> |
		<?php echo $this->Html->link(__d('backend','Logout'),
				array('plugin'=>'backend','controller'=>'auth','action'=>'logout','admin'=>true)
		); ?>
	<?php else: ?>
		<?php echo __d('backend','Not logged in'); ?> |
		<?php echo $this->Html->link(__d('backend','Login'),
				array('plugin'=>'backend','controller'=>'auth','action'=>'login','admin'=>true)
		); ?>
	<?php endif; ?>
</div>
