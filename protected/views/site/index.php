<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;

$current_contest = Contests::model()->find(array(
    "select" => "id, title, description, index_image",
    "condition" => "status=2", // active, not archived
    "limit" => 1
));

if($current_contest == null)
    throw new CHttpException(404, 'Нет активных акций');

$contest_items = ContestItems::model()->with(array('images', 'votes_count'))->published()->current()->findAll(array(
    "limit" => 10
));

Yii::app()->clientScript->registerPackage('bxslider');
Yii::app()->clientScript->registerCssFile('/assets/css/auth.css');
Yii::app()->clientScript->registerScript('load_bxslider', "
$('.blockToSlider').bxSlider({
    nextText: '',
    prevText: '',
    prevImage: '/assets/images/butt_prev.png',
    nextImage: '/assets/images/butt_next.png'
});
$('img.vote_control').hover(function(){
    $(this).animate({opacity: 0.5}, function() {
        $('img.vote_control').animate({opacity: 1});
    });
});
", CClientScript::POS_READY);

?>

<div class="wrappToMSlidder">
    <div class="descWrappMain" style="left: 572px; top: 52px;">
        <div class="descWrapp">
            <div class="title"><?php echo $current_contest->title; ?></div>
            <div class="desc"><?php echo $current_contest->description; ?></div>
            <div class="addPhotoButt"><img src="/assets/images/icons/addPhoto.png" alt="Добавить фото" /><a href="<?php echo Yii::app()->createUrl('contestitems/add'); ?>" title="Добавить работу">Добавить работу</a></div>
        </div>
        <div class="descWrappBg">&nbsp;</div>
    </div>
    <img src="<?php echo $current_contest->index_image; ?>" alt="" />
</div>
<div id="wrapper" class="WrappToMain">
    <div class="InnerWrappToMain">
        <div class="blockToSlider">


                <?php if(!count($contest_items)) { ?>

            <div class="items">
                <div class="item">
                    <p>Конкурсные работы не найдены</p>
                </div>
            </div>

                <?php } else { ?>

                <?php
                    $counter = 1;
                    foreach($contest_items as $contest_item) :
                        $image = $contest_item->images[0];
                ?>

                <?php if($counter == 1) : ?>

            <div class="items">

                <?php endif; ?>

                <div class="item">
                    <div class="imgWrapp">
                        <a href="">
                            <img src="<?php echo $image->thumb_path; ?>" alt="<?php echo $contest_item->title; ?>" />
                            <div class="raiting"><img src="/assets/images/icons/rating.png" alt="" />

                            </div>
                            <div class="likes">
                                <img
                                    <?php
                                        if(!Yii::app()->user->isGuest) :
                                    ?>
                                    class="fancybox fancybox.ajax vote_control" href="<?php echo Yii::app()->createUrl('votes/voteForm', array('contest_item_id' => $contest_item->id)); ?>"
                                    <?php endif; ?>

                                    src="/assets/images/icons/likes.png" alt=""/>
                            <?php echo $contest_item->votes_count; ?></div>
                        </a>
                    </div>
                    <div class="desc">

                        <div class="link" style="width: 70%;"><img src="/assets/images/icons/greenArrow.jpg" alt="" /><a href="javascript:void(0);" title="<?php echo $contest_item->title; ?>"><?php echo $contest_item->title; ?></a></div>
                        <div class="name" style="width: 30%;"><?php echo $contest_item->user->surname . " " . mb_substr($contest_item->user->first_name, 0, 1, "utf-8") . "."; ?></div>
                    </div>
                </div>

                <?php if($counter%2 == 0 && $counter != count($contest_items)) : ?>

            </div>
            <div class="items">

                <?php endif; ?>

                <?php if($counter == count($contest_items)) : ?>
            </div>

                <?php endif; ?>

                <?php
                    $counter++;
                    endforeach;
                ?>

                <?php } ?>

        </div>
        <div class="bgToNews">&nbsp;</div>
        <div class="blockToNews">
            <div class="title">Новости</div>
            <div class="item">
                <div class="title"><a href="javascript:void(0);" title="Запуск конкурса “Рецепты”">Запуск конкурса “Рецепты”</a>
                    <span class="desc">Новый увлекательный конкурс</span></div>
            </div>
            <div class="item">
                <div class="title"><a href="javascript:void(0);" title="Победители конкурса “Авто блиц”">Победители конкурса “Авто блиц”</a>
                    <span class="desc">определены лучшие знатоки модельного ряда Skoda</span></div>
            </div>
            <div class="allNewsLink"><img src="/assets/images/icons/greenArrow.jpg" alt="Все новости" /><a href="javascript:void(0);" title="Все новости">Все новости</a></div>
        </div>
        <div class="clr"></div>
    </div>
</div>