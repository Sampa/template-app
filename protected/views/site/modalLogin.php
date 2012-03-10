	<div class="form">
<?php 
	$form = $this->beginWidget('BootActiveForm',array(
		'id'=>'login-form',
		'enableAjaxValidation'=>true,
	)); 
?>
	<div class="modal-header">
		<a class="close" data-dismiss="modal">&times;</a>
		<h3>Please fill out the following form with your login credentials</h3>
	</div>

	<div class="modal-body">
		<p class="note">Fields with <span class="required">*</span> are required.</p>

		<div class="row">
			<?php echo $form->labelEx($model,'username'); ?>
			<?php echo $form->textField($model,'username'); ?>
			<?php echo $form->error($model,'username'); ?>
		</div>

		<div class="row">
			<?php echo $form->labelEx($model,'password'); ?>
			<?php echo $form->passwordField($model,'password'); ?>
			<?php echo $form->error($model,'password'); ?>
			<p class="hint">
				Hint: You may login with  <tt>admin/admin</tt>.
			</p>
		</div>

		<div class="row rememberMe">
			<?php echo $form->checkBox($model,'rememberMe'); ?>
			<?php echo $form->label($model,'rememberMe'); ?>
			<?php echo $form->error($model,'rememberMe'); ?>
		</div>

	</div>
	<div class="modal-footer">
		<?php echo CHtml::submitButton('Login',array('class'=>'btn btn-primary')); ?>
		<?php echo CHtml::link('Close', '#', array('class'=>'btn', 'data-dismiss'=>'modal')); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->
