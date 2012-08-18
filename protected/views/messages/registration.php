<html>
<body>
<h1>Активация учётной записи</h1>
<p>Уважаемый(ая), <?php echo $data['first_name'] . " " . $data['surname'] ?>!<br>
    Для активации вашей учетной записи необходимо перейти по ссылке:
    <a href="<?php echo $data['activationLink']; ?>"><?php echo $data['activationLink']; ?></a></p>
<p>______________<br/>
    Если вы не регистрировались на сайте, просто удалите это письмо.
</p>