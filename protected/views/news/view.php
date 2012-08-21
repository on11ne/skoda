<?php

if($news_item == null)
    throw new CHttpException(404, 'Новость не найдена');

$this->pageTitle = $news_item->title . " | Новости";

$this->breadcrumbs = array(
    'Новости' => array('news/index'),
    $news_item->title
);

$current_contest = Contests::model()->find(array(
    "select" => "id, title, description, inner_image",
    "condition" => "status=2", // active, not archived
    "limit" => 1
));

if($current_contest == null)
    throw new CHttpException(404, 'Нет активных акций');

Yii::app()->clientScript->registerCssFile("/assets/css/content.css");

?>

<div class="wrappToMSlidder">
    <div class="descWrappMain descWrappMain_innerP">
        <div class="descWrapp">
            <div class="title"><?php echo $news_item->title; ?></div>
        </div>
    </div>
    <img src="<?php echo $current_contest->inner_image; ?>" alt="" />
</div>
<section>
    <div id="wrapper" class="WrappToMain innerP">
        <div class="InnerWrappToMain news">
            <div class="navToConent">
                <ul>
                    <li class="active"><a href="javascript:void(0);" title="<?php echo $news_item->title; ?>"><?php echo $news_item->title; ?></a></li>
                </ul>
            </div>
            <div class="breadcrumb">
                <?php $this->widget('zii.widgets.CBreadcrumbs', array(
                    'links' => $this->breadcrumbs,
                )); ?><!-- breadcrumbs -->
            </div>
            <section>
                <article class="innerNews">
                    <figure>
                        <div class="imgWrapp">
                            <a href="javascript:void(0);" title="<?php echo $news_item->title; ?>">
                                <img src="<?php echo $news_item->teaser_image; ?>" alt="<?php echo $news_item->title; ?>">
                            </a>
                        </div>
                    </figure>
                    <div class="articleWrapp">
                        <header>
                            <hgroup>
                                <h3><?php echo $news_item->title; ?></h3>
                                <h4><?php echo strftime("%e %m %Y", strtotime($news_item->created)); ?></h4>
                            </hgroup>
                        </header>
                        <div class="articleText">
                            <p class="preText">
                                <?php echo $news_item->teaser_text; ?>
                            </p>
                            <p class="fullText">
                                <?php echo $news_item->full_text; ?>
                            </p>
                        </div>
                        <div class="allNewsLink"><img src="/assets/images/icons/greenArrow.jpg" alt="Все новости"><a href="<?php Yii::app()->createUrl('news/index'); ?>" title="Все новости">Все новости</a></div>
                    </div>
                    <div class="clr"></div>
                </article>
            </section>
        </div>
    </div>
</section>