<?php $id = $user['id'] ?>
<div class="row">
    <div class="span2">
        <?php echo CHtml::image($user['avatar_url'], $alt = '', array('class' => 'thumbnail image-150')); ?>
        <div class="clearfix"></div>
        <?php if (LikesModel::checkUserLike($user['id'])): ?>
            <?php echo CHtml::link('Like', array("user/addlike/id/$id"), array('class' => 'btn')); ?>
        <?php else: ?>
            <?php echo CHtml::link('UnLike', array("user/unlike/id/$id"), array('class' => 'btn')); ?>
        <?php endif; ?>
    </div>
    <div class="span10">
        <h2><?php echo $user['name']; ?></h2>
        <p><?php echo $user['login']; ?></p>
        <p><strong>Company: </strong><?php echo $user['company']; ?></p>
        <p><strong>Followers: </strong><?php echo $user['followers']; ?></p>
        <p><strong>Blog: </strong><?php echo CHtml::link($user['blog'],$user['blog']); ?></p>
    </div>
</div>




