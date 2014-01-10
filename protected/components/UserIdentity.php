<?php

class UserIdentity extends CUserIdentity
{

    /**
     * Return user id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->getState('id');
    }

    /**
     * Returns the display name for the identity.
     * The default implementation simply returns {@link username}.
     * This method is required by {@link IUserIdentity}.
     * @return string the display name for the identity.
     */
    public function getName()
    {
        return $this->getState('name');
    }

    /**
     * Authenticates a user.
     *
     */
    public function authenticate()
    {
        $user = UserModel::model()->find(
                'email=:userName AND password=:password', array(':userName' => $this->username, ':password' => UserModel::encrypt($this->password))
        );

        if (null !== $user) {
            $this->setState('id', $user->id);
            $this->setState('name', $user->firstName);
            $this->errorCode = self::ERROR_NONE;
            return true;
        } else {
            $this->errorMessage = 'Incorrect email or password';
            return false;
        }
    }
}