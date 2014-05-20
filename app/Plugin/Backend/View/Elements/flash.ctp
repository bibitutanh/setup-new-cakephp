<?php 
/**
 * TwitterBootstrap compatible flash messages
 */
?>
<div class="alert alert-block <?php echo "alert-".h($type);?>">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	<?php if ($title != 'Default'):?>
	<h4><?php echo h($title); ?></h4>
	<?php endif;?>
	<p>
	<?php echo h($message); ?>
	</p>
	
	<?php if (isset($validationErrors)):?>
		<ul style="margin-top: 1em;">
		<?php foreach($validationErrors as $field => $errors):
			foreach($errors as $error) {
				if (Configure::read('debug')>0)
					$li = sprintf("%s: %s",$field,$error);
				else
					$li = $error;
				
				echo $this->Html->tag('li',$li);
			}
			endforeach;
		?>
		</ul>
	<?php endif;?>
</div>