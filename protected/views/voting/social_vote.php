<p style="width: 250px; text-align: center; margin: 0 auto; margin-top: 10px;">
    Предлагаем Вам проголосовать за понравившуюся Вам работу, воспользовавшись
    авторизацией через одну из социальных сетей, представленных ниже.
</p>

<?php
if($data)
    $this->widget('ext.eauth.EAuthWidget', array('action' => 'votes/add&contest_item_id=' . $data));
else
    echo "Голосование за данную работу не возможно";
?>