<?php
$this->widget('zii.widgets.CMenu', 
	array(
	'items'=>array(
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
		array(
			'label'=>'Logout', 
			'url'=>array( '/site/logout' ), 
			'visible'=>!Yii::app()->user->isGuest
		),
	),
));