<?php $this->Html->css('/backend/css/backend/vmenu',null,array('inline'=>false)); ?>
<div class="be-vmenu-wrapper">
<ul class="be-vmenu">
	<?php foreach((array) $nav as $alias => $n):?>
	<?php 
	$class = "";
	if (preg_match('@^'.Router::normalize($n['url']).'@', Router::normalize($this->request->url))) {
		$class .= " active";
	}
	?>
	<li class="menu-item-<?php echo h($alias); ?>">
		<?php $title = (isset($n['counter'])) ? h($n['title']).sprintf('<span>%s</span>',$n['counter']) : h($n['title']); ?>
		<?php echo $this->Html->link($title,$n['url'],array(
				'escape'=>false,
				'class'=>$class,
		));?> 
		<ul class="menu-level-1">
			<?php foreach($n['actions'] as $nitem):?>
			<?php 
				@list($title,$url,$attr,$counter) = $nitem;
				$title = ($counter) ? $title.sprintf('<span>%s</span>',$counter) : $title;
				
				$attr = (is_array($attr)) ? $attr : array();
				$attr['escape'] = false; 
				
				if (preg_match('@^'.Router::normalize($url).'$@', Router::normalize($this->request->url))) {
					$attr['class'] = "active";
				}
			?>
			<li class="menu-subitem"><?php echo $this->Html->link($title,$url,$attr); ?></li>
			<?php endforeach; ?>
		</ul>
	</li>
	<?php endforeach; ?>
</ul>
</div>

<script type="text/javascript">
$(function() {
    var menu_ul = $('.be-vmenu > li > ul'),
        menu_a  = $('.be-vmenu > li > a');
    menu_ul.hide();
    menu_a.click(function(e) {
        //if ($(this).hasClass('direct'))
        //    return;
        
        e.preventDefault();
        if(!$(this).hasClass('active')) {
            menu_a.removeClass('active');
            menu_ul.filter(':visible').slideUp('normal');
            $(this).addClass('active').next().stop(true,true).slideDown('normal');
        } else {
            $(this).removeClass('active');
            $(this).next().stop(true,true).slideUp('normal');
        }
    });

    $('.be-vmenu > li > a.active').each(function() {
		$(this).next().stop(true,true).show();
    });

    $('.be-vmenu > li > ul li a.active').each(function() {
		$(this).parent().parent().parent().children('a').addClass('active');
		$(this).parent().parent().show();
    });
});
</script>
