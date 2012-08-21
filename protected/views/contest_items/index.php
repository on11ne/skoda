<?php
$this->pageTitle = "Голосование";

$this->breadcrumbs = array(
    'Голосование',
);

$current_contest = Contests::model()->find(array(
    "select" => "id, title, description, inner_image",
    "condition" => "status=2", // active, not archived
    "limit" => 1
));

if($current_contest == null)
    throw new CHttpException(404, 'Нет активных акций');

Yii::app()->clientScript->registerCssFile("/assets/css/content.css");
Yii::app()->clientScript->registerCssFile('/assets/css/auth.css');
Yii::app()->clientScript->registerCssFile("/assets/css/form.css");

Yii::app()->clientScript->registerScript('load_vote_control', "
$('img.vote_control').hover(function(){
    $(this).animate({opacity: 0.5}, function() {
        $('img.vote_control').animate({opacity: 1});
    });
});
", CClientScript::POS_READY);

?>

<div class="wrappToMSlidder">
    <div class="descWrappMain descWrappMain_innerP">
        <div class="descWrapp">
            <div class="title">Конкурсные работы</div>
        </div>
    </div>
    <img src="<?php echo $current_contest->inner_image; ?>" alt="" />
</div>
<section>
<div id="wrapper" class="WrappToMain innerP">
<div class="InnerWrappToMain">
<div class="breadcrumb">
    <?php $this->widget('zii.widgets.CBreadcrumbs', array(
        'links' => $this->breadcrumbs,
    )); ?><!-- breadcrumbs -->
</div>
<section>
<div class="sortToWorks">
    <div class="title">Сортировать конкурсные работы по:</div>

    <a
        <?php
        if(Yii::app()->request->getParam('order', 0) == 'votes_count') echo " style='background-color: #777' ";
        ?>
        class="blockSort1" href="<?php echo Yii::app()->createUrl("contestitems/index", array("order" => "votes_count")); ?>">
        Рейтингу
    </a>
    <a
        <?php
        if(Yii::app()->request->getParam('order', 0) == 'created') echo " style='background-color: #777' ";
        ?>
        class="blockSort2" href="<?php echo Yii::app()->createUrl("contestitems/index", array("order" => "created")); ?>">
        Дате публикации
    </a>
    <div class="clr"></div>
</div>

<?php if(!count($contest_items)) { ?>

<div class="wrappToTenders">
    <article class="item">
        <strong>Работы не найдены</strong>
    </article>
</div>

<?php } else { ?>

<?php
    $counter = 1;
    foreach($contest_items as $contest_item) :
        $image = $contest_item->images[0];
?>

<?php if($counter == 1) : ?>
<div class="wrappToTenders">
<?php endif; ?>

        <article class="item">
            <figure>
                <div class="imgWrapp">
                    <a href="<?php echo Yii::app()->createUrl("contestitems/view", array("id" => $contest_item->id)); ?>" title="В 3-й класс!">
                        <img src="<?php echo $image->thumb_path; ?>" alt="<?php echo $contest_item->title; ?>">
                        <div class="raiting"></div>
                        <div class="likes">
                            <img
                                <?php
                                if(!Yii::app()->user->isGuest) :
                                    ?>
                                    class="fancybox fancybox.ajax vote_control" href="<?php echo Yii::app()->createUrl('votes/voteForm', array('contest_item_id' => $contest_item->id)); ?>"
                                    <?php endif; ?>

                                    src="/assets/images/icons/likes.png" alt=""/>
                            <?php echo $contest_item->votes_count; ?>
                        </div>
                    </a>
                </div>
            </figure>
            <div class="articleWrapp">
                <header>
                    <hgroup>
                        <h3><?php echo $contest_item->title; ?></h3>
                        <h4><?php echo $contest_item->user->surname . " " . mb_substr($contest_item->user->first_name, 0, 1, "utf-8") . "."; ?></h4>
                    </hgroup>
                </header>
                <div class="articleText">
                    <?php echo mb_substr($contest_item->full_text, 0, 70, "utf-8") . "..."; ?>
                </div>
            </div>
        </article>

<?php if($counter%3 == 0 && $counter != count($contest_items)) : ?>
</div>
<div class="wrappToTenders">
<?php endif; ?>
<?php if($counter == count($contest_items)) : ?>
</div>
<?php endif; ?>

<?php
        $counter++;
    endforeach;
?>

<?php } ?>
<?php
    $this->widget('CLinkPager', array(
        'pages' => $pages,
    ));
?>
</section>
<aside>
    <div class="blockSearch">
        <div class="title">Поиск</div>
        <?php
        $model = new ContestItems();
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'search',
            'action' => Yii::app()->createUrl('contestitems/search'),
            'enableAjaxValidation' => false,
            'htmlOptions' => array(
                'class' => 'search',
                'method' => 'post',
                'onsubmit' => "if ($('#ContestItems_title').val()=='Название работы') $('#ContestItems_title').val('');"
            )
        )); ?>
            <div>
                <?php

                    $this->widget('CAutoComplete',
                    array(
                        //name of the html field that will be generated
                        'name' => 'username',
                        'value' => 'Имя конкурсанта',
                        //replace controller/action with real ids
                        'url'=> array('users/autoCompleteLookup'),
                        'max' => 10,

                        'minChars' => 2,
                        'delay' => 500, //number of milliseconds before lookup occurs
                        'matchCase' => false, //match case when performing a lookup?

                        //any additional html attributes that go inside of
                        //the input field can be defined here
                        'htmlOptions' => array(
                            'maxlength' => 20,
                            'onblur' => "if (this.value=='') this.value='Имя конкурсанта';",
                            'onfocus' => "if (this.value=='Имя конкурсанта') this.value='';"
                        ),

                        'methodChain'=>".result(function(event,item){\$(\"#ContestItems_user_id\").val(item[1]);})",
                    ));
                    echo $form->hiddenField($model, "user_id");
                ?>
            </div>
            <div>
                <?php
                    echo $form->textField($model, "title", array(
                        'value' => 'Название работы',
                        'maxlength' => 20,
                        'onblur' => "if (this.value=='') this.value='Название работы';",
                        'onfocus' => "if (this.value=='Название работы') this.value='';"
                    ));
                ?>
            </div>
            <div>
                Период размещения
            </div>
            <div>
                <?php

                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'name'=>'ContestItems[created_from]',
                    'model' => $model,
                    'language'=>'ru',
                    // additional javascript options for the date picker plugin
                    'options'=>array(
                        'showAnim' => 'fold',
                        'dateFormat' => 'yy-mm-dd',
                        'changeMonth' => 'true',
                        'showButtonPanel' => 'true',
                    ),
                    'htmlOptions' => array(
                        'maxlength' => 12,
                        'onblur' => "if (this.value=='') this.value='';",
                        'onfocus' => "if (this.value=='') this.value='';",
                        'style' => "width: 65px;"
                    ),
                ));
                ?>
                 до
                <?php

                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'name'=>'ContestItems[created_to]',
                    'model' => $model,
                    'language'=>'ru',
                    // additional javascript options for the date picker plugin
                    'options'=>array(
                        'showAnim' => 'fold',
                        'dateFormat' => 'yy-mm-dd',
                        'changeMonth' => 'true',
                        'showButtonPanel' => 'true',
                    ),
                    'htmlOptions' => array(
                        'maxlength' => 12,
                        'onblur' => "if (this.value=='') this.value='';",
                        'onfocus' => "if (this.value=='') this.value='';",
                        'style' => "width: 65px;"
                    ),
                ));
                ?>
            </div>
            <div>
                <input name="submit" maxlength="20" type="submit" value="Искать работы" />
            </div>
        <?php $this->endWidget(); ?>
    </div>
</aside>
<div class="clr"></div>
</div>
</div>
</section>