<?php Yii::app()->getComponent("bootstrap"); ?>
<?php
/* @var $this UserController */
/* @var $model UserModel */

$this->breadcrumbs = array(
    'Manage Users',
);
?>
<script>
$(function(){
    $(".avatar img").addClass("thumbnail");
})
</script>
<div class="page-header">
    <p><a class="btn btn-primary btn-lg" href="<?php echo Yii::app()->createUrl('admin/user/create'); ?>" role="button">Create User</a></p>
</div>
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
            'name' => 'avatar',
            'value' => '$data->getImagePath($data->id)',
            'type' => 'image',
            'htmlOptions' => array('class' => 'avatar'),
        ),
        array(
            'class' => 'application.extensions.yiibooster.widgets.TbButtonColumn',
            'template'=>'{update}{delete}'
        )),
));
?>

