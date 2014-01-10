<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>
<?php Yii::app()->getComponent("bootstrap");  ?>
<div class="container" id="page">
            <?php 
            $this->widget(
            'application.extensions.yiibooster.widgets.TbNavbar', array(
            'brand' => 'Git Project - Admin Panel',
            'brandUrl' => $this->createUrl('block/admin'),
            'fixed' => true,
            'items' => array(
            array(
                'class' => 'application.extensions.yiibooster.widgets.TbMenu',
                'items' => array(
                    array('label' => 'Contact', 'url' => array('contact/admin')),
                    array('label' => 'Users', 'url' => array('user/admin')),
                    array('label' => 'Manage Static Page', 'url' => array('page/admin')),
                    array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
                    array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
                )
            )
        )
            )
    );
        ?>
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
		
	</div><!-- footer -->

</div><!-- page -->
<script type="text/javascript">
               $(function() {
                $(".nav").each(function(){
                    var currentUrl = "'<?php echo Yii::app()->getRequest()->getUrl(); ?>'";
                    $('a[href='+currentUrl+']').parent().addClass('active');
                })
            });
        </script>
</body>
</html>
