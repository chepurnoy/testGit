<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{

    /**
     * @var int User ID
     */
    public $id;

    /**
     *  Type of error
     */
    const ERROR_USER_INACTIVE = 999;


	public function authenticate()
	{
        $userRecord = UserModel::model()->findByAttributes(array('username' => $this->username));
        if ($userRecord === null)
        {
            $this->errorCode=self::ERROR_USERNAME_INVALID;
        }
        else if($userRecord->password !== utf8_encode( crypt($this->password,$userRecord->password))){

	            $this->errorCode=self::ERROR_PASSWORD_INVALID;
	}

        else
        {
            $this->setState('type', $userRecord->type);
            $this->id = $userRecord->id;
            $this->errorCode = self::ERROR_NONE;
        }

        return !$this->errorCode;
	}



    /**
     * Get User ID
     * @return int|string
     * @author Anna Nosova <its.lynx@gmail.com>
     */
    public function getId()
    {
        return $this->id;
    }
}