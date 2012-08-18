<?php

class ContestitemsController extends Controller
{
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

        // if it is ajax validation request
        if(isset($_POST['ajax']) && $_POST['ajax']==='add_contest-form')
        {
            echo CActiveForm::validate($contest_item);
            Yii::app()->end();
        }

        // collect user input data
        if(isset($_POST['ContestItems']))
        {
            $contest_item->attributes = $_POST['ContestItems'];
            $contest_item->contest_id = Yii::app()->params['contest_id'];
            $contest_item->user_id = Yii::app()->user->id;
            $contest_item->status = 0;

            if(($processed_images = $contest_item->processImages()) === false)
                $this->renerError('//contest_items/add', $contest_item);
            else
                $contest_item->images = implode(",", $processed_images);

            if($contest_item->save()) {

                $name='=?UTF-8?B?'.base64_encode(Yii::app()->params['adminName']).'?=';
                $subject='=?UTF-8?B?'.base64_encode("Новая конкурсная работа").'?=';
                $headers="From: $name <" . Yii::app()->params['adminEmail'] . ">\r\n".
                    "Reply-To: " . Yii::app()->params['adminEmail'] . "\r\n".
                    "MIME-Version: 1.0\r\n".
                    "Content-type: text/html; charset=UTF-8";

                $message = $this->renderPartial('//messages/new_contest_item', array('data' => array()), true);

                if(mail(Yii::app()->params['moderatorEmail'], $subject, $message, $headers))
                    Yii::app()->user->setFlash('success', "Спасибо!<br/>Ваша работа отправлена на модерацию");
                /*
                $identity=new UserIdentity($newUser->username,$model->password);
                $identity->authenticate();
                Yii::app()->user->login($identity,0);
                //redirect the user to page he/she came from
                $this->redirect(Yii::app()->user->returnUrl);
                */
            } else {
                var_dump($contest_item->getErrors());
            }

        }

		$this->render('//contest_items/add', array('model' => $contest_item));
	}

    function renerError($path, $model) {

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