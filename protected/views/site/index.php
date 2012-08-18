<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
$this->widget('ext.eauth.EAuthWidget', array('action' => 'votes/add'));
?>
