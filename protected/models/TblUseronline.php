<?php

/**
 * This is the model class for table "tbl_useronline".
 *
 * The followings are the available columns in table 'tbl_useronline':
 * @property string $cryptname
 * @property string $name
 * @property string $time_now
 * @property string $fromtime
 */
class TblUseronline extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TblUseronline the static model class
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
		return 'tbl_useronline';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cryptname', 'length', 'max'=>50),
			array('name', 'length', 'max'=>20),
			array('time_now, fromtime', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('cryptname, name, time_now, fromtime', 'safe', 'on'=>'search'),
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
			'cryptname' => 'Cryptname',
			'name' => 'Name',
			'time_now' => 'Time Now',
			'fromtime' => 'Fromtime',
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

		$criteria->compare('cryptname',$this->cryptname,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('time_now',$this->time_now,true);
		$criteria->compare('fromtime',$this->fromtime,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	//É¾³ýÖ¸¶¨ÐÐ
	/*static function delete($name) {
		$this->deleteAll('name=:type', array(':type'=>$name));
	}*/
	
}