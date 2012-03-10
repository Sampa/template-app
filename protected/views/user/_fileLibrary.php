<?php // This is the file library shown on User profile
	$dir = new File; 
	$path = User::USER_DIR . $model->id;
	$files = $dir->getFiles( $path , 1 );
	$count = 0;
	$imgExtentions = array('jpeg' , '.png' , '.jpg' , '.gif' , '.png' );
	$ignore = array('.tmb','.dll');
	
	foreach( $files as $file )
	{	

		$fileExt = strtolower( substr( $file , -4 , 4 ) );
		if ( !is_dir( '.' . $path .'/'. $file ) )
		{ 
		$fileName = $file;
		
			if ( in_array( $fileExt , $imgExtentions ) )
			{
				$fileName = '<img  style="min-width: 150px; min-height="100px" src="' . $path .'/'. $file . '" alt="picture"/>';
			}
			if ( !in_array( $fileExt , $ignore ) )
			{
				echo '<li class="span2" style="display:inline">';
					echo CHtml::link( $fileName, array( $path . '/' . $file ),array( 'class'=>'filename thumbnail', 'rel'=>'fancybox' ) );
				echo '</li>';
			}
		$count++;
		}
	}
?>
<?php
	$this->widget('application.extensions.fancybox.EFancyBox', 
	array(
		'target'=>'a[rel=fancybox]',
		'config'=>array(),
		)
	);
?>