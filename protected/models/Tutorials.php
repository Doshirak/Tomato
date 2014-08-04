<?php

/**
 * This is the model class for table "tutorials".
 *
 * The followings are the available columns in table 'tutorials':
 * @property integer $tutorial_id
 * @property integer $owner_id
 * @property integer $origin_id
 * @property string $content
 * @property integer $rating
 * @property integer $views
 * @property string $title
 * @property string $create_date
 * @property string $update_date
 *
 * The followings are the available model relations:
 * @property Comment[] $comments
 * @property Tags[] $tags
 * @property Users $owner
 * @property Tutorials $origin
 * @property Tutorials[] $tutorials
 */
class Tutorials extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tutorials';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('owner_id, content, rating, views, title, create_date, update_date', 'required'),
			array('owner_id, origin_id, rating, views', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>128),
            array('origin_id', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('owner_id, origin_id, content, rating, views, title', 'safe', 'on'=>'search'),
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
			'comments' => array(self::HAS_MANY, 'Comment', 'tutorial_id'),
			'tags' => array(self::MANY_MANY, 'Tags', 'tags_tutorials(tutorial_id, tag_id)'),
			'owner' => array(self::BELONGS_TO, 'Users', 'owner_id'),
			'origin' => array(self::BELONGS_TO, 'Tutorials', 'origin_id'),
			'tutorials' => array(self::HAS_MANY, 'Tutorials', 'origin_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'tutorial_id' => 'Tutorial',
			'owner_id' => 'Owner',
			'origin_id' => 'Origin',
			'content' => 'Content',
			'rating' => 'Rating',
			'views' => 'Views',
			'title' => 'Title',
			'create_date' => 'Create Date',
			'update_date' => 'Update Date',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('tutorial_id',$this->tutorial_id);
		$criteria->compare('owner_id',$this->owner_id);
		$criteria->compare('origin_id',$this->origin_id);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('rating',$this->rating);
		$criteria->compare('views',$this->views);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('update_date',$this->update_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Tutorials the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
