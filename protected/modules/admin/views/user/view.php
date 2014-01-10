<?php
/* @var $this UserController */
/* @var $model UserModel */

$this->breadcrumbs=array(
	'User Models'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List UserModel', 'url'=>array('index')),
	array('label'=>'Create UserModel', 'url'=>array('create')),
	array('label'=>'Update UserModel', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete UserModel', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage UserModel', 'url'=>array('admin')),
);
?>

<h1>View UserModel #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'firstName',
		'lastName',
		'email',
		'type',
		'avatar',
		'password',
		'lastLogin',
		'dateCreate',
	),
)); ?>
