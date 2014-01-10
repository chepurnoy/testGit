<?php

class UserLog
{

    public function init()
    {
        $sessionID = Yii::app()->getSession()->sessionID;
        if (!Yii::app()->user->isGuest) {
            if (Yii::app()->getSession()->sessionID == $sessionID) {
                 Yii::app()->getSession()->open();
                $sessionModel = new YiiSessionModel();
                $sessionModel->updateCounters(array('averageTime' => date("H:i:s"),'durationSession' => date("H:i:s"),'amountPages'=>+1));

            }
        }

        if (Yii::app()->user->isGuest) {
            Yii::app()->session->destroy();
        }

    }

}

