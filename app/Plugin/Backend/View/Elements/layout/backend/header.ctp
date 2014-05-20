<style>
span.be-userpanel {
	background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAACXBIWXMAAA3XAAAN1wFCKJt4AAAAB3RJTUUH1gENEyggv+o3tAAAA7JJREFUSMfFlc9vVFUUxz/vRzoz7XSYgdbaH0q09g8g7gyWCiRaysLowsQNkZUblxIiaozJJJP5CyQS3AINCUESYygkRBZA240LcCMaqZYy05npTN/MvN57z3ExBUVraSXGm5y8l3dfvp97znnfd+A/Xt5WXioU85PA+8A4sAOoAteAL48fO/HNU52gUMyfOjt9RsvLZXXOqYioc07Ly2U9O31GC8X8F08jfvLW7E0VEY3jtrbbbbXGqLVGjTEqInpr9ua/gxSK+cmz02dURLTRqGsjanQAzqi1VuO4rc1WU0XkYSaTG+n4mzCOHth/kKgZYa1BRRF1WOtwzuFEcNbSbrc5sP8gwNGNRMJNAOO5bI5KtYLvgScOa8H3BQAVxTmHtZZcNgewd7uAXZ7nYcwaYRCiniMQQXwfFFQ7GTkneJ4H0L9dQElVn8UD6ywBivgevut82Yoionieh6oClLbbg+vVWpVkIrVeCoO1Fussxlqs7ZSnq6uLaq0KcH27gNNXrs6Q3ZElDAKstThjMMbgrMEaQxAEZHp3cOXqDMDpLQMKxbyXy+U+NGuxzM3PMjAwSLqnFwWstSjQ3ZPmmf4B5uZnWV4ul4AbWwZkMpkLh96Ympg6dNhfWLjH9PlzKDA89By7n3+BocERVJXp8+e4t/ALb735dv/Q0Mh8oZj3n9jkQjH/7tjo2L50OuM5Z3htYj93f7rLxa8vUKlUsNYQhiG5bI49e15m9MVRwjBkYnxi98VLF74Cjmzq4FOnT841GnWt1+v64MGSVqsVbTTq2mxGurra0FqtplEUaavV1Cha1ZWVmpbLJW006vrd9Wu1QjHf848lKhTzg319/Tt93yeO2x0HqyAiqCpBEJBKJQkCv+MDEVQ7e61Wi5HhkV7f9z/YtAdhEKRVIYpW8X0fkY6Qc+6Rcx/eizhEBGMMIo6dO3f5YRju2xQQRU3TbK5SLpfXT9kR6ojajhcegwhhGFCr1RARms3WGpDYEHD82InS4v3Fn6Mool6vIyJ/E3fuz/HHXrVapd5YkQdLS98DwUPN4C8JSHdP6k4ct98Ze2msq6+vH1Cck87PQVmHPh6ZTJZSqaSXZ769/fln+U+AJUA3AnDn9g+lZDJxozvd/Xocxzo0OBxmMhlNJFKaSCQfRTKZ1FSqR8Mw1N8Wf21funRx/uOPPn1PRH4EzJNmcggMTB2efOXV8b3nnjScZi5fOTJz+eoMcB+Q7Qz9AEgDvevXnvVnAkTAKlBfD+X/WL8DZ/99vjWnsNQAAAAASUVORK5CYII=);
	background-position: left center;
	background-repeat: no-repeat;
	padding: 10px;
	color:#FFF;
	padding-left: 25px;
	margin-right: 10px;
}

