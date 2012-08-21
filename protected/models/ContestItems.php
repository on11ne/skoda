<?php

/**
 * This is the model class for table "tbl_contest_items".
 *
 * The followings are the available columns in table 'tbl_contest_items':
 * @property integer $id
 * @property string $title
 * @property string $full_text
 * @property integer $images
 * @property string $videos
 * @property integer $contest_id
 * @property integer $user_id
 * @property integer $status
 * @property string $created
 * @property string $created_from
 * @property string $created_to
 */
class ContestItems extends CActiveRecord
{
    public $created_from;
    public $created_to;

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ContestItems the static model class
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
		return 'tbl_contest_items';
	}


	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, user_id, full_text', 'required'),
			array('contest_id, user_id, status', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max' => 19),
            array('full_text', 'length', 'max' => 1500, 'min' => 300),
			array('full_text', 'safe'),
            /*array('user_id', 'unique', 'criteria' => array(
                'condition' => 'contest_id=:cid',
                'params' => array(':cid' => Yii::app()->params['contest_id'])), 'message' => 'Вы уже размещали работу в данном конкурсе'
            ),*/
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('title, user_id, created, created_from, created_to', 'safe', 'on' => 'search'),
		);
	}


    /**
     * @return array saved images
     */

    public function processImages() {

        $upload_directory = Yii::getPathOfAlias('webroot').'/images/contests/' .
            Yii::app()->params['contest_id']; // . '/' .
            //Yii::app()->user->id;

        $upload_web_path = '/images/contests/' .
            Yii::app()->params['contest_id'];

        if(!is_dir($upload_directory)) {
           if(!mkdir($upload_directory, 0755)) {
               $this->addError('images', 'Не возможно создать каталог пользователя');
               return false;
           }
        }

        $images = CUploadedFile::getInstancesByName('ContestItems[images]');

        if (isset($images) && count($images) > 0) {

            foreach ($images as $c => $pic) {

                $image_name = md5(uniqid() . time()) . "." . pathinfo($pic->name, PATHINFO_EXTENSION);

                $image_real_path = $upload_directory . '/' . $image_name;
                $thumb_real_path = $upload_directory . '/' . "thumb_" . $image_name;

                $image = new Images();
                $image->path = $upload_web_path . '/' . $image_name;
                $image->thumb_path = $upload_web_path . '/' . "thumb_" . $image_name;
                $image->user_id = Yii::app()->user->id;
                $image->contest_item_id = $this->id;

                // saving an image

                if (!$pic->saveAs($image_real_path)) {
                    $this->addError('images', 'Не возможно загрузить изображение ' . $pic->name);
                    return false;
                }

                // optimizing original

                if(!($original = Yii::app()->image->load($image_real_path))) {
                    $this->addError('images', 'Не возможно загрузить изображение ' . $pic->name . ' для обработки');
                    return false;
                }

                $original->quality(80);
                if(!$original->save()) {
                    $this->addError('images', 'Не возможно сохранить изображение ' . $pic->name);
                    return false;
                }

                // creating thumb

                $original->resize(257, 126, Image::WIDTH);
                $original->crop(257, 126);

                if(!$original->save($thumb_real_path)) {
                    $this->addError('images', 'Не возможно сохранить превью изображения ' . $pic->name);
                    return false;
                }

                // saving model

                if(!$image->save()) {
                    $this->addError('images', 'Не возможно сохранить изображение ' . $pic->name . '. Ошибка:' . var_export($image->getErrors(), true));
                    return false;
                }
            }
        }
    }


    /**
     * @return array saved videos
     */

    public function processVideos() {

    }

	/**
	 * @return array relational rules.
	 */
    public function relations() {

        return array(
            'contests' => array(self::BELONGS_TO, 'Contests', 'contest_id'),
            'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
            'images' => array(self::HAS_MANY, 'Images', 'contest_item_id'),
            'votes_count' => array(self::STAT, 'Votes', 'contest_item_id'),
        );
    }


    public function scopes()
    {
        return array(
            'published'=>array(
                'condition'=>'status=1',
            ),
            'current'=>array(
                'condition'=>'contest_id=' . Yii::app()->params['contest_id']
            ),
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
			'full_text' => 'Текст',
			'images' => 'Изображения',
			'votes_count' => 'Голоса',
			'contest_id' => 'Конкурс',
            'contests' => 'Конкурс',
            'user' => 'Пользователь',
			'user_id' => 'Пользователь',
			'status' => 'Состояние',
			'created' => 'Создан',
            'created_from' => 'Период с',
            'created_to' => 'Период по',
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

		$criteria->compare('title', $this->title, true);
		$criteria->compare('user_id', $this->user_id);
		$criteria->compare('status', 1);

        $criteria->addBetweenCondition('created', '' . $this->created_from . '', '' . $this->created_to . '');

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}