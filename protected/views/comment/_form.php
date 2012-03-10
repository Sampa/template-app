<div class="form">

<?php 
	$form = $this->beginWidget('bootstrap.widgets.BootActiveForm', 
	array(
		'id'=>'comment-form',
		'enableAjaxValidation'=>true,
		'enableClientValidation'=>true,
		 'clientOptions' => 
		 array(
		  'validateOnSubmit'=>true,
		  'validateOnChange'=>true,
		  'validateOnType'=>true,
			 ),
		'htmlOptions'=>array( 'class'=>'well' ),
		) );
 ?>
	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<div class="row">
		<?php echo $form->labelEx($model,'author'); ?>
		<?php echo $form->textField($model,'author',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'author'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'url'); ?>
		<?php echo $form->textField($model,'url',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'url'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'content'); ?>
		<?php echo $form->hiddenField($model,'content'); ?>
		<?php echo $form->error($model,'content'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Submit' : 'Save',
				array('class'=>'btn btn-primary') ); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->
<?php 
	$this->widget('application.extensions.elrte.elRTE', array(
		'selector'=>'Comment_content',
		'userid'=>Yii::app()->user->id,

		'toolbar'=>'tiny',
	));
?>