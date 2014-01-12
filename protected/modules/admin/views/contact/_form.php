<?php
/* @var $this ContactController */
/* @var $model ContactModel */
/* @var $form CActiveForm */
?>

<div class="well well-lg">
<?php
$form = $this->beginWidget('application.extensions.yiibooster.widgets.TbActiveForm', array(
    'id' => 'horizontalForm',
    'type' => 'horizontal',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation' => false,
        ));
?>
<fieldset>
    <?php echo $form->errorSummary($model); ?>

    <div class="control-group ">
        <?php echo $form->textFieldRow($model, 'name', array('size' => 30, 'maxlength' => 30)); ?>
    </div>

    <div class="control-group ">
        <?php echo $form->textFieldRow($model, 'email', array('size' => 50, 'maxlength' => 50)); ?>
    </div>

    <div class="control-group ">
        <?php echo $form->textFieldRow($model, 'subject', array('size' => 50, 'maxlength' => 50)); ?>
    </div>

    <div class="control-group ">
        <?php echo $form->textAreaRow($model, 'message', array('size' => 60, 'maxlength' => 280)); ?>
    </div>

    <div class="control-group ">
        <?php
        echo $form->datepickerRow($model, 'dateSend', array('options' => array('format' => 'yyyy-mm-dd ' . date("H:i:s"))));
        ?>
    </div>
</fieldset>
<div class="form-actions">
    <?php
    $this->widget(
            'application.extensions.yiibooster.widgets.TbButton', array(
        'buttonType' => 'submit',
        'type' => 'primary',
        'label' => 'Submit'
            )
    );
    ?>
</div>
<?php $this->endWidget(); ?>
</div>