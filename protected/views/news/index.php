<?php
$this->pageTitle = "Новости";

$this->breadcrumbs = array(
    'Новости',
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
            <div class="title">Новости</div>
        </div>
    </div>
    <img src="<?php echo $current_contest->inner_image; ?>" alt="" />
</div>

<section>
    <div id="wrapper" class="WrappToMain innerP">
        <div class="InnerWrappToMain news">
            <div class="navToConent">
                <?php $this->widget('NewsNavigator'); ?>
            </div>
            <div class="breadcrumb">
                <?php $this->widget('zii.widgets.CBreadcrumbs', array(
                    'links' => $this->breadcrumbs,
                )); ?><!-- breadcrumbs -->
            </div>
            <section>

<?php

$news_items = $dataProvider->getData();
if(!count($news_items)) {
?>

                <article>
                    <strong>Нет опубликованных новостей</strong>
                    <div class="clr"></div>
                </article>


<?php
    } else {

        foreach($news_items as $news_item) :
?>

                <article>
                    <figure>
                        <div class="imgWrapp">
                            <a href="<?php echo Yii::app()->createUrl('news/view', array('id' => $news_item->id)); ?>" title="В 3-й класс!">
                                <img src="<?php echo $news_item->teaser_image; ?>" alt="">
                            </a>
                        </div>
                    </figure>
                    <div class="articleWrapp">
                        <header>
                            <hgroup>
                                <h3><a href="<?php echo Yii::app()->createUrl('news/view', array('id' => $news_item->id)); ?>" title="<?php echo $news_item->title; ?>"><?php echo $news_item->title; ?></a></h3>
                                <h4><?php echo strftime("%e %m %Y", strtotime($news_item->created)); ?></h4>
                            </hgroup>
                        </header>
                        <div class="articleText">
                            <?php echo $news_item->teaser_text; ?>
                        </div>
                    </div>
                    <div class="clr"></div>
                </article>

<?php
        endforeach;
    }
?>
            </section>
        </div>
    </div>
</section>