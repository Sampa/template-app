<?php class File {


public function getFiles($dir, $order=""){
		$dir = Yii::app()->getBasePath()."/../".$dir;
		$files = array_diff(scandir($dir,$order), array('..', '.'));

		return $files;
	
	}


}