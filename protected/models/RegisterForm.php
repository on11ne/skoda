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

    /**
     * Declares the validation rules.
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

            array('company', 'exist', 'className' => 'Companies'),

            array('city', 'exist', 'className' => 'Cities'),

            array('position', 'match', 'pattern'=>'/^([а-яА-Я\s-]){3,32}$/i'),

            array('photo', 'file', 'allowEmpty' => false, 'maxSize' => 3000000, 'types' => 'gif,jpg,jpeg,png')
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
}
