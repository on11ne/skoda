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
        return array();
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
