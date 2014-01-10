<?php $id = $project['id'] ?>
<!-- Example row of columns -->
<div class="row">
    <div class="span6">
        <h2><?php echo $project['full_name']; ?></h2>
        <p><strong>Description: </strong><?php echo $project['description']; ?></p>
        <p><strong>Wathers: </strong><?php echo $project['watchers']; ?></p>
        <p><strong>Forks: </strong><?php echo $project['forks']; ?></p>
        <p><strong>open issues: </strong><?php echo $project['open_issues_count']; ?></p>
        <p><strong>homepage: </strong><?php echo $project['homepage']; ?></p>
        <p><strong>GitHub repo: </strong><?php echo $project['git_url']; ?></p>
        <p><strong>created_at: </strong><?php echo $project['created_at']; ?></p>
    </div>
    <div class="span6">
        <h2>Contributers:</h2>
        <div class="row">
            <?php if ($contributors != false): ?>
                <?php foreach ($contributors as $contributor): ?>
                    <div class="row margin-bootom">
                        <?php $id = $contributor['id'] ?>
                        <div class='span2'><?php echo CHtml::link($contributor['login'], $this->createUrl('user/view', array('name' => $contributor['login']))); ?></div>
                        <div class='span4'>
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
</div>




