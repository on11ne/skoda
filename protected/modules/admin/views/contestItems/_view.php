<?php
/* @var $this ContestItemsController */
/* @var $model ContestItems */

Yii::app()->clientScript->registerCoreScript('jquery');
Yii::app()->clientScript->registerPackage('fancybox');

Yii::app()->clientScript->registerScript("fancybox_init", "
jQuery('.fancybox').fancybox({
        overlay : {
            speedIn  : 0,
            speedOut : 300,
            opacity  : 0.55,
            css      : {
                cursor : 'pointer',
                'background' : '#4ba82e'
            },
            closeClick: true
        },
        minWidth: 300,
        minHeight: 120,
        autoSize: true,
        scrolling: 'no'
    });
");

?>

<div class="view">
    <table>
        <tr>
            <td><b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b></td>
            <td><?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?></td>
        </tr>
        <tr>
            <td><b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b></td>
            <td><?php echo CHtml::encode($data->title); ?></td>
        </tr>
        <tr>
            <td><b><?php echo CHtml::encode($data->getAttributeLabel('full_text')); ?>:</b></td>
            <td><?php echo CHtml::encode($data->full_text); ?></td>
        </tr>
        <tr>
            <td><b><?php echo CHtml::encode($data->getAttributeLabel('contests')); ?>:</b></td>
            <td><?php echo CHtml::encode($data->contests->title); ?></td>
        </tr>
        <tr>
            <td><b><?php echo CHtml::encode($data->getAttributeLabel('user')); ?>:</b></td>
            <td><?php echo CHtml::encode($data->user->surname . " " . $data->user->first_name); ?></td>
        </tr>
        <tr>
            <td><b><?php echo CHtml::encode($data->getAttributeLabel('images')); ?>:</b></td>
            <td>
<?php
    if(count($data->images) > 0) {
        foreach($data->images as $image) {
            echo "<a href='$image->path' rel='ci" . $data->id . "' class='fancybox'>" . CHtml::image($image->thumb_path, $image->created, array(
                'style' => 'margin-left: 10px;'
            )) . "</a>";
        }
    } else
        echo "<strong>Нет изображений</strong>";
?>
            </td>
        </tr>
        <tr>
            <td><b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b></td>
            <td id="ci<?php echo $data->id; ?>">
                <?php

                echo ($data->status == 1) ? "Подтвержден" : (
                        ($data->status == 0) ? "Не подтверждён" : "Ошибка"
                        );
                ?>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <?php
                echo CHtml::ajaxButton(
                    'утвердить',
                    Yii::app()->createUrl('admin/contestitems/approve'),
                    array(
                        'type' => 'GET',
                        'dataType' => 'text',
                        'data' => array('id' => $data->id),
                        'success' => 'function(data) {
                            if(data == "success")
                                $("#ci' . $data->id . '").html("Подтвержден")
                            else
                                $("#ci' . $data->id . '").html("Ошибка")
                        }',
                        'beforeSend' => 'function(jqXHR, settings) {
                            $("#ci' . $data->id . '").html("<img src=/assets/6596d0c2/autocomplete/indicator.gif />")
                        }',
                        'async' => true
                    )
                );
                echo CHtml::ajaxButton(
                    'отклонить',
                    Yii::app()->createUrl('admin/contestitems/decline'),
                    array(
                        'type' => 'GET',
                        'dataType' => 'text',
                        'data' => array('id' => $data->id),
                        'success' => 'function(data) {
                            if(data == "success")
                                $("#ci' . $data->id . '").html("Не подтверждён")
                            else
                                $("#ci' . $data->id . '").html("Ошибка")
                        }',
                        'beforeSend' => 'function(jqXHR, settings) {
                            $("#ci' . $data->id . '").html("<img src=/assets/6596d0c2/autocomplete/indicator.gif />")
                        }',
                        'async' => true
                    ));
                ?>
            </td>
        </tr>
        <tr>
            <td><b><?php echo CHtml::encode($data->getAttributeLabel('created')); ?>:</b></td>
            <td><?php echo CHtml::encode($data->created); ?></td>
        </tr>
    </table>
</div>