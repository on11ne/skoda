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
 */
class ContestItems extends CActiveRecord
{
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
			array('title', 'length', 'max' => 255),
            array('images', 'file', 'maxFiles' => 5, 'maxSize' => 15000000),
			array('full_text, videos', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, full_text, images, videos, contest_id, user_id, status, created', 'safe', 'on'=>'search'),
		);
	}


    /**
     * @return array saved images
     */

    public function processImages() {

        $upload_directory = Yii::getPathOfAlias('webroot').'/images/contests/' .
            Yii::app()->params['contest_id']; // . '/' .
            //Yii::app()->user->id;

        if(!is_dir($upload_directory)) {
           if(!mkdir($upload_directory, 0755)) {
               $this->addError('images', 'Не возможно создать каталог пользователя');
               return false;
           }
        }

        $images = CUploadedFile::getInstancesByName('ContestItems[images]');

        $processed_images = array();

        // proceed if the images have been set
        if (isset($images) && count($images) > 0) {

            foreach ($images as $c => $pic) {

                $image_name = md5(uniqid() . time()) . "." . pathinfo($pic->name, PATHINFO_EXTENSION);

                $image = new Images();
                $image->path = $upload_directory . '/' . $image_name;
                $image->thumb_path = $upload_directory . '/' . "thumb_" . $image_name;
                $image->user_id = Yii::app()->user->id;

                // saving an image

                if (!$pic->saveAs($image->path)) {
                    $this->addError('images', 'Не возможно загрузить изображение ' . $pic->name);
                    return false;
                }

                var_dump($image->path);
                // optimizing original

                if(!($original = Yii::app()->image->load($image->path))) {
                    $this->addError('images', 'Не возможно загрузить изображение ' . $pic->name . ' для обработки');
                    return false;
                }

                $original->quality(80);
                if(!$original->save()) {
                    $this->addError('images', 'Не возможно сохранить изображение ' . $pic->name);
                    return false;
                }

                // creating thumb

                $original->resize(200, 100);
                if(!$original->save($image->thumb_path)) {
                    $this->addError('images', 'Не возможно сохранить превью изображения ' . $pic->name);
                    return false;
                }

                // saving model

                if(!$image->save()) {
                    $this->addError('images', 'Не возможно сохранить изображение ' . $pic->name . '. Ошибка:' . var_export($image->getErrors(), true));
                    return false;
                }

                $processed_images[] = $image->id;
            }
        }

        return $processed_images;
    }


    /**
     * @return array saved videos
     */

    public function processVideos() {

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
			'full_text' => 'Описание',
			'images' => 'Изображения',
			'videos' => 'Видео',
			'contest_id' => 'Конкурс',
			'user_id' => 'Пользователь',
			'status' => 'Состояние',
			'created' => 'Создан',
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
		$criteria->compare('full_text',$this->full_text,true);
		$criteria->compare('images',$this->images);
		$criteria->compare('videos',$this->videos,true);
		$criteria->compare('contest_id',$this->contest_id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('status',$this->status);
		$criteria->compare('created',$this->created,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}