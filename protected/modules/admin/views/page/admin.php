<?php Yii::app()->getComponent("bootstrap"); ?>
<?php
/* @var $this PageController */
/* @var $model PageModel */

$this->breadcrumbs=array(
	'Pages'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Pages', 'url'=>array('index')),
	array('label'=>'Create Page', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#page-model-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Pages</h1>
<!-- search-form -->
<?php
$this->widget('application.extensions.yiibooster.widgets.TbGridView', array(
    'type' => 'striped bordered condensed',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
                'title',
                'link',
                array(
                  'name'  => 'content',
                  'value' => 'TruncateText::truncate($data->content,100)',
                ),
        array(
            'class' => 'application.extensions.yiibooster.widgets.TbToggleColumn',
            'toggleAction' => '/admin/page/toggle',
            'name' => 'active',
            'header' => 'Include in main menu',
        ),
        array(
            'class' => 'application.extensions.yiibooster.widgets.TbButtonColumn',
        )),
));
?>

