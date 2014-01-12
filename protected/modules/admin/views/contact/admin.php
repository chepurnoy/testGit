<?php Yii::app()->getComponent("bootstrap"); ?>
<?php
/* @var $this ContactController */
/* @var $model ContactModel */

$this->breadcrumbs = array(
    'Manage',
);
?>
<div class="page-header">
<p><a class="btn btn-primary btn-lg" href="<?php echo Yii::app()->createUrl('admin/contact/create'); ?>" role="button">Create Contact</a></p>
</div>
<h1>Manage Contacts</h1>
<!-- search-form -->
<?php
$this->widget('application.extensions.yiibooster.widgets.TbExtendedGridView', array(
    'id' => 'contactGrid',
    'type' => 'striped bordered condensed',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'bulkActions' => array(
        'actionButtons' => array(
            array(
                'buttonType' => 'button',
                'type' => 'primary',
                'size' => 'small',
                'label' => 'Delete Contacts',
                'id' => 'deleteContacts',
            )
        ),
        'checkBoxColumnConfig' => array(
            'name' => 'id'
        )),
    'columns' => array(
        'name',
        'email',
        'subject',
        'message',
        'dateSend',
        array(
            'class' => 'application.extensions.yiibooster.widgets.TbButtonColumn',
            'template'=>'{update}{delete}'
        )),
));
?>
<script>
    $(function() {
        $("#deleteContacts").live("click",function() {
            
            var notChekedCheckbox = $("input:checkbox").first().attr("id");
            //Get all cheked checkbox
            var idCheckbox = $("input:checked:not('#"+notChekedCheckbox+"')").map(function() {
                return $(this).val();
            }).toArray();
            
            //Ajax request
            $.ajax({
                type: 'POST',
                dataType: 'json',
                success:function(){$("#contactGrid").yiiGridView("update", {}); },
                url: '/admin/contact/deleteAll',
                cache: false,
                data: {id:idCheckbox}
            });
        });
    });
</script>
