<?php
$this->pageTitle = "Авторизация";

$this->breadcrumbs=array(
    'Авторизация',
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
            <div class="title">Авторизация</div>
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
                    <?php $form=$this->beginWidget('CActiveForm', array(
                        'id'=>'login-form',
                        'enableClientValidation'=>true,
                        'htmlOptions' => array('class' => 'login'),
                        'clientOptions'=>array(
                            'validateOnSubmit'=>true,
                        ),
                    )); ?>
                        <div class="email">
                            <?php echo $form->labelEx($model,'username'); ?>
                            <?php echo $form->textField($model,'username'); ?>
                            <?php echo $form->error($model,'username'); ?>
                        </div>
                        <div class="pass">
                            <?php echo $form->labelEx($model,'password'); ?>
                            <?php echo $form->passwordField($model,'password'); ?>
                            <?php echo $form->error($model,'password'); ?>
                        </div>
                        <div class="clr"></div>
                        <div class="checkbox">
                            <?php echo $form->checkBox($model,'rememberMe'); ?>
                            <?php echo $form->label($model,'rememberMe'); ?>
                            <?php echo $form->error($model,'rememberMe'); ?>
                        </div>
                        <div class="submit">
                            <?php echo CHtml::submitButton('Войти'); ?>
                        </div>
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