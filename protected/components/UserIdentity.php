<?php

class UserIdentity extends CUserIdentity
{
    protected $_id;
	public function authenticate()
	{
        $user = User::model()->findByAttributes(array('username'=>$this->username));

		if($user === NULL)
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		elseif($user->password !== $this->password)
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else
        {
            $this->_id = $user->user_id;
            $this->setState('username', $user->username);
			$this->errorCode=self::ERROR_NONE;
        }
		return !$this->errorCode;
	}

    public function getId(){
        return $this->_id;
    }
}