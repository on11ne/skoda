<?php
$this->pageTitle = "Добавить работу";

$this->breadcrumbs=array(
    'Добавить работу',
);

$current_contest = Contests::model()->find(array(
    "select" => "id, title, description, index_image",
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
            <div class="title">Добавить работу</div>
        </div>
    </div>
    <img src="<?php echo $current_contest->index_image; ?>" alt="" />
</div>
<section>
    <div id="wrapper" class="WrappToMain innerP">
        <div class="InnerWrappToMain">

            <div class="breadcrumb">
                <?php $this->widget('zii.widgets.CBreadcrumbs', array(
                    'links' => $this->breadcrumbs,
                )); ?><!-- breadcrumbs -->
                <!--<menu>
                    <li><a href="javascript:void(0);" title="Главная">Главная</a></li>
                    <li><img src="./images/separator.jpg" /></li>
                    <li><span>Добавить фото</span></li>
                </menu>-->
            </div>
            <section class="width585">
                <article>
                    <div class="desc">
                        Заголовок для статьи должен содержать не более 19 символов (включая пробелы).<br/>
                        Текст статьи должен содержать от 300 до 1500 символов (включая пробелы).<br/>
                        Допустимые форматы фотографий &mdash; jpeg или png и размером не более 3х мегабайт.</div>
                    <?php $form=$this->beginWidget('CActiveForm', array(
                        'id'=>'contest-items-add-form',
                        'enableAjaxValidation'=>false,
                        'htmlOptions' => array('enctype' => 'multipart/form-data')
                    )); ?>
                    <?php echo $form->errorSummary($model); ?>
                        <section>
                            <div>
                                <?php echo $form->labelEx($model,'title'); ?>
                                <?php echo $form->textField($model, 'title', array('class'=>'input')); ?>
                                <?php echo $form->error($model,'title'); ?>
                            </div>
                            <div>
                                <?php echo $form->labelEx($model,'full_text'); ?>
                                <?php echo $form->textArea($model,'full_text'); ?>
                                <?php echo $form->error($model,'full_text'); ?>
                            </div>
                        </section>
                        <aside>
                            <div class="clr"></div>
                            <?php
                                $this->widget('CMultiFileUpload', array(
                                    'model' => $model,
                                    'attribute' => 'images',
                                    'accept' => 'jpg|gif|png',
                                    'max' => '5',
                                    'options' => array(
                                        'onFileSelect'=>'function(e, v, m){ }',
                                        'afterFileSelect'=>'function(e, v, m){ }',
                                        'onFileAppend'=>'function(e, v, m){ }',
                                        'afterFileAppend'=>'function(e, v, m){ }',
                                        'onFileRemove'=>'function(e, v, m){  }',
                                        'afterFileRemove'=>'function(e, v, m){  }',
                                    ),
                                ));
                                Yii::app()->clientScript->registerScript('load_bxslider', "
    $('#ContestItems_images_wrap').prepend('Прикрепить файл');
    $('#ContestItems_images_wrap_list').detach().insertAfter('#ContestItems_images_wrap');",
                                CClientScript::POS_READY);
                            ?>
                            <?php echo $form->error($model, 'images'); ?>

                            <?php echo CHtml::submitButton('Отправить', array('id' => 'upload_button', 'class' => 'submit')); ?>
                            <!--<input id="upload_button" name="upload_button" value="Отправить фото" class="submit" />-->

                        </aside>
                        <div class="clr"></div>
                    <?php $this->endWidget(); ?>
                </article>
            </section>
            <aside>
                &nbsp;
            </aside>
            <div class="clr"></div>
        </div>
    </div>
</section>