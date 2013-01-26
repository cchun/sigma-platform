<?php

/**
 * This is the model class for table "tbl_chatcontent".
 *
 * The followings are the available columns in table 'tbl_chatcontent':
 * @property string $namefrom
 * @property string $nameto
 * @property string $content
 * @property string $time
 * @property string $color
 * @property string $is_secret
 * @property string $is_kick
 */
class TblChatcontent extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TblChatcontent the static model class
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
		return 'tbl_chatcontent';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('namefrom, nameto', 'length', 'max'=>20),
			array('color', 'length', 'max'=>8),
			array('is_secret, is_kick', 'length', 'max'=>1),
			array('content, time', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('namefrom, nameto, content, time, color, is_secret, is_kick', 'safe', 'on'=>'search'),
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
			'namefrom' => 'Namefrom',
			'nameto' => 'Nameto',
			'content' => 'Content',
			'time' => 'Time',
			'color' => 'Color',
			'is_secret' => 'Is Secret',
			'is_kick' => 'Is Kick',
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

		$criteria->compare('namefrom',$this->namefrom,true);
		$criteria->compare('nameto',$this->nameto,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('time',$this->time,true);
		$criteria->compare('color',$this->color,true);
		$criteria->compare('is_secret',$this->is_secret,true);
		$criteria->compare('is_kick',$this->is_kick,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}