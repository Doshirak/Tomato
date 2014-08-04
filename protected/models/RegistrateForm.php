<?php

class RegistrateForm extends CFormModel
{
    public $username;
    public $email;
    public $password;

    private $_identity;

    public function rules()
    {
        return array(
            array('username, email, password', 'required'),
            array('username, password, email', 'length', 'max'=>256),
            array('username','unique', 'className' => 'User', 'message' => "Username isn't unique"),
            array('email', 'email', 'message' => "The email isn't correct"),
            array('email','unique', 'className' => 'User', 'message' => "Email isn't unique"),
        );
    }

    public function registrate()
    {
        $newUser = new User;

        $newUser->username = $this->username;
        $newUser->email = $this->email;
        $newUser->password = $this->password;
        $newUser->role = 'user';
        $newUser->status = 'active';
        $newUser->rating = '0';

        $newUser->save();

        return $this->login();
    }

    public function login()
    {
        if($this->_identity === null)
        {
            $this->_identity = new UserIdentity($this->username,$this->password);
            $this->_identity->authenticate();
        }
        if($this->_identity->errorCode === UserIdentity::ERROR_NONE)
        {
            $duration = 3600*24*30;
            Yii::app()->user->login($this->_identity,$duration);
            return true;
        }
        else
            return false;
    }
}
