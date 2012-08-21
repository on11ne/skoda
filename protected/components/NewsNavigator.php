<?php

Yii::import('zii.widgets.CPortlet');

class NewsNavigator extends CPortlet
{
    public $monthDelta = 2;

    public function getNewsNavigator()
    {
        date_default_timezone_set("Europe/Moscow");

        if(isset($_GET['month']) && intval($_GET['month']) <= 12 && intval($_GET['month']) >= 1)
            $current_month = $_GET['month'];
        else
            $current_month = date('n');

        $month_start = $current_month - $this->monthDelta;
        $month_end = $current_month + $this->monthDelta;

        $items = array();

        for($i = $month_start; $i <= $month_end; $i++) {

            $criteria = new CDbCriteria();

            $criteria->compare('status', 1);
            $criteria->addBetweenCondition( 'created',
                '2012-' . sprintf('%02d', $i) . "-01 00:00:00",
                '2012-' . sprintf('%02d', $i+1) . "-01 00:00:00");

            setlocale(LC_TIME, "ru_RU.UTF-8");

            if(News::model()->count($criteria) > 0)
                $items[] = array(
                    'id' => $i,
                    'label' => strftime("%B %Y", strtotime('2012-' . sprintf('%02d', $i) . "-01 00:00:00")),
                    'active' => ($i == $current_month)
                );
        }

        return $items;
    }

    protected function renderContent() {
        $this->render('newsNavigator');
    }
}