<?php Yii::app()->getComponent("bootstrap"); ?>
<?php
/* @var $this ContactController */
/* @var $model ContactModel */

$this->breadcrumbs=array(
	'Contacts'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Contacts', 'url'=>array('index')),
	array('label'=>'Create Contact', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#contact-model-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Contacts</h1>
<!-- search-form -->
<?php
$this->widget('application.extensions.yiibooster.widgets.TbGridView', array(
    'type' => 'striped bordered condensed',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
                'name',
		'email',
		'subject',
		'message',
		'dateSend',
        array(
            'class' => 'application.extensions.yiibooster.widgets.TbButtonColumn',
        )),
));
?>