span.be-userpanel:HOVER {
	background-color: #FFF;
	color: #000;
}
</style>
<div class="navbar navbar-inverse navbar-fixed-top">
	<div class="navbar-inner">
		<div class="container-fluid">
			<div class="nav-collapse collapse">
	            <p class="navbar-text pull-right">
				<span class="be-userpanel">
					<?php if (!class_exists('AuthComponent')):?>
						Authentication is DISABLED!
					<?php elseif (AuthComponent::user()):?>
						<?php echo 	$this->Html->link(AuthComponent::user('username'),
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
				</span>
	            </p>
	            <ul class="nav" id="header-nav">
				<?php 
				// Display Dashboard title
				if (Configure::read('Backend.Dashboard.title')):
					if (Configure::read('Backend.Dashboard.url')) {
						$dbTitle = $this->Html->link(Configure::read('Backend.Dashboard.title'),
								Configure::read('Backend.Dashboard.url')
						); 
					} else {
						$dbTitle = Configure::read('Backend.Dashboard.title');
					}
					$class = (!isset($this->request->params['plugin'])) ? "active" : "";
					echo $this->Html->tag('li', $dbTitle, compact('class'));
					unset($dbTitle);
				endif; 
				?>
	            <?php 
	            // Display plugins
	            foreach((array) Configure::read('Backend.Dashboard.plugins') as $_plugin):

	            	$link = $this->Html->link($_plugin,
	              		array('plugin'=>Inflector::underscore($_plugin),'controller'=>Inflector::underscore($_plugin),'action'=>'index')); 
	            	
					$class = (Inflector::underscore($_plugin) == $this->request->params['plugin']) ? "active" : "";
					echo $this->Html->tag('li', $link, compact('class'));
	            endforeach; 
	            ?>
	            <?php 
	            // Display custom nav items
	            // Check for 'be-nav-custom' viewblock or fallback to element
	            //TODO fallback to configuration
	            //TODO make block name configurable
	            echo $this->fetch('be-header-nav-custom', 
					$this->element('Backend.layout/backend/header-nav-custom'));
	            ?>
	            </ul>
          </div>
		</div>
	</div>
	<!-- #navbar-inner -->
	<style>
	#be-navpanel {
		padding: 1em 0;
		background-color: #333;
		box-shadow: 0px 5px 15px #333;
		display:none;
	}
	            	
	#be-navpanel ul {
	    margin: 0;
	    padding: 0;
	}
	
	#be-navpanel ul li {
	    background-color: transparent;
	    background-image: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAABfCAMAAAAeT108AAAABlBMVEX////W1tZkFI+EAAAAAXRSTlMAQObYZgAAABdJREFUeNrVwwENAAAAwiDev7Q5ZEP8HhKOADGMXVvVAAAAAElFTkSuQmCC");
	    background-position: 100% 0;
	    background-repeat: no-repeat;
	    display: inline;
	    float: left;
	    line-height: 1.1;
	    list-style-type: none;
	    margin: 10px 20px 0 0;
	    padding: 0;
	}

	#be-navpanel h2 {
	    font-size: 13px;
	    font-weight: bold;
	    margin: 0 20px 0.4em 0;
	    white-space: nowrap;
		line-height: 13px;
		color: #FFF;
	}	

	#be-navpanel ul li ul li {
	    float: none;
	    height: auto;
	    margin: 0;
	}
	
	#be-navpanel a {
	    color: #CCC;
	    display: block;
	    outline: 0 none;
	    padding: 0.4em 20px 0.4em 0;
	}	
	
	#be-navpanel a:HOVER {
		color: #FFF;
	}
	
	</style>
	
	<?php if (Configure::read('Backend.Navigation.default')):?>
	<div id="be-navpanel">
		<div class="container-fluid">
			<ul>
				<?php foreach((array) Configure::read('Backend.Navigation.default') as $n):?>
				<li>
					<h2><?php echo $this->Html->link($n['title'],$n['url']);?></h2>
					<ul>
						<?php foreach($n['actions'] as $nitem):?>
						<?php list($title,$url,$attr) = $nitem; ?>
						<li><?php echo $this->Html->link($title,$url,$attr); ?></li>
						<?php endforeach; ?>
					</ul>
				</li>
				<?php endforeach; ?>
			</ul>
			<div class="clearfix"></div>
		</div>
	</div>
	<?php //TODO use css3 instead of jquery here ?>
	<script>
	$(document).ready(function() {
		$('#header-nav').append('<li><a href="#nav" id="be-navtoggle">#</a></li>');
		$('#be-navtoggle').click(function() {
			$('#be-navtoggle').toggleClass('opened');
			$('#be-navpanel').slideToggle(400);
		});	
	});
	</script>
	<?php endif; ?>
</div>