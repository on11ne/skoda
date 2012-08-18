<?php

class VotesController extends Controller
{
	public function actionAdd()
	{
        $service = Yii::app()->request->getQuery('service');

        if (isset($service)) {

            $authIdentity = Yii::app()->eauth->getIdentity($service);
            $authIdentity->redirectUrl = Yii::app()->user->returnUrl;
            $authIdentity->cancelUrl = $this->createAbsoluteUrl('site/login');

            if ($authIdentity->authenticate()) {
                $identity = new EAuthUserIdentity($authIdentity);

                // successful authentication
                if ($identity->authenticate()) {

                    $vote = new Votes();
                    $vote->contest_item_id = 1;
                    $vote->source = $service;
                    $vote->user_identity = $identity->getId();

                    if($vote->save())
                        Yii::app()->user->setFlash('success', 'Ваш голос успешно принят!');
                    else
                        Yii::app()->user->setFlash('error', 'Не удалось засчитать голос');

                    // special redirect with closing popup window
                    $authIdentity->redirect();
                }
                else {
                    // close popup window and redirect to cancelUrl
                    $authIdentity->cancel();
                }
            }

            // Something went wrong, redirect to login page
            $this->redirect(array('site/login'));
        }
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