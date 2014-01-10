<div class="content spr">
    <div class="cont">
        <div class="contact_form">
            <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'commentform',
                'enableAjaxValidation' => true,
                'clientOptions' => array(
                    'validateOnSubmit' => true,
                ),
                'htmlOptions' => array(
                    'enctype' => 'multipart/form-data',
                    'autocomplete' => 'off',
                )
            ));
            ?>
            <p>
                <?php echo $form->labelEx($model, 'firstName'); ?>
<?php echo $form->textField($model, 'firstName'); ?>
<?php echo $form->error($model, 'firstName'); ?>
            </p>

            <p>
                <?php echo $form->labelEx($model, 'lastName'); ?>
<?php echo $form->textField($model, 'lastName'); ?>
<?php echo $form->error($model, 'lastName'); ?>
            </p>

            <div class="pi-row avatar-row">
            <?php echo $form->hiddenField($model, 'avatar'); ?>
                <img id="afterUploadPreview" src="<?php echo $model->getFileSrc('avatar') ?>" width="222">
            </div>
            <?php echo $form->labelEx($model, 'Your Photo:'); ?>
            <?php
            $this->widget('ext.cocoCod.CocoCodWidget', array(
                'id' => 'cocowidget1',
                'onCompleted' => 'function(id,filename,jsoninfo){ $("#UserModel_avatar").val(filename); $("#afterUploadPreview").attr("src",jsoninfo.uploadUrl)}',
                'onCancelled' => 'function(id,filename){ alert("cancelled"); }',
                'onMessage' => 'function(m){ alert(m); }',
                'allowedExtensions' => array('jpeg', 'jpg', 'gif', 'png'), // server-side mime-type validated
                'sizeLimit' => 20000000, // limit in server-side and in client-side
                'uploadDir' => Yii::getPathOfAlias('webroot') . '/uploads/temp/', // coco will @mkdir it
                'uploadUrl' => Yii::app()->getBaseUrl(true) . '/uploads/temp/', // coco will @mkdir it
                'receptorClassName' => 'application.models.UserModel',
                'methodName' => 'onFileUploaded',
                'userdata' => array(),
                'maxUploads' => -1, // defaults to -1 (unlimited)
                'maxUploadsReachMessage' => 'No more files allowed', // if empty, no message is shown
                'multipleFileSelection' => true, // true or false, defaults: true
                'buttonText' => 'Upload photo',
                'dropFilesText' => 'Upload or Drop here',
                'htmlOptions' => array('style' => 'width: 300px;'),
                'defaultControllerName' => '/site',
            ));
            ?>
            <p>
                <?php echo $form->labelEx($model, 'email'); ?>
                <?php echo $form->textField($model, 'email'); ?>
<?php echo $form->error($model, 'email'); ?>
            </p>

            <p>
                <?php echo $form->labelEx($model, 'password'); ?>
                <?php echo $form->passwordField($model, 'password'); ?>
<?php echo $form->error($model, 'password'); ?>
            </p>


            <div class="row_form">
            <?php echo CHtml::submitButton('Submit'); ?>
            </div>
<?php $this->endWidget(); ?>
        </div>
    </div>
    <div class="clear"></div>
</div>