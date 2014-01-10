<script>
$(function(){
    $(".alert").delay(3000).fadeOut("slow");
})
</script>
<?php
/* @var $this SiteController */
$this->pageTitle = Yii::app()->name;
?>
<?php if (Yii::app()->user->hasFlash('like')): ?>
    <div class="alert in alert-block fade alert-info">
        <?php echo Yii::app()->user->getFlash('like'); ?>
    </div>
<?php endif; ?>
<!-- Example row of columns -->
<div class="row">
    <div class="span6">
        <h2><?php echo $repository['full_name']; ?></h2>
        <p><strong>Description: </strong><?php echo $repository['description']; ?></p>
        <p><strong>Wathers: </strong><?php echo $repository['watchers']; ?></p>
        <p><strong>Forks: </strong><?php echo $repository['forks']; ?></p>
        <p><strong>open issues: </strong><?php echo $repository['open_issues_count']; ?></p>
        <p><strong>homepage: </strong><?php echo $repository['homepage']; ?></p>
        <p><strong>GitHub repo: </strong><?php echo $repository['git_url']; ?></p>
        <p><strong>created_at: </strong><?php echo $repository['created_at']; ?></p>
    </div>
    <div class="span6">
        <h2>Contributers:</h2>
        <div class="row">
            <?php if ($contributors != false): ?>
                <?php foreach ($contributors as $contributor): ?>
                    <div class="row margin-bootom">
                        <?php $id = $contributor['id'];
                              $name = $contributor['login'];
                        ?>
                        <div class='span1'><?php echo CHtml::link($contributor['login'], $this->createUrl('user/view', array('name' => $contributor['login']))); ?></div>
                        <div class='span5'>
                            <?php if (LikesModel::checkUserLike($contributor['id'])): ?>
                                <?php echo CHtml::link('Like', array("user/addlike/id/$id"), array('class' => 'btn')); ?>
                            <?php else: ?>
                                <?php echo CHtml::link('UnLike', array("user/unlike/id/$id"), array('class' => 'btn')); ?>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>