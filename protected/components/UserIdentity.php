<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	/**
	 * Authenticates a user.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */

    private $_id;

	public function authenticate() {

        $record = Users::model()->findByAttributes(array('email' => $this->username));

        var_dump(md5($this->password . Yii::app()->params['salt']));

        if($record === null)
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        else if($record->password!==md5($this->password . Yii::app()->params['salt']))
            $this->errorCode=self::ERROR_PASSWORD_INVALID;
        else if($record->status != 2)
            $this->errorCode=self::ERROR_UNKNOWN_IDENTITY;
        else {
            $this->_id=$record->id;
            $this->setState('surname', $record->surname);
            $this->setState('first_name', $record->first_name);
            $this->setState('email', $record->email);
            $this->errorCode=self::ERROR_NONE;
        }

        return !$this->errorCode;
	}

    public function getId() {

        return $this->_id;
    }
}