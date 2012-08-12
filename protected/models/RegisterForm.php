<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class RegisterForm extends CFormModel
{
    public $email;
    public $password;
    public $first_name;
    public $surname;
    public $last_name;
    public $phone;
    public $company;
    public $city;
    public $position;
    public $photo;
    public $activation;
    public $status;
    public $registered_date;

    private $_identity;

    /**
     * Declares the validation rules.
     * The rules state that username and password are required,
     * and password needs to be authenticated.
     */
    public function rules()
    {
        return array(
            array('email', 'required'),
            array('email', 'email'),
            array('email', 'length', "min"=>3, "max"=>32),
            array('email', 'unique', 'className' => 'Users'),

            array('password', 'match', 'pattern'=>'/^([a-z0-9_])+$/i'),

            array('first_name', 'match', 'pattern'=>'/^([а-яА-Я\s]){3,32}$/i'),
            array('surname', 'match', 'pattern'=>'/^([а-яА-Я\s]){3,32}$/i'),
            array('last_name', 'match', 'pattern'=>'/^([а-яА-Я\s]){3,32}$/i'),

            array('phone', 'match', 'pattern'=>'/^([+]?[0-9 ]+){11,15}$/'),

            array('company', 'exist', 'className' => 'Users'),
        );
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels()
    {
        return array(
            'rememberMe'=>'Remember me next time',
        );
    }

    /**
     * Authenticates the password.
     * This is the 'authenticate' validator as declared in rules().
     */
    public function authenticate($attribute,$params)
    {
        if(!$this->hasErrors())
        {
            $this->_identity=new UserIdentity($this->username,$this->password);
            if(!$this->_identity->authenticate())
                $this->addError('password','Incorrect username or password.');
        }
    }

    /**
     * Logs in the user using the given username and password in the model.
     * @return boolean whether login is successful
     */
    public function login()
    {
        if($this->_identity===null)
        {
            $this->_identity=new UserIdentity($this->username,$this->password);
            $this->_identity->authenticate();
        }
        if($this->_identity->errorCode===UserIdentity::ERROR_NONE)
        {
            $duration=$this->rememberMe ? 3600*24*30 : 0; // 30 days
            Yii::app()->user->login($this->_identity,$duration);
            return true;
        }
        else
            return false;
    }
}
