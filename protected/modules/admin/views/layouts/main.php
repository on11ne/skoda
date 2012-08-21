<?php
$cs=Yii::app()->clientScript;
$cs->coreScriptPosition=CClientScript::POS_HEAD;
$cs->scriptMap=array();
$baseUrl=$this->module->assetsUrl;
$cs->registerCoreScript('jquery');
$cs->registerScriptFile($baseUrl.'/js/jquery.tooltip-1.2.6.min.js');
$cs->registerScriptFile($baseUrl.'/js/fancybox/jquery.fancybox-1.3.1.pack.js');
$cs->registerCssFile($baseUrl.'/js/fancybox/jquery.fancybox-1.3.1.css');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="language" content="en" />

    <!-- blueprint CSS framework -->
    <link rel="stylesheet" type="text/css" href="<?php echo $this->module->assetsUrl; ?>/css/screen.css" media="screen, projection" />
    <link rel="stylesheet" type="text/css" href="<?php echo $this->module->assetsUrl; ?>/css/print.css" media="print" />
    <!--[if lt IE 8]>
    <link rel="stylesheet" type="text/css" href="<?php echo $this->module->assetsUrl; ?>/css/ie.css" media="screen, projection" />
    <![endif]-->

    <link rel="stylesheet" type="text/css" href="<?php echo $this->module->assetsUrl; ?>/css/main.css" />

    <title><?php echo CHtml::encode($this->pageTitle); ?></title>

    <script type="text/javascript" src="<?php echo $this->module->assetsUrl; ?>/js/main.js"></script>

    <style type="text/css">
        div.top-menus li {
            display: block;
            float: left;
            margin-left: 10px;
            background: none repeat scroll 0 0 #EFFDFF;
            text-align: center;
        }
    </style>

</head>

<body>

<div class="container" id="page">
    <div id="header">
        <div class="top-menus">

            <?php $this->widget('zii.widgets.CMenu',array(
                'items'=>array(
                    array('label'=>'Конкурсные работы', 'url'=>array('contestitems/index')),
                    array('label'=>'Новости', 'url'=>array('news/admin')),
                    array('label'=>'Города', 'url'=>array('cities/admin')),
                    array('label'=>'Голоса', 'url'=>array('votes/admin')),
                    array('label'=>'Пользователи', 'url'=>array('users/admin')),
                    array('label'=>'Выйти ('.Yii::app()->user->name.')', 'url'=>array('/gii/default/logout'))
                ),
            )); ?>

        </div>
        <div id="logo"><?php echo CHtml::link(CHtml::image($this->module->assetsUrl.'/images/logo.jpg'),array('/admin')); ?></div>
    </div><!-- header -->

    <?php echo $content; ?>

</div><!-- page -->

<div id="footer">
    &copy; 2012
    Сделано в <a href="http://www.e-produce.ru">eProduce</a>
</div><!-- footer -->

</body>
</html>