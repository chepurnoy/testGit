<?php
/* @var $this ContactController */
/* @var $model ContactModel */

$this->breadcrumbs=array(
	'Contact Models'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ContactModel', 'url'=>array('index')),
	array('label'=>'Create ContactModel', 'url'=>array('create')),
	array('label'=>'View ContactModel', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ContactModel', 'url'=>array('admin')),
);
?>

<h1>Update ContactModel <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>