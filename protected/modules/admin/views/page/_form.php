<?php
/* @var $this PageController */
/* @var $model PageModel */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'page-model-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>
        
        <div class="row">
		<?php echo $form->labelEx($model,'link'); ?>
		<?php echo $form->textField($model,'link',array('size'=>75,'maxlength'=>75)); ?>
		<?php echo $form->error($model,'link'); ?>
	</div>

        <div class="row">
            <?php echo $form->labelEx($model, 'content'); ?>
            <?php
            $this->widget(
                    'application.extensions.yiibooster.widgets.TbRedactorJs', [
                'model' => $model,
                'attribute' => 'content',
                'value' => 'content',
                'editorOptions' => [
                    'plugins' => ['fontfamily']
                ]
                    ]
            );
            ?>
            <?php echo $form->error($model, 'content'); ?>
        </div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->