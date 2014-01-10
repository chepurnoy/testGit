<?php
/* @var $this PageController */
/* @var $model PageModel */

$this->breadcrumbs=array(
	'Page Models'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List PageModel', 'url'=>array('index')),
	array('label'=>'Manage PageModel', 'url'=>array('admin')),
);
?>

<h1>Create PageModel</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>