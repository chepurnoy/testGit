<?php

/**
 * AuthManager
 *
 * @author Orlov Alexey <Orlov.Alexey@zfort.net>
 * @version $Id$
 * @package components
 * @since 1.0
 */
class AuthManager extends CPhpAuthManager
{

    /**
     * Init
     *
     * @author Orlov Alexey <Orlov.Alexey@zfort.net>
     * @version $Id$
     * @package components
     * @since 1.0
     */
    public function init()
    {
        // Иерархию ролей расположим в файле auth.php в директории config приложения
        if ($this->authFile === null) {
            $this->authFile = Yii::getPathOfAlias('application.config.auth') . '.php';
        }

        parent::init();

        if (!Yii::app()->user->isGuest) {
            //add role for auth user
            $this->assign(Yii::app()->user->getType(), Yii::app()->user->getId());
        }
    }

}
