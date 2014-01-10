<?php
/* @var $this PageController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Page Models',
);

$this->menu=array(
	array('label'=>'Create PageModel', 'url'=>array('create')),
	array('label'=>'Manage PageModel', 'url'=>array('admin')),
);
?>

<h1>Page Models</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
