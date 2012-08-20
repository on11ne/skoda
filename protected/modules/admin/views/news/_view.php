<div class="view">

    <table>
        <tr>
            <td><b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b></td>
            <td><?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?></td>
        </tr>

        <tr>
            <td><b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b></td>
            <td><?php echo CHtml::link(CHtml::encode($data->title), array('view', 'id'=>$data->id)); ?></td>
        </tr>

        <tr>
            <td><b><?php echo CHtml::encode($data->getAttributeLabel('teaser_text')); ?>:</b></td>
            <td><?php echo CHtml::encode($data->teaser_text); ?></td>
        </tr>

        <tr>
            <td><b><?php echo CHtml::encode($data->getAttributeLabel('teaser_image')); ?>:</b></td>
            <td><?php echo CHtml::image($data->teaser_image); ?></td>
        </tr>

        <tr>
            <td><b><?php echo CHtml::encode($data->getAttributeLabel('created')); ?>:</b></td>
            <td><?php echo CHtml::encode($data->created); ?></td>
        </tr>

        <tr>
            <td><b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b></td>
            <td><?php echo CHtml::encode($data->status); ?></td>
        </tr>

    </table>

</div>