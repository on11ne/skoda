<?php

class SiteController extends Controller
{
    public $layout='//layouts/main';

	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl' // perform access control for CRUD operations
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
            array('allow',  // allow all users to perform 'index' and 'error' actions
                'actions'=>array('index', 'error'),
                'users'=>array('*'),
            ),
            array('allow', // anonymous
                'actions'=>array('register', 'login', 'activate'),
                'users'=>array('?'),
            ),
            array('allow', // registered
                'actions'=>array('contact', 'logout'),
                'users'=>array('@'),
            ),
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('index');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model = new ContactForm;

		if(isset($_POST['ContactForm'])) {

			$model->attributes=$_POST['ContactForm'];

			if($model->validate()) {

                if(Mailer::sendToModerator(Yii::app()->user->id, "Пользователь #" . Yii::app()->user->id, "Сообщение обратной связи", $model->body))
				    Yii::app()->user->setFlash('success', 'Сообщение успешно отправлено!');
                else
                    Yii::app()->user->setFlash('success', 'Ошибка отправки сообщения<br/>Просьба связаться с администратором " . Yii::app()->params["adminEmail"]');

				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

    public function actionRegister() {

        $user = new Users;

        // if it is ajax validation request
        if(isset($_POST['ajax']) && $_POST['ajax']==='register-form')
        {
            echo CActiveForm::validate($user);
            Yii::app()->end();
        }

        // collect user input data
        if(isset($_POST['Users']))
        {
            $user->attributes = $_POST['Users'];

            //var_dump($user->attributes);

            $user->activation = sha1(mt_rand(10000, 99999) . time() . $user->email);
            $user->password = md5($user->password . Yii::app()->params['salt']);
            $user->status = Users::NOT_ACTIVATED;

            $user->photo = CUploadedFile::getInstance($user, 'photo');

            $image_name = uniqid() . "." . pathinfo($user->photo->name, PATHINFO_EXTENSION);

            $upload_directory = Yii::getPathOfAlias('webroot') . '/images/users/' . $image_name;
            $web_directory = '/images/users/' . $image_name;

            if(!$user->photo->saveAs($upload_directory))
                $user->addError('photo', 'Фотография не может быть сохранена');

            $user->photo = $image_name;

            if($user->save()) {

                $message = $this->renderPartial('//messages/registration', array('data' => array(
                    'first_name' => $user->first_name,
                    'surname' => $user->surname,
                    'activationLink' => Yii::app()->createAbsoluteUrl('site/activate', array('activation' => $user->activation))
                )), true);

                if(Mailer::sendToUser($user->email, "Активация учётной записи", $message)) {

                    Yii::app()->user->setFlash('success', "Спасибо!<br/>На ваш адрес электронной почты отправлено сообщение с деталями активации");

                    $this->redirect(array('site/index'));
                } else {

                    $user->addError('email', 'Сообщение об активации не может быть отправлено на указанный адрес');
                    Yii::app()->user->setFlash('error', "Процесс регистрации не может быть завершён");
                }
            }
        }

        $user->password = '';

        $this->render('register', array('model' => $user));

    }

    public function actionActivate() {

        if(empty($_GET['activation']))
            throw new CHttpException(404, 'Активационный ключ не найден');
        else
            $activation = $_GET['activation'];

        $model = Users::model()->findByAttributes(array(
            'activation' => $activation
        ));

        if ($model === null)
            throw new CHttpException(404, 'Активационный ключ не найден');
        else
            $model->status = Users::NOT_MODERATED;

        if($model->save()) {

            Yii::app()->user->setFlash('success', "Учётная запись успешно активирована!<br/>Ожидается проверка модератором");

            $message = $this->renderPartial('//messages/new_user', array('data' => $model), true);
            if(!Mailer::sendToModerator($model->email, $model->surname . " " . $model->first_name, "Регистрация нового пользователя", $message)) {
                Yii::app()->user->setFlash('error', "Не возможно отправить сообщение об активации<br/>Просьба связаться с администратором " . Yii::app()->params['adminEmail']);
            }
        }
        else
            Yii::app()->user->setFlash('error', "Ошибка активации учётной записи.<br/>Ошибка: " . var_export($model->photo, true));

        $this->redirect(array('site/index'));
    }

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout() {

		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}