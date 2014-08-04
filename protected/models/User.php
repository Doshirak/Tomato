<?php

class User extends CActiveRecord
{
	public function tableName()
	{
		return 'users';
	}

	public function rules()
	{
		return array(
			array('username, password, email, rating', 'required'),
			array('rating', 'numerical', 'integerOnly'=>true),
			array('username, password, email', 'length', 'max'=>256),
			array('role, status', 'length', 'max'=>30),
			array('user_id, username, password, email, role, status, rating', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
			'comments' => array(self::HAS_MANY, 'Comment', 'owner_id'),
			'tutorials' => array(self::HAS_MANY, 'Tutorials', 'owner_id'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'user_id' => 'User',
			'username' => 'Username',
			'password' => 'Password',
			'email' => 'Email',
			'role' => 'Role',
			'status' => 'Status',
			'rating' => 'Rating',
		);
	}

	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('role',$this->role,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('rating',$this->rating);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
