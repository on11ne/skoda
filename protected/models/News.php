<?php

/**
 * This is the model class for table "tbl_news".
 *
 * The followings are the available columns in table 'tbl_news':
 * @property integer $id
 * @property string $title
 * @property string $teaser_text
 * @property integer $teaser_image
 * @property string $created
 * @property integer $status
 * @property string $full_text
 */
class News extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return News the static model class
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
		return 'tbl_news';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, teaser_text, teaser_image, created, status, full_text', 'required'),

			array('title', 'length', 'max'=>55),
			array('teaser_text, full_text', 'safe'),

            array('teaser_image', 'file', 'on'=>'create', 'maxSize' => 2000000, 'types' => 'jpg, png, gif'),
            array('teaser_image', 'file', 'on'=>'update', 'allowEmpty' => true, 'maxSize' => 2000000, 'types' => 'jpg, png, gif'),

            array('created', 'date', 'format' => 'yyyy-MM-dd'),

            array('status', 'in', 'range' => array(0, 1)),

			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, teaser_text, teaser_image, created, status, full_text', 'safe', 'on'=>'search'),
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
			'title' => 'Название',
			'teaser_text' => 'Краткое описание',
			'teaser_image' => 'Изображение',
			'created' => 'Дата создания',
			'status' => 'Публикация',
			'full_text' => 'Текст',
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('teaser_text',$this->teaser_text,true);
		$criteria->compare('teaser_image',$this->teaser_image);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('full_text',$this->full_text,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}