<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    <?php
        Yii::app()->clientScript->registerCoreScript('jquery');
        Yii::app()->clientScript->registerPackage('fancybox');
        Yii::app()->clientScript->registerScriptFile('/assets/js/flash-messages.js', CClientScript::POS_BEGIN);
    ?>
    <link rel="shortcut icon" type="image/x-icon" href="/assets/images/skoda_favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0" />
    <meta name="keywords" content="Шкода, Skoda, Октавия, Octavia, Фабия, Fabia, СуперБ, SuperB, Yeti, Roomster, New Octavia, Новая, дилеры, " />
    <meta name="description" content="Информация о деятельности компании, История, технологии. Описание модельного ряда, характеристики, Фотогалерея, Цены. Официальные дилеры в России. " />
    <meta name="generator" content="eProduce" />
    <link rel="stylesheet" href="/assets/css/styles.css" type="text/css" media="screen, projection" />
    <link rel="stylesheet" href="/assets/css/messages.css" type="text/css" media="screen, projection" />
    <!--[if IE]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->

</head>
<body>
<?php

$flashMessages = Yii::app()->user->getFlashes();

if ($flashMessages)
    foreach($flashMessages as $key => $message)
        echo '<div class="' . $key . '" style="display:none;">' . $message . "</div>\n";

?>
<header id="header">
    <div id="wrapper">
        <div class="leftPart"><img src="/assets/images/claim.gif" alt="Логотип" /></div>
        <div class="rightPart">
            <a href="/" title="Перейти на главную">
                <img src="/assets/images/logo.jpg" alt="Skoda" />
            </a>
        </div>
        <div class="clr"></div>
    </div>
</header><!-- #header-->
<div class="clr"></div>
<div class="headNav">
    <div id="wrapper">
        <div class="navGray">

            <?php
            $this->widget('application.components.SkodaMenu', array(
                'activateItemsOuter'=>false,
                'separator'=>'<span> | </span>',
                'linkLabelWrapper' => null,
                'activateItems' => true,
                'id' => '',
                'items' => array(
                    array('label' => 'О программе', 'url' => array('site/about')),
                    array('label' => 'Новости', 'url' => array('news/index')),
                    array('label' => 'Победители', 'url' => array('site/winners')),
                    array('label' => 'Архив конкурсов', 'url' => array('contests/index', 'status' => 1)),
                ),
            ));
            ?>
        </div>
        <div class="loginBlock">

            <?php
                if(Yii::app()->user->isGuest) :
            ?>
                <menu>
                    <li> <img src="/assets/images/icons/key.jpg" alt="Вход" /> <a href="<?php echo Yii::app()->createUrl('site/login'); ?>" title="Вход"><span>Вход</span></a><span> | </span></li>
                    <li><a href="<?php echo Yii::app()->createUrl('site/register'); ?>" title="Регистрация"><span>Регистрация</span></a></li>
                </menu>
            <?php
                else :
            ?>
                    <menu>
                        <li><img src="/assets/images/icons/key.jpg" alt="Вход" /> <?php echo Yii::app()->user->surname . " " . Yii::app()->user->first_name; ?> | </span></li>
                        <li><a href="<?php echo Yii::app()->createUrl('site/logout'); ?>" title="Выход"><span>Выход</span></a></li>
                    </menu>
            <?php
                endif;
            ?>


        </div>
        <div class="clr"></div>
        <div class="navGreen">

            <?php
            $this->widget('application.components.SkodaMenu', array(
                'activateItemsOuter'=>false,
                'itemTemplate' => '<div>{menu}</div>',
                'activateItems' => true,
                'id' => '',
                'items' => array(
                    array('label' => 'Голосование', 'url' => array('contestitems/index'), 'visible' => !Yii::app()->user->isGuest),
                    array('label' => 'Призы', 'url' => array('site/prizes')),
                    array('label' => 'Добавить работу', 'url' => array('contestitems/add'), 'visible' => !Yii::app()->user->isGuest),
                    array('label' => 'Условия', 'url' => array('contests/rules'), 'visible' => !Yii::app()->user->isGuest),
                ),
            ));
            ?>

            <!--<nav>
                <div><a href="javascript:void(0);" title="Голосование">Голосование</a></div>
                <div><a href="javascript:void(0);" title="Призы">Призы</a></div>
                <div><a href="javascript:void(0);" title="Рейтинг">Рейтинг</a></div>
                <div><a href="javascript:void(0);" title="Добавить фото"><img src="/assets/images/icons/star.png" alt="Добавить фото" /> Добавить фото</a></div>
                <div><a href="javascript:void(0);" title="Условия">Условия</a></div>
            </nav>-->
        </div>
    </div>
</div>

<?php echo $content; ?>

<footer id="footer">
    <div id="wrapper">
        <div class="leftPart">
            <div><a href="http://www.skoda-auto.ru" title="www.skoda-auto.ru">www.skoda-auto.ru</a></div>
            <div>© ŠKODA AUTO a.s. 2012</div>
        </div>
        <div class="middPart">
            <nav>
                <a href="javascript:void(0);" title="Обратная связь"> Обратная связь</a> <span> | </span>
                <a href="http://www.skoda-avto.ru/pub.html?docid=7132" title="Правовые аспекты">Правовые аспекты</a>
            </nav>
        </div>
        <div class="rightpart">
            <div class="wrapp">
                <div> Присоединяйся:</div>
                <div>
                    <a href="https://www.facebook.com/skodarussia" title="Facebook"><img src="/assets/images/icons/facebook.png" alt="Facebook" /></a>
                    <a href="http://vkontakte.ru/skodarussia" title="Вконтакте"><img src="/assets/images/icons/vk.png" alt="Вконтакте" /></a>
                    <a href="http://twitter.com/skodarussia" title="Twitter"><img src="/assets/images/icons/twitter.png" alt="Twitter" /></a>
                    <a href="http://www.youtube.com/skodarussia" title="YouTube"><img src="/assets/images/icons/youtube.png" alt="YouTube" /></a>
                </div>
            </div>
            <div class="clr"></div>
            <div class="wrapp">
                <div> Поделиться:</div>
                <div>
                    <a href="javascript:void(0);" title="Вконтакте"><img src="/assets/images/icons/vk_g.png" alt="Вконтакте" /></a>
                    <a href="javascript:void(0);" title="Facebook"><img src="/assets/images/icons/facebook_g.png" alt="Facebook" /></a>
                    <a href="javascript:void(0);" title="Twitter"><img src="/assets/images/icons/twitter_g.png" alt="Twitter" /></a>
                    <a href="javascript:void(0);" title="Добавить в закладки"><img src="/assets/images/icons/fav_g.png" alt="Добавить в закладки" /></a>
                    <a href="javascript:void(0);" title=""><img src="/assets/images/icons/plus_g.png" alt="" /></a>
                </div>
            </div>
        </div>
</footer><!-- #footer -->
</div>
</body>
</html>