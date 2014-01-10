<?php
/* @var $this HometipController */
/* @var $data HomeTipModel */
?>
<?php $id = $data['id'];?>
<div class="well">
    <div><strong>Name: </strong><?php echo CHtml::link($data['name'], Yii::app()->createUrl("site/viewProject",array('owner' =>$data['owner']['login'],'repos' =>$data['name']))); ?></div>
    <div><strong>Owner: </strong><?php echo CHtml::link($data['owner']['login'],$this->createUrl('user/view', array('name' => $data['owner']['login']))) ?></div>
    <div><strong>Homepage: </strong><?php echo CHtml::link($data['homepage'], $data['homepage']); ?></div>
    <div><strong>Watchers: </strong><?php echo $data['watchers']; ?></div>
    <div><strong>Description: </strong><?php echo $data['description']; ?></div>
    <div><strong>Forks: </strong><?php echo $data['forks']; ?></div>
    <?php if (LikesModel::checkUserLike($data['id'])): ?>
            <?php echo CHtml::link('Like', array("user/addlike/id/$id"), array('class' => 'btn')); ?>
        <?php else: ?>
            <?php echo CHtml::link('UnLike', array("user/unlike/id/$id"), array('class' => 'btn')); ?>
        <?php endif; ?>
</div>

