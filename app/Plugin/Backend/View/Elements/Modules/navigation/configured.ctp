<?php 
$config = array_merge(array(
	'load_path' => false,
	'path' => null,
	'key' => ''		
),$module['ModuleConfig']);

if ($config['load_path']) {
	Configure::load($config['path']);
}
$lists = Configure::read($config['key']);
?>

<?php if (empty($lists)):?>
	<?php echo $this->Html->div('box info','Empty'); ?>
	<?php return false; ?>
<?php endif; ?>

<h4>Nav Module</h4>
<?php foreach($lists as $list): ?>
	<ul>
		<?php foreach($list['items'] as $item):?>
			<?php 
			$options = $item;
			$title = $options['title'];
			$url = $options['url'];
			unset($options['url']);
			?>
			<li><?php echo $this->Html->link($title,$url,$options); ?></li>
		<?php endforeach;?>
	</ul>
<?php endforeach;?>
