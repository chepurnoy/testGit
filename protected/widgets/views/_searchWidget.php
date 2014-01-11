<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'seacrhform',
    'action' => Yii::app()->createUrl('site/search'),
    'enableClientValidation' => true,
    'enableAjaxValidation' => true,
    'htmlOptions' => array('class' => 'form-search'),
    'clientOptions' => array(
        'validateOnSubmit' => true,
    )
        ));
?>
<?php echo $form->textField($model, 'title', array('placeholder' => 'Search', 'class' => 'form-control search')); ?>
<?php echo CHtml::submitButton('Search', array('class' => 'btn search-button')); ?>
<div class="clearfix"></div>
<?php 
echo $form->error($model, 'title');
$this->endWidget();