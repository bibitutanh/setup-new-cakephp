<div class="adminPanelAppearance">
	<h1><?php echo __("Appearance")?>: Form I</h1>
	
	<div style="max-width: 600px">
		<?php echo $this->Form->create('Appearance',array('class'=>'form1')); ?>
		<?php echo $this->Form->input('id'); ?>
		<fieldset>
			<legend><?php echo __("Text");?></legend>
			<?php echo $this->Form->input('text', array('type'=>'text')); ?>
		</fieldset>

		<fieldset>
			<legend><?php echo __("Select");?></legend>
			<?php echo $this->Form->input('select', array(
				'type'=>'select',
				'options' => array(
					'S' => "Small",
					'L' => "Large",
					'M' => "Mega",
				)
			)); ?>
		</fieldset>
		
		<fieldset>
			<legend><?php echo __("Radio");?></legend>
			<?php echo $this->Form->input('radio', array(
				'type'=>'radio',
				'options' => array(
					'S' => "Small",
					'L' => "Large",
					'M' => "Mega",
				)
			)); ?>
		</fieldset>
		
		<fieldset>
			<legend><?php echo __("Checkbox");?></legend>
			<?php echo $this->Form->input('checkbox', array(
				'type'=>'checkbox',
				'options' => array(
					'S' => "Small",
					'L' => "Large",
					'M' => "Mega",
				)
			)); ?>
		</fieldset>
	</div>
	
</div>
