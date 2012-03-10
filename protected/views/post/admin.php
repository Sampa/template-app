<?php
$this->breadcrumbs=array(
	'Manage Posts',
);
?>
<h1>Manage Posts</h1>

<?php
	$this->widget('bootstrap.widgets.BootGridView', 
	array(
	'id'=>'post-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'itemsCssClass'=>'table table-striped table-bordered table-condensed',
	'columns'=>array(
			array(
				'name'=>'title',
				'type'=>'raw',
				'value'=>'CHtml::link( CHtml::encode( $data->title ), $data->url )',
			),
			array(
				'name'=>'status',
				'filter'=>false,
			),
			array(
				'name'=>'create_time',
				'type'=>'datetime',
				'filter'=>false,
			),
			array(
				 'class'=>'bootstrap.widgets.BootButtonColumn',
				'htmlOptions'=>array( 'style'=>'width: 50px' ),
			),
		),
	)); 
?>
