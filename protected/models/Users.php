<?php

/**
 * This is the model class for table "tbl_users".
 *
 * The followings are the available columns in table 'tbl_users':
 * @property integer $id
 * @property string $email
 * @property string $password
 * @property string $first_name
 * @property string $surname
 * @property string $last_name
 * @property string $phone
 * @property integer $company
 * @property integer $city
 * @property string $position
 * @property string $photo
 * @property string $activation
 * @property integer $status
 * @property string $registered_date
 */
class Users extends CActiveRecord
{

    const NOT_ACTIVATED = 0;
    const NOT_MODERATED = 1;
    const MODERATED = 2;

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Users the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('email, password, first_name, surname, last_name, phone, company, city, position, photo, registered_date', 'required'),
			array('company, city, status', 'numerical', 'integerOnly'=>true),
			array('email, password, first_name, surname, last_name, phone, position, photo, activation', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, email, password, first_name, surname, last_name, phone, company, city, position, photo, activation, status, registered_date', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'email' => 'Email',
			'password' => 'Password',
			'first_name' => 'First Name',
			'surname' => 'Surname',
			'last_name' => 'Last Name',
			'phone' => 'Phone',
			'company' => 'Company',
			'city' => 'City',
			'position' => 'Position',
			'photo' => 'Photo',
			'activation' => 'Activation',
			'status' => 'Status',
			'registered_date' => 'Registered Date',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('first_name',$this->first_name,true);
		$criteria->compare('surname',$this->surname,true);
		$criteria->compare('last_name',$this->last_name,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('company',$this->company);
		$criteria->compare('city',$this->city);
		$criteria->compare('position',$this->position,true);
		$criteria->compare('photo',$this->photo,true);
		$criteria->compare('activation',$this->activation,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('registered_date',$this->registered_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}