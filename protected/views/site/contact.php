<?php Yii::app()->clientScript->registerScript(
   'myHideEffect',
   '$(".alert-success").animate({opacity: 1.0}, 3000).fadeOut("slow");',
   CClientScript::POS_READY
); ?>
<div class="content spr">
    <div class="cont">
        <?php if(Yii::app()->user->hasFlash('success')): ?>
            <div class="alert alert-success"> <?php echo Yii::app()->user->getFlash('success');  ?></div> 
                <?php endif; ?>        
        <h2>Send Us a Message</h2>
        <div class="contact_form">

           <?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'commentform',
	'enableAjaxValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>
	<p>
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name'); ?>
		<?php echo $form->error($model,'name'); ?>
	</p>

	<p>
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email'); ?>
		<?php echo $form->error($model,'email'); ?>
	</p>

	<p>
		<?php echo $form->labelEx($model,'subject'); ?>
		<?php echo $form->textField($model,'subject'); ?>
		<?php echo $form->error($model,'subject'); ?>
	</p>

	<p>
		<?php echo $form->labelEx($model,'message'); ?>
		<?php echo $form->textArea($model,'message',array('cols'=>25,'rows' => 5)); ?>
		<?php echo $form->error($model,'message'); ?>
	</p>



	<div class="row_form">
		<?php echo CHtml::submitButton('Submit',array('class' => 'btn btn-default')); ?>
	</div>

<?php $this->endWidget(); ?>

        </div>
    </div>
    <div class="clear"></div>
</div>

