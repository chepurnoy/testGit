<?php
/* @var $this PageController */
/* @var $model PageModel */

$this->breadcrumbs=array(
	'Manage Pages'=>array('admin'),
	'Update',
);
?>

<h1>Update Page - <?php echo $model->title; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>