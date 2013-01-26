<?php

/**
 * This is the model class for table "tbl_post".
 *
 * The followings are the available columns in table 'tbl_post':
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property string $tags
 * @property integer $status
 * @property integer $create_time
 * @property integer $update_time
 * @property integer $author_id
 *
 * The followings are the available model relations:
 * @property TblComment[] $tblComments
 * @property TblUser $author
 */
class TblPost extends CActiveRecord
{
	
	const STATUS_DRAFT = 1;
	const STATUS_PUBLISHED = 2;
	const STATUS_ARCHIVED = 3;
	
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TblPost the static model class
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
		return 'tbl_post';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, content, status', 'required'),
			array('title', 'length', 'max'=>128),
			array('status', 'in', 'range'=>array(1, 2, 3)),
			array('tags', 'match', 'pattern'=>'/^[\w\s,]+$/', 
			'message'=>'Tags can only contain word characters.'),
			array('tags', 'normalizeTags'),
			array('title, status', 'safe', 'on'=>'search'),
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
			'tblComments' => array(self::HAS_MANY, 'TblComment', 'post_id', 
				'condition'=>'tblComments.status='.tblComment::STATUS_APPROVED, 
				'order'=>'tblComments.create_time DESC'
			),
			'author' => array(self::BELONGS_TO, 'TblUser', 'author_id'),
			'commentCount' => array(self::STAT, 'Comment', 'post_id',
			'condition'=>'status='.TblComment::STATUS_APPROVED)
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Title',
			'content' => 'Content',
			'tags' => 'Tags',
			'status' => 'Status',
			'create_time' => 'Create Time',
			'update_time' => 'Update Time',
			'author_id' => 'Author',
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
		$criteria->compare('content',$this->content,true);
		$criteria->compare('tags',$this->tags,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('create_time',$this->create_time);
		$criteria->compare('update_time',$this->update_time);
		$criteria->compare('author_id',$this->author_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	//Ìí¼ÓurlÂ·ÓÉ
	public function getUrl() {
		return Yii::app()->createUrl('post/view', array(
			'id' => $this->id,
			'title' => $this->title
		));
		
	}
	
	public function normalizeTags($attribute, $params) {
		$this->tags = TblTag::array2string(array_unique(TblTag::string2array($this->tags)));
	}
	
	protected function beforeSave() {
		if(parent::beforeSave()) {
			if($this->isNewRecord) {
				$this->create_time = $this->update_time = time();
				$this->author_id = Yii::app()->user->getId();
			}	
			else
				$this->update_time = time();
			return true;
		}
		else
			return false;
	}
}



