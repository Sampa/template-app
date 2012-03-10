	<div class="form">
<?php 
	$form = $this->beginWidget('bootstrap.widgets.BootActiveForm', 
	array(
		'id'=>'user-form',
		'enableAjaxValidation'=>true,
		'enableClientValidation'=>true,
			'clientOptions'=>array(
				'validateOnChange'=>true,
				'validateOnFocus'=>true,
				'validateOnType'=>true,
			),
		'htmlOptions'=>array( 'class'=>'well' ),
		) ); 
?>	
	<div class="modal-header">
		<a class="close" data-dismiss="modal">&times;</a>
		<h3>Sign up</h3>
	</div>

	<div class="modal-body">
	
	<div class="form" >

	

	
<?php echo $form->errorSummary($model); ?>
	<div class="row">
		<?php echo $form->hiddenField($model,'avatar',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	
	<?php echo $form->hiddenField($model,'id', array( 'value'=>$model->id ) );?>
	
	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username',
			array( 'size'=>60,'maxlength'=>128,'disabled'=>'disabled')); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'password2'); ?>
		<?php echo $form->passwordField($model,'password2',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'password2'); ?>
	</div>
	

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>
</div>

	
	<div class="modal-footer">
	<?php
		echo CHtml::htmlButton('<i class="icon-ok icon-white"></i>Sign up',
			array('class'=>'btn btn-primary', 'type'=>'submit') ); 
		echo CHtml::link( '<i class="icon-ban-circle"></i> Close', '#', array( 'class'=>'btn', 'data-dismiss'=>'modal' ) ); 
	?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->
