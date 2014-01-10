<?php

/**
 * WebUser
 *
 * @author Orlov Alexey <Orlov.Alexey@zfort.net>
 * @version $Id$
 * @package components
 * @since 1.0
 */
class WebUser extends CWebUser
{

    private $_model = null;
    public $table = '';
    public $fieldRole = '';
    /**
     * Get role
     *
     * @version $Id$
     * @package components
     * @since 1.0
     * @return string User role
     */
    public function getType()
    {
        if(Yii::app()->user->isGuest){
            return 'guest';
        }
        if ($user = $this->getModel()) {
            // get role from table
            return $user->{$this->fieldRole};
        }
    }
  

    /**
     * Get model
     *
     * @version $Id$
     * @package components
     * @since 1.0
     * @retun CModel User Model
     */
    public function getModel()
    {        
        if (!$this->isGuest && $this->_model === null) {
            $table = $this->table;
            $this->_model = $table::model()->findByPk($this->id);
        }
        return $this->_model;
    }

    
    
}
