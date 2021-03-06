<?php

/**
 * This is the model class for table "tbl_votes".
 *
 * The followings are the available columns in table 'tbl_votes':
 * @property integer $id
 * @property string $source
 * @property integer $contest_item_id
 * @property string $user_identity
 * @property string $created
 */
class Votes extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Votes the static model class
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
		return 'tbl_votes';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('source, contest_item_id, user_identity', 'required'),

			array('contest_item_id', 'exist', 'className' => 'ContestItems', 'attributeName' => 'id'),
            array('source', 'in', 'range' => array('facebook', 'vkontakte')),
			array('user_identity', 'length', 'max'=>255),

            array('user_identity', 'unique', 'criteria' => array(
                'condition' => 'contest_item_id=:cid',
                'params' => array(':cid' => $this->contest_item_id)), 'message' => 'Вы уже голосовали за данную работу'
            ),

			array('id, source, contest_item_id, user_identity, created', 'safe', 'on'=>'search'),
		);
	}

    /**
     * @return array relational rules.
     */
    public function relations() {

        return array(
            'contest_item' => array(self::BELONGS_TO, 'ContestItems', 'contest_item_id'),
        );
    }

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'source' => 'Социальная сеть',
			'contest_item_id' => 'Конкурсная работа',
			'user_identity' => 'ID пользователя',
			'created' => 'Добавлен',
            'contest_item' => 'Конкурсная работа',
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
		$criteria->compare('source',$this->source,true);
		$criteria->compare('contest_item_id',$this->contest_item_id);
		$criteria->compare('user_identity',$this->user_identity,true);
		$criteria->compare('created',$this->created,true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}