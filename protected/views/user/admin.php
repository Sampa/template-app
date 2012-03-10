<?php
	$this->breadcrumbs = array(
		'Users'=>array('index'),
		'Manage',
	);

	$this->menu=array(
		array('label'=>'List User', 'url'=>array('index')),
		array('label'=>'Create User', 'url'=>array('create')),
	);

	Yii::app()->clientScript->registerScript('search', "
	$('.search-button').click(function(){
		$('.search-form').toggle();
		return false;
	});
	$('.search-form form').submit(function(){
		$.fn.yiiGridView.update('user-grid', {
			data: $(this).serialize()
		});
		return false;
	});
	");
?>

	<h1>Manage Users</h1>

	<p>
	You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
	or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
	</p>

	<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
	<div class="search-form" style="display:none">
	<?php $this->renderPartial('_search',array(
		'model'=>$model,
	)); ?>
	</div><!-- search-form -->
	
<?php
		$this->widget('bootstrap.widgets.BootGridView', 
		array(
		'id'=>'user-grid',
		'dataProvider'=>$model->search(),
		'filter'=>$model,
		'itemsCssClass'=>'table table-striped table-bordered table-condensed',
		'columns'=>array(
			array(
				'name'=>'id',
				'filter'=>false,
			),
			array(
				'name'=>'username',
				'filter'=>false,
			),
			array(
				'name'=>'email',
				'filter'=>false,
			),
			array(
				'name'=>'created',
				'filter'=>false,
			),
			array(
				'name'=>'last_activity',
				'filter'=>false,
			),
		
			array(
				'class'=>'bootstrap.widgets.BootButtonColumn',
				'htmlOptions'=>array('style'=>'width: 80px'),
			),
		),
	)); 
?>
