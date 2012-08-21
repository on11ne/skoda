<ul>
<?php

$items = NewsNavigator::getNewsNavigator();

foreach($items as $menu_item):

    $month_id = $menu_item['id'];
    $month_string = $menu_item['label'];

?>

    <li <?php echo ($menu_item['active']) ? "class='active'" : ""; ?>><a href="<?php echo Yii::app()->createUrl('news/index', array('month' => $month_id)); ?>" title="<?php echo $month_string; ?>"><?php echo $month_string; ?></a></li>

<?php endforeach; ?>
</ul>