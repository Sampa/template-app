<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />


	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css" />
<?php  //to be able to use xupload and eltre on the same page we need this scriptmap
	$scriptmap=Yii::app()->clientScript;
	$scriptmap->scriptMap=array(
	        'jquery.min.js'=>'https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js',
	        'jquery-ui.min.js'=>'https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery-ui.min.js',

			);
?>
	<?php  Yii::app()->clientScript->registerScriptFile('/js/jquery.multiplyforms.js');?>
	<?php  Yii::app()->clientScript->registerScriptFile('/js/common.js');?>


	<title><?php echo CHtml::encode( $this->pageTitle ); ?></title>
</head>

<body>

<div class="container" id="page">

	<!--header 
	<div id="header">
		<div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
	</div>
	-->

	<div id="mainMenu">
<?php 
	$this->widget('application.extensions.mbmenu.MbMenu',array( 
		'items'=>array( //Top level
				array('label'=>'Home', 'url'=>array('/post/index')),
				array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
				array('label'=>'Contact', 'url'=>array('/site/contact')),
				array('label'=>'Products', 'url'=>array('/product')),
				array('label'=>$this->user, 'url'=>array( User::getUserLink( $this->user ) ),
				'visible'=>!$this->isGuest,
                  'items'=>array( //Submenu under the users name
					array('label'=>'Profile', 'url'=>array( User::getUserLink( $this->user ) ) ),
                    array('label'=>'Update','url'=>array( '//user/update/id/' . Yii::app()->user->id ) ), 
					array('label'=>'Rights', 'url'=>array( '/rights' ),
							'visible'=>Yii::app()->user->checkAccess(Rights::module()->superuserName ) ),
					array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 
							'visible'=>!$this->isGuest ),
						array('label'=>'Posts','url'=>array( '//posts/index'),
							'visible'=>Yii::app()->user->checkAccess( 'Post.Admin' ),
								'items'=>array( //submenu under "Posts" If user has Post.Admin
									array(
										'label'=>'Create New Post', 
										'url'=>array( '/post/create' ), 
										'visible'=>Yii::app()->user->checkAccess( 'Post.Create' )
									),
									array(
										'label'=>'Manage Posts', 
										'url'=>array( '/post/admin' ), 
										'visible'=>Yii::app()->user->checkAccess( 'Post.Admin' )
									),
									array(
										'label'=>Yii::t( 'blog', 'Approve Comments (:commentCount)', 
											array( ':commentCount'=>Comment::model()->pendingCommentCount ) ), 
												'url'=>array('/comment/index'),
												'visible'=>Yii::app()->user->checkAccess( 'Comment.Approve' )
									),
								
								), 
							), //End posts + submenu
						), 
                  ),//End username + submenu
				array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'Register', 'url'=>array('/user/register'), 'visible'=>Yii::app()->user->isGuest),
			),
		)); 
?>
	</div><!-- mainmenu -->
	
	<!-- flashes -->
<?php 
	$this->widget('application.extensions.flash.Flash', 
		array(
		'keys'=>array( 'success','error' ),
		'htmlOptions'=>array( 'class'=>'flash' ),
	)); 
?>

	<!-- breadcrumbs -->
<?php
	$this->widget('bootstrap.widgets.BootBreadcrumbs', 
		array(	'links'=>$this->breadcrumbs,
	)); 
?>

	<?php echo $content; ?>

		<div id="footer">
			Copyright &copy; <?php echo date('Y'); ?><br />
			All Rights Reserved.<br/>
		</div><!-- footer -->

	</div><!-- page -->


</body>
</html>