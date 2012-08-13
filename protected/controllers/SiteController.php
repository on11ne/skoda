<?php

class SiteController extends Controller
{
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
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
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

            if($user->save()) {

                $name='=?UTF-8?B?'.base64_encode("Сайт программы Шкода Нижний Новгород").'?=';
                $subject='=?UTF-8?B?'.base64_encode("Активация учётной записи").'?=';
                $headers="From: $name <" . Yii::app()->params['adminEmail'] . ">\r\n".
                    "Reply-To: " . Yii::app()->params['adminEmail'] . "\r\n".
                    "MIME-Version: 1.0\r\n".
                    "Content-type: text/html; charset=UTF-8";

                $activationLink = Yii::app()->createAbsoluteUrl('site/activate', array('activation' => $user->activation));
                $message = <<<EOT
<html>
<body>
<h1>Активация учётной записи</h1>
<p>Уважаемый(ая), {$user->first_name} {$user->surname}<br>,
для активации вашей учетной записи необходимо перейти по ссылке:
<a href="$activationLink">$activationLink</a></p>
<p>______________<br/>
Если вы не регистрировались на сайте, просто удалите это письмо.
</p>
EOT;

                mail($user->email,$subject,$message,$headers);
                /*
                $identity=new UserIdentity($newUser->username,$model->password);
                $identity->authenticate();
                Yii::app()->user->login($identity,0);
                //redirect the user to page he/she came from
                $this->redirect(Yii::app()->user->returnUrl);
                */

            } else {
                var_dump($user->getErrors());
            }

        }
        // display the register form

        $this->render('register', array('model' => $user));

    }

    public function actionActivate() {

        if(empty($_GET['activation']))
            throw new CHttpException(404, 'Not found');
        else
            $activation = $_GET['activation'];

        $model = Users::model()->findByAttributes(array(
            'activation' => $activation
        ));

        if ($model === null)
            throw new CHttpException(404, 'Not found');
        else
            $model->status = Users::NOT_MODERATED;

        if($model->save())
            Yii::app()->user->setFlash('success', "Учётная запись успешно активирована!");
        else
            Yii::app()->user->setFlash('error', "Ошибка активации учётной записи");

        $this->redirect(array('site/index'));
    }

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}