<?php
/* @var $this PageController */
/* @var $model PageModel */

$this->breadcrumbs=array(
	'Pages'=>array('admin'),
);
?>

<h1>Create Page</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>