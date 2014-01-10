<?php Yii::app()->getComponent("bootstrap"); ?>
<?php
/* @var $this UserController */
/* @var $model UserModel */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Users', 'url'=>array('index')),
	array('label'=>'Create User', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#user-model-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Users</h1>

<?php
$this->widget('application.extensions.yiibooster.widgets.TbGridView', array(
    'type' => 'striped bordered condensed',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
       'firstName',
		'lastName',
		'email',
		'type',
                array(
                    'name'  => 'avatar',
                    'value' => '$data->getImagePath($data->id)',
                    'type'  => 'image',
                    'htmlOptions'=>array('class'=>'avatar'),
                ),
        array(
            'class' => 'application.extensions.yiibooster.widgets.TbButtonColumn',
        )),
));
?>

