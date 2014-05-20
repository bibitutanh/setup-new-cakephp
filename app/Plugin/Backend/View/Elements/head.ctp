
		
<?php return false; ?>

<?php echo $this->Html->css('/backend/css/cake'); ?>

 <!-- mobile viewport optimisation -->
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- stylesheets -->
<?php echo $this->Html->css('/backend/css/yaml/core/base'); ?>
<?php echo $this->Html->css('/backend/css/yaml/forms/gray-theme.custom'); ?>
<?php echo $this->Html->css('/backend/css/typography'); ?>

<!--[if lte IE 7]>
<?php echo $this->Html->css('/backend/css/yaml/core/iehacks.min'); ?>
<![endif]-->
		
<?php echo $this->Html->css('/backend/css/style'); ?>
<?php echo $this->Html->css('/backend/css/forms'); ?>
<?php echo $this->Html->css('/backend/css/module'); ?>
<!--[if gte IE 9]>
  <style type="text/css">
    .gradient {
       filter: none;
    }
  </style>
<![endif]-->

<!--[if lt IE 9]>
<?php echo $this->Html->script('/backend/js/html5shiv'); ?>
<![endif]-->

<?php echo $this->Html->script('/backend/js/jquery-1.7.2.min'); ?>
<?php echo $this->Html->script('/backend/js/jquery.sortable.min'); ?>
<?php echo $this->Html->script('/backend/js/backend'); ?>