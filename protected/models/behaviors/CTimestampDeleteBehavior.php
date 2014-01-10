<?php

Yii::import('zii.behaviors.CTimestampBehavior');

/**
 * If delete set date stump and add default condition
 * @author Orlov Alexey <Orlov.Alexey@zfort.net>
 */
class CTimestampDeleteBehavior extends CTimestampBehavior
{

    public $deleteAttribute;

    /**
     * Set date delete
     * 
     * @param object $event Event object
     * 
     * @author Orlov Alexey <Orlov.Alexey@zfort.net>
     * @since 1.0
     * 
     * @return false
     */
    public function beforeDelete($event)
    {
        if ((!$this->getOwner()->getIsNewRecord() || $this->setUpdateOnCreate) && ($this->deleteAttribute !== null)) {
            $this->getOwner()->{$this->deleteAttribute} = $this->getTimestampByAttribute($this->deleteAttribute);
        }
        $this->getOwner()->save();
        $event->isValid = false;
        $this->getOwner()->afterDelete($event);
        return false;
    }

    /**
     * Default scope for close record if set delete date
     * 
     * @param object $event Event object
     * 
     * @author Orlov Alexey <Orlov.Alexey@zfort.net>
     * @since 1.0
     */
    public function beforeFind($event)
    {
        $criteria = $this->getOwner()->getDbCriteria();
        $criteria->addCondition('dateDelete IS NULL');
    }

}
