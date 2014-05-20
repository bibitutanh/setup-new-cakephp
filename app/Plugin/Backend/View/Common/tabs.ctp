<?php
//do not wrap in tabs on ajax request
if ($this->request->is('ajax') && !isset($useTabsOnAjaxRequest)):
	echo $this->fetch('content'); 
	return true;
endif; 
?>
<?php 
$this->Helpers->load('JqueryUi.JqueryUiTabs');
$tabs = (isset($this->viewVars['tabs'])) ? $this->viewVars['tabs'] : array(); 

array_unshift($tabs,array(
	'title' => $this->fetch('title'),
	'content' => $this->fetch('content'),
	'type' => 'content'
));
?>
<div class="view">

	<h2><?php echo $this->fetch('title');?></h2>
	
	<?php echo $this->fetch('actions'); ?>		
	
	<?php echo $this->JqueryUiTabs->generateTabs($tabs); ?>
	
</div>