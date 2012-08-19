<?php

class ContestitemsController extends Controller
{
    public $layout='//layouts/main';

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }


    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(
            array('allow',  // allow all users to perform 'index' and 'view' actions
                'actions'=>array('index','view'),
                'users'=>array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions'=>array('create','update', 'add'),
                'users'=>array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions'=>array('admin','delete'),
                'users'=>array('admin'),
            ),
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }

	public function actionAdd()
	{
        $contest_item = new ContestItems();

        if(isset($_POST['ajax']) && $_POST['ajax']==='add_contest-form') {

            echo CActiveForm::validate($contest_item);
            Yii::app()->end();
        }

        if(isset($_POST['ContestItems']))
        {
            $contest_item->attributes = $_POST['ContestItems'];
            $contest_item->contest_id = Yii::app()->params['contest_id'];
            $contest_item->user_id = Yii::app()->user->id;
            $contest_item->status = 0;

            if(!$contest_item->save()) {
                $contest_item->addError('', "Не возможно сохранить работу");
                $this->renderError('//contest_items/add', $contest_item);
            }

            if(($processed_images = $contest_item->processImages($contest_item->id)) === false)
                $this->renderError('//contest_items/add', $contest_item);

            $message = $this->renderPartial('//messages/new_contest_item', array('data' => $contest_item), true);

            Mailer::sendToModerator(
                Yii::app()->params['adminEmail'],
                Yii::app()->user->surname . " " . Yii::app()->user->first_name,
                "Добавлена новая работа на модерацию",
                $message);

            Yii::app()->user->setFlash('success', "Спасибо!<br/>Ваша работа отправлена на модерацию");
            $this->redirect(array('site/index'));
        }

        $this->render('//contest_items/add', array('model' => $contest_item));
	}

    function renderError($path, $model) {

        $this->render($path, array('model' => $model));
        Yii::app()->end();
    }

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}