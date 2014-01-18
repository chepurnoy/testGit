<?php Yii::app()->getComponent("bootstrap"); ?>
<?php
/* @var $this PageController */
/* @var $model PageModel */

$this->breadcrumbs=array(
	'Manage Pages',
);
?>
<div class="page-header">
<p><a class="btn btn-primary btn-lg" href="<?php echo Yii::app()->createUrl('admin/page/create'); ?>" role="button">Create Page</a></p>
</div>
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
            'template' => "{update}{delete}"
        )),
));
?>

