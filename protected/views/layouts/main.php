<!doctype html>
<html lang="en" class="no-js">
    <head>
        <meta charset="utf-8">
        <!--[if IE]><![endif]-->
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <meta name="description" content="">
        <meta name="keywords" content="" />
        <link rel="shortcut icon" href="/favicon.ico">
        <link rel="apple-touch-icon" href="/apple-touch-icon.png">
    </head>
    <div class="container">
        <header>
            <?php if (isset($this->breadcrumbs)): ?>
                <?php
                $this->widget('zii.widgets.CBreadcrumbs', array(
                    'links' => $this->breadcrumbs,
                ));
                ?><!-- breadcrumbs -->
            <?php endif ?>
            <!-- Main hero unit for a primary marketing message or call to action -->
            <div class='pull-right search'>
                    <form class="form-search" action="<?php echo Yii::app()->createUrl('site/search'); ?>">
                        <div class="input-append">
                            <input type="text" name="title" class="span2 search-query">
                            <button type="submit" class="btn">Search</button>
                        </div>
                    </form>
                </div>
            <div class="hero-unit">

                <h1><?php echo CHtml::link("MobiDev GitHub Browser", Yii::app()->homeUrl); ?> >> <?php echo $this->pageTitle; ?></h1>
            </div>
            <?php echo $content; ?>
        </header>
        <footer>

        </footer>
    </div>
</body>
</html>
