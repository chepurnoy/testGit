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
            <?php
            $this->widget(
                    'application.extensions.yiibooster.widgets.TbNavbar', array(
                'brand' => 'Git Project',
                'brandUrl' => Yii::app()->homeUrl,
                'fixed' => 'top',
                'items' => array(
                    array(
                        'class' => 'application.extensions.yiibooster.widgets.TbMenu',
                        'items' => PageModel::generateMenu(array(
                                        array('label' => 'Contact', 'url' => array('site/contact')),
                                        array('label' => 'Registration', 'url' => array('/site/register'), 'visible' => Yii::app()->user->isGuest),
                                        array('label' => 'Login', 'url' => array('/site/login'), 'visible' => Yii::app()->user->isGuest),
                                        array('label' => 'Admin Panel', 'url' => Yii::app()->createUrl('/admin'), 'linkOptions' => array('target' => '_blank'), 'visible' => Yii::app()->user->getType() == 'admin'),
                                        array('label' => 'Logout (' . Yii::app()->user->name . ')', 'url' => array('/site/logout'), 'visible' => !Yii::app()->user->isGuest)
                        ))
                    )
                )
                    )
            );
            ?>
            <?php if (isset($this->breadcrumbs)): ?>
                <?php
                $this->widget('zii.widgets.CBreadcrumbs', array(
                    'links' => $this->breadcrumbs,
                ));
                ?><!-- breadcrumbs -->
            <?php endif ?>
            <!-- Main hero unit for a primary marketing message or call to action -->
            <div class='pull-right search'>
                <?php $this->widget('application.widgets.SearchWidget'); ?>
            </div>
            <div class="hero-unit my-hero-custom">

                <h1><?php echo CHtml::link("MobiDev GitHub Browser", Yii::app()->homeUrl); ?> >> <?php echo $this->pageTitle; ?></h1>
            </div>
        </header>
        <?php echo $content; ?>
    </div>
</body>
</html>
<script type="text/javascript">
    $(function() {
        $(".nav").each(function() {
            var currentUrl = "'<?php echo Yii::app()->getRequest()->getUrl(); ?>'";
            $('a[href=' + currentUrl + ']').parent().addClass('active');
        })
    });
</script>