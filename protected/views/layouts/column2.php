<?php $this->beginContent('application.views.layouts.main'); ?>
<div class="container">
	<div class="span-18">
		<div id="content">
			<?php echo $content; ?>
		</div><!-- content -->
	</div>
	<div class="span-6 last">
		<div id="sidebar">

			<?php 
				$this->widget('TagCloud', 
				array(
					'maxTags'=>Yii::app()->params['tagCloudCount'],
				)); 
			?>

			<?php 
				$this->widget('RecentComments', 
				array(
					'maxComments'=>Yii::app()->params['recentCommentCount'],
				)); 
			?>

			<button class="btn btn-primary" id="loginButton"><!-- loginbutton-->
				Login
			</button> <!--login button-->
			
			<button class="btn btn-primary" id="regButton"><!-- sign up button-->
				Sign up
			</button> <!--sign up button-->

			<!-- files with modalwindow, ajax calls etc for easier reading -->
			<?php echo $this->renderPartial('//site/_login'); ?> 
			<?php echo $this->renderPartial('//site/_reg');?>
			
			
			<?php echo $this->clips['sidebar']; ?>


		</div><!-- sidebar -->
	</div>
</div>
<?php $this->endContent(); ?>