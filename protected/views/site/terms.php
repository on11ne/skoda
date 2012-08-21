<?php

$current_contest = Contests::model()->find(array(
    "select" => "id, title, description, inner_image, conditions",
    "condition" => "status=2", // active, not archived
    "limit" => 1
));

if($current_contest == null)
    throw new CHttpException(404, 'Нет активных акций');

$this->pageTitle = "Условия участия в акции &laquo;" . $current_contest->title . "&raquo;";

$this->breadcrumbs = array(
    "Условия участия в акции &laquo;" . $current_contest->title . "&raquo;"
);

Yii::app()->clientScript->registerCssFile("/assets/css/content.css");

?>

<div class="wrappToMSlidder">
    <div class="descWrappMain descWrappMain_innerP">
        <div class="descWrapp">
            <div class="title">Условия участия</div>
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
                <article>
                    <?php echo $current_contest->description; ?>
                    <?php echo $current_contest->conditions; ?>
                </article>
            </section>
            <aside>
                &nbsp;
            </aside>
            <div class="clr"></div>
        </div>
    </div>
</section>