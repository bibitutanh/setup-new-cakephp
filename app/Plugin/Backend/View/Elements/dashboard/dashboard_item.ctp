<?php if ($item['actions']):?>
<ul>
<?php foreach($item['actions'] as $action): ?>
	<?php list($title, $url, $attr) = $action; ?>
	<li><?php echo $this->Html->link($title,$url,$attr); ?></li>
<?php endforeach; ?>
</ul>
<?php endif; ?>
