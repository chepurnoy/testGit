<?php
/* @var $this UserController */
/* @var $model UserModel */

$this->breadcrumbs=array(
	'Users'=>array('admin'),
	'Update',
);

?>
<div class="page-header">
<h1>Update User - <?php echo $model->firstName ." ". $model->lastName; ?></h1>
</div>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>