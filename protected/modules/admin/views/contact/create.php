<?php
/* @var $this ContactController */
/* @var $model ContactModel */

$this->breadcrumbs=array(
	'Contacts'=>array('admin'),
	'Create',
);
?>
<h1>Create Contact</h1>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>