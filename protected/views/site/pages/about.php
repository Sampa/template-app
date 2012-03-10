<?php
$this->pageTitle=Yii::app()->name . ' - About';
$this->breadcrumbs=array(
	'About',
);
?>
<h3> Template app </h3>
<p> 
	<ul class="well">
		<li>User management and customizing is very easy, just use it as any normal Active Record</li>
		<li>User registration with truely random hash using blowfish thanks to tom[] and randomnessextention</li> 
		<li>Each User has their own file library,move,copy,arrange,upload,multi folders etc thanks to elFinder</li>
		<li>Option to set the file library public if wanted</li>
		<li>File library Pictures shows up as a fancybox gallery<li>
		<li>File library subdir's are hidden, so users can hide files the dont want to show for all</li>
		<li>none image files shows up as a download link</li>
		<li>eltre WYSIWYG editor with Filemanager for posts</li>
		<li>tiny eltre for post comments</li>
		<li>Profile with avatar using awesome xupload </li>
		<li>wForm is included with their multi-model-form product demo</li>
		<li>User profile url's like profile/u/username </li>
		<li>Rights is installed giving the best rbac availeble for yii</li>
		<li>Versions with or without bootstrap</li>
	</ul>
		
</p>

<?php
	$this->beginWidget('system.web.widgets.CClipWidget', 
			array('id'=>'sidebar'));
?>    
	<p>It should say true here. Otherwise you have a open ssl config problem. Check xampp/apache
	or whatever you're using.</p>
<?php var_dump( function_exists( 'openssl_random_pseudo_bytes' ) );?>

<?php $this->endWidget(); ?>