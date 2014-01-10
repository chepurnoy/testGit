<?php

/**
 * Behavior for users ex delete or update
 * @author Orlov Alexey <Orlov.Alexey@zfort.net>
 */
class ActionExBehavior extends CActiveRecordBehavior
{

    /**
     * @param array
     */
    public $exDeletePrimaryKey = array();

    /**
     * @param array
     */
    public $exUpdatePrimaryKey = array();

    /**
     * @param int
     */
    public $primaryKey = 'id';

    /**
     * Check if can update record
     * @return boolean
     */
    public function canUpdate()
    {
//        if ($this->getOwner()->isNewRecord) {
//            return true;
//        }
//        if (Yii::app()->user->isGuest) {
//            return false;
//        }

        if (in_array($this->getOwner()->{$this->primaryKey}, $this->exUpdatePrimaryKey)) {
            if ($this->getOwner()->{$this->primaryKey} == Yii::app()->user->getId()) {
                return true;
            } else {
                return false;
            }
        }

        return true;
    }

    /**
     * Check if can delete record
     * @return boolean
     */
    public function canDelete()
    {
        if (in_array($this->getOwner()->{$this->primaryKey}, $this->exDeletePrimaryKey)) {
            return false;
        }

        return true;
    }

    /**
     * Event before delete
     */
    public function beforeDelete($event)
    {
        if (!$this->canDelete()) {
            $event->isValid = false;
            return false;
        }
        return true;
    }

    /**
     * Event before save
     */
    public function beforeSave($event)
    {
        if (!$this->canUpdate()) {
            $event->isValid = false;
            return false;
        }
        return true;
    }

}
