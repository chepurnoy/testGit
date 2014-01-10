<?php
/* @var $this ContactController */
/* @var $model ContactModel */

$this->breadcrumbs=array(
	'Contact Models'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ContactModel', 'url'=>array('index')),
	array('label'=>'Manage ContactModel', 'url'=>array('admin')),
);
?>

<h1>Create ContactModel</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>