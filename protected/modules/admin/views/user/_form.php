<?php
/* @var $this UserController */
/* @var $model UserModel */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-model-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'firstName'); ?>
		<?php echo $form->textField($model,'firstName',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'firstName'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'lastName'); ?>
		<?php echo $form->textField($model,'lastName',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'lastName'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'type'); ?>
		<?php echo $form->dropDownList($model,'type',array('user'=>'User','admin'=>'Admin')); ?>
		<?php echo $form->error($model,'type'); ?>
	</div>

	<div class="row">
            
		<?php echo $form->labelEx($model,'avatar'); ?>
                  <div class="pi-row avatar-row">
                <?php echo $form->hiddenField($model, 'avatar'); ?>
                <img id="afterUploadPreview" src="<?php echo $model->getFileSrc('avatar') ?>" width="222">
            </div>
                <?php
                $this->widget('ext.cocoCod.CocoCodWidget'
                    , array(
                        'id' => 'cocowidget1',
                        'onCompleted' => 'function(id,filename,jsoninfo){ $("#UserModel_avatar").val(filename); $("#afterUploadPreview").attr("src",jsoninfo.uploadUrl)}',
                        'onCancelled' => 'function(id,filename){ alert("cancelled"); }',
                        'onMessage' => 'function(m){ alert(m); }',
                        'allowedExtensions' => array('jpeg', 'jpg', 'gif', 'png'), // server-side mime-type validated
                        'sizeLimit' => 100000000, // limit in server-side and in client-side
                        'uploadDir' => Yii::getPathOfAlias('webroot') . '/uploads/temp/', // coco will @mkdir it
                        'uploadUrl' => Yii::app()->getBaseUrl(true) . '/uploads/temp/', // coco will @mkdir it
// this arguments are used to send a notification
// on a specific class when a new file is uploaded,
                        'receptorClassName' => 'application.models.UserModel',
                        'methodName' => 'onFileUploaded',
                        'userdata' => array(),
                        // controls how many files must be uploaded
                        'maxUploads' => -1, // defaults to -1 (unlimited)
                        'maxUploadsReachMessage' => 'No more files allowed', // if empty, no message is shown
// controls how many files the can select (not upload, for uploads see also: maxUploads)
                        'multipleFileSelection' => true, // true or false, defaults: true
                        'buttonText' => 'Upload photo',
                        'dropFilesText' => 'Upload or Drop here',
                        'htmlOptions' => array('style' => 'width: 300px;'),
                        'defaultControllerName' => 'admin/user',
                        //'defaultActionName' => 'coco',
                    ));
                ?>
            <p>
		<?php echo $form->error($model,'avatar'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->