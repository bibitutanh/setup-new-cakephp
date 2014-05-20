<?php 
$requestUrl = $module['ModuleConfig']['request_url'];
$tokenMap = array(
	'/{ROOT}\/?/' => '',	
	'/{FULLROOT}\/?/' => '',	
	//'/{ROOT}\/?/' => Router::url('/',false),	
	//'/{FULLROOT}\/?/' => Router::url('/',true),	
);
$requestUrl = preg_replace(array_keys($tokenMap), array_values($tokenMap), $requestUrl);

debug($requestUrl);

try {
	$lists = $this->requestAction($requestUrl);
} catch(Exception $e) {
	$lists = false;
	$exception = $e;
}
?>

<?php if (isset($exception)):?>
	<?php echo $this->Html->div('box info',$exception->getMessage()); ?>
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
