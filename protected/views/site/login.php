<div id="simple_header">
    <div class="gradient">
        <div class="header">
            <h1>Login</h1>
        </div>
    </div>
</div>
<!-- Begin Content -->

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
            ));
            ?>

            <p>
                <?php echo $form->labelEx($model, 'username'); ?>
<?php echo $form->textField($model, 'username'); ?>
<?php echo $form->error($model, 'username'); ?>
            </p>

            <p>
                <?php echo $form->labelEx($model, 'password'); ?>
<?php echo $form->passwordField($model, 'password'); ?>
<?php echo $form->error($model, 'password'); ?>
            </p>

            <div class="row_form">
            <?php echo CHtml::submitButton('Login',array('class' => 'btn btn-default')); ?>
            </div>

<?php $this->endWidget(); ?>
        </div>
    </div>
    <div class="clear"></div>
</div>


