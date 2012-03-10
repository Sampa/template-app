<?php
	$this->breadcrumbs=array(
		'Users'=>array('index'),
		$model->id,
	);
?>
	<h1><?php echo $model->username; ?></h1>
	
	<a target="_blank" href="<?= User::USER_DIR . $model->id . '/' . $model->avatar;?>">
		<img class="user_avatar"
			src="<?=User::USER_DIR . $model->id . '/' . $model->avatar;?>" 
			alt="Avatar"/>
	</a>
	
	<div id="profile_detail_view">
<?php
	$this->widget('bootstrap.widgets.BootDetailView',
	array(
	'data'=>$model,
	'attributes'=>array(
		'username',
		'email',
		'created',
		'last_activity',
		),
	)); 
?>
	</div>
<?php
	if ( Yii::app()->user->id == $model->id ):
?>
	<button class="update_toggle btn btn-primary" id="update_button" style="float:left;">
		<i class="icon-ok icon-white"></i>Update
	</button> 
  
	<button class="update_toggle btn btn-danger" id="cancel_button" style="float:left; display:none;">
		<i class="icon-ban-circle icon-white"></i>Cancel 
	</button>


	<div id="user_update" style="clear:both;">
		<?=$this->renderPartial('update',array('model'=>$model));?>
	</div>

<?php endif;?>

	<div id="user_presentation" style="clear:both"> <?= $model->presentation; ?> </div>

<?php if ( $this->userId == $model->id || $model->public_library == User::PUBLIC_LIBRARY ): ?>
	<h4> <?= $this->user;?> file library  </h4>
	

<?php 
	Yii::app()->user->setFlash('success',"<p>If you have any images in your library,
		you can press them to view them in a fancybox gallery.</p>
		You can reach these files whenever you see the text-editor, 
		You can see the text-editor when you're creating/updating a post
		or if you are editing your profile");
?>		
<?php $this->widget('bootstrap.widgets.BootAlert'); ?>
	

<?php require('_fileLibrary.php'); ?>
<?php endif; ?>

	<script>
		$(document).ready(function(){
			$("#user_update").toggle();
		});
		$(".update_toggle").click(function(){
			$("#user_update").toggle();
			$("#user_presentation").toggle();
			$("#update_button").toggle();
			$("#cancel_button").toggle();
		});
	</script>	

