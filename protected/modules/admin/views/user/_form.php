<?php
/* @var $this UserController */
/* @var $model UserModel */
/* @var $form CActiveForm */
?>
<script>
$(function(){
    var avatarImage = $("#afterUploadPreview").attr("src");
    if(avatarImage != "") {
        $("#afterUploadPreview").addClass("thumbnail");
    }
})
</script>

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
            <?php echo $form->textFieldRow($model, 'firstName', array('size' => 60, 'maxlength' => 100)); ?>
        </div>

        <div class="control-group ">
            <?php echo $form->textFieldRow($model, 'lastName', array('size' => 60, 'maxlength' => 100)); ?>
        </div>

        <div class="control-group ">
            <?php echo $form->textFieldRow($model, 'email', array('size' => 60, 'maxlength' => 100)); ?>
        </div>

        <div class="control-group ">
            <?php echo $form->dropDownListRow($model, 'type', array('user' => 'User', 'admin' => 'Admin')); ?>
        </div>

        <div class="control-group ">
            <?php echo $form->labelEx($model, 'avatar',array('class' => 'control-label')); ?>
            <div class="controls">
            <div class="pi-row avatar-row">
                <?php echo $form->hiddenField($model, 'avatar'); ?>
                <img id="afterUploadPreview" src="<?php echo $model->getFileSrc('avatar') ?>" width="212">
            </div>
                </div>
            <div class="controls">
            <?php
            $this->widget('ext.cocoCod.CocoCodWidget'
                    , array(
                'id' => 'cocowidget1',
                'onCompleted' => 'function(id,filename,jsoninfo){ $("#UserModel_avatar").val(filename); $("#afterUploadPreview").attr("src",jsoninfo.uploadUrl);$("#afterUploadPreview").addClass("thumbnail");}',
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
                </div>
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

</div><!-- form -->