<?php
$this->pageTitle = "Регистрация";

$this->breadcrumbs=array(
    'Регистрация',
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
            <div class="title">Регистрация</div>
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
            <section class="width585">
                <article class="registration">
                    <div class="desc">Все поля являются обязательными для заполнения</div>
                    <?php $form = $this->beginWidget('CActiveForm', array(
                        'id'=>'contest-items-add-form',
                        'enableAjaxValidation'=>false,
                        'htmlOptions' => array('enctype' => 'multipart/form-data')
                    )); ?>
                    <?php echo $form->errorSummary($model); ?>
                        <section>
                            <div class="width30">
                                <?php echo $form->labelEx($model,'surname'); ?>
                                <?php echo $form->textField($model, 'surname', array('class'=>'input')); ?>
                                <?php echo $form->error($model,'surname'); ?>
                            </div>
                            <div class="width30">
                                <?php echo $form->labelEx($model,'first_name'); ?>
                                <?php echo $form->textField($model, 'first_name', array('class'=>'input')); ?>
                                <?php echo $form->error($model,'first_name'); ?>
                            </div>
                            <div class="width30">
                                <?php echo $form->labelEx($model,'last_name'); ?>
                                <?php echo $form->textField($model, 'last_name', array('class'=>'input')); ?>
                                <?php echo $form->error($model,'last_name'); ?>
                            </div>
                            <div class="width50">
                                <?php echo $form->labelEx($model,'email'); ?>
                                <?php echo $form->textField($model, 'email', array('class'=>'input')); ?>
                                <?php echo $form->error($model,'email'); ?>
                            </div>
                            <div class="width50">
                                <?php echo $form->labelEx($model,'password'); ?>
                                <?php echo $form->passwordField($model, 'password', array('class'=>'input')); ?>
                                <?php echo $form->error($model,'password'); ?>
                            </div>
                            <div class="clr"></div>
                            <div class="width50">
                                <?php echo $form->labelEx($model,'phone'); ?>
                                <?php echo $form->textField($model, 'phone', array('class'=>'input')); ?>
                                <?php echo $form->error($model,'phone'); ?>
                            </div>
                            <div class="width50">
                                <?php echo $form->labelEx($model,'city'); ?>
                                <?php $this->widget('CAutoComplete',
                                array(
                                    //name of the html field that will be generated
                                    'name' => 'city_title',
                                    'value' => 'введите первые буквы',
                                    //replace controller/action with real ids
                                    'url'=> array('cities/autoCompleteLookup'),
                                    'max' => 10, //specifies the max number of items to display

                                    //specifies the number of chars that must be entered
                                    //before autocomplete initiates a lookup
                                    'minChars' => 2,
                                    'delay' => 500, //number of milliseconds before lookup occurs
                                    'matchCase' => false, //match case when performing a lookup?

                                    //any additional html attributes that go inside of
                                    //the input field can be defined here
                                    'htmlOptions'=>array(
                                        'size' => '40',
                                        'onfocus' => 'if(this.value=="введите первые буквы")this.value=""'
                                    ),

                                    'methodChain'=>".result(function(event,item){\$(\"#Users_city\").val(item[1]);})",
                                ));
                                ?>
                                <?php echo $form->hiddenField($model, 'city'); ?>
                                <?php echo $form->error($model,'city'); ?>
                            </div>
                            <div class="clr"></div>
                            <div>
                                <?php echo $form->labelEx($model,'company'); ?>
                                <?php $this->widget('CAutoComplete',
                                array(
                                    //name of the html field that will be generated
                                    'name' => 'company_title',
                                    'value' => 'введите первые буквы',
                                    //replace controller/action with real ids
                                    'url'=> array('companies/autoCompleteLookup'),
                                    'max' => 10, //specifies the max number of items to display

                                    //specifies the number of chars that must be entered
                                    //before autocomplete initiates a lookup
                                    'minChars' => 2,
                                    'delay' => 500, //number of milliseconds before lookup occurs
                                    'matchCase' => false, //match case when performing a lookup?

                                    //any additional html attributes that go inside of
                                    //the input field can be defined here
                                    'htmlOptions'=>array(
                                        'size'=>'40',
                                        'onfocus' => 'if(this.value=="введите первые буквы")this.value=""'
                                    ),

                                    'methodChain'=>".result(function(event,item){\$(\"#Users_company\").val(item[1]);})",
                                ));
                                ?>
                                <?php echo $form->hiddenField($model, 'company'); ?>
                                <?php echo $form->error($model,'company'); ?>
                            </div>
                            <div>
                                <?php echo $form->labelEx($model,'position'); ?>
                                <?php echo $form->textField($model,'position'); ?>
                                <?php echo $form->error($model,'position'); ?>
                            </div>
                            <div class="checkbox">
                                <input type="checkbox" name="agre" id="agre" checked="true" /><label for="agre">Принимаю <a href="javascript:void(0);" title="условия акции">условия акции</a></label>
                            </div>
                        </section>
                    <aside style="min-height: 242px;">
                        <div class="clr"></div>
                        <?php
                        $this->widget('CMultiFileUpload', array(
                            'model' => $model,
                            'attribute' => 'photo',
                            'accept' => 'jpg|gif|png',
                            'max' => '1',
                            'options' => array(
                                'onFileSelect'=>'function(e, v, m){ }',
                                'afterFileSelect'=>'function(e, v, m){ }',
                                'onFileAppend'=>'function(e, v, m){ }',
                                'afterFileAppend'=>'function(e, v, m){ }',
                                'onFileRemove'=>'function(e, v, m){  }',
                                'afterFileRemove'=>'function(e, v, m){  }',
                            ),
                        ));

                        echo $form->error($model,'photo');

                        Yii::app()->clientScript->registerScript('load_bxslider', "
                            $('#Users_photo_wrap').prepend('Прикрепить файл');
                            $('#Users_photo_wrap_list').detach().insertAfter('#Users_photo_wrap');",
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