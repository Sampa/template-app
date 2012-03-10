<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('username')); ?>:</b>
	<?php echo CHtml::encode($data->username); ?>
	<br />




	<b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
	<?php echo CHtml::encode($data->email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created')); ?>:</b>
	<?php echo CHtml::encode($data->created); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('last_activity')); ?>:</b>
	<?php echo CHtml::encode($data->last_activity); ?>
	<br />

<?php 
	if ( $data->avatar ) 
	{
		$avatar  = User::USER_DIR;//path to base-folder for your avatars
		$avatar .= $data->id."/"; //folder where user files is stored
		$avatar .= Chtml::encode($data->avatar); //the image filename
		echo $avatar;
	}
?>	



</div>