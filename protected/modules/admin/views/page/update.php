<?php
/* @var $this PageController */
/* @var $model PageModel */

$this->breadcrumbs=array(
	'Page Models'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List PageModel', 'url'=>array('index')),
	array('label'=>'Create PageModel', 'url'=>array('create')),
	array('label'=>'View PageModel', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage PageModel', 'url'=>array('admin')),
);
?>

<h1>Update PageModel <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>