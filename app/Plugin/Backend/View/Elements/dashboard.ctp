<?php 
/**
 * !!THIS ELEMENT IS DEPRECATED. Use Backend.DashboardHelper instead!!
 * 
 * Render Dashboard Items from array
 * 
 * @deprecated
 */
?>
<style>
.dashboard-item {
	border-top: 1px solid #CCC;
	margin: 0 0 1em 0;
	min-height: 150px;
	padding: 0 1em;
}

.dashboard-item:HOVER {
	border-top: 1px solid #000;
	background-color: #f8f8f8;	
}

.dashboard-item > a {
}

.dashboard-item > ul {
}
</style>
<?php 
//dashboard settings
$cols = 4;
$width = round(100 / $cols,2);
?>
<?php $i = 0;?>
<div class="row-fluid dashboard">
	<?php foreach($dashboard as $alias => $item):?>
	<div class="span3">
		<div class="dashboard-item <?php echo $alias; ?>">
			<h4><?php echo $this->Html->link($item['title'],$item['url'],@$item['attr']);?></h4>
			
			<?php if ($item['actions']):?>
			<ul>
			<?php foreach($item['actions'] as $action): ?>
				<?php list($title, $url, $attr) = $action; ?>
				<li><?php echo $this->Html->link($title,$url,$attr); ?></li>
			<?php endforeach; ?>
			</ul>
			<?php endif; ?>
		</div>
	</div>
	<?php if (++$i % $cols == 0) echo "</div>\n<div class='row-fluid dashboard'>"; ?>
	<?php endforeach; ?>
</div>