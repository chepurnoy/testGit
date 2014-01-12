<?php
/* @var $this ContactController */
/* @var $model ContactModel */

$this->breadcrumbs=array(
	'Contacts'=>array('admin'),
);
?>
<div class="well">
    <blockquote>
     <p>Update Message From <?php echo $model->name; ?></p>
    </blockquote>
</div>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>