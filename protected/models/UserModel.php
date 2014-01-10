<?php

/**
 * This is the model class for table "User".
 *
 * The followings are the available columns in table 'User':
 * @property integer $id
 * @property string $firstName
 * @property string $lastName
 * @property string $email
 * @property string $type
 * @property string $avatar
 * @property string $password
 * @property string $lastLogin
 * @property string $dateCreate
 */
class UserModel extends CActiveRecord {

   
    /**
     * 
     * @return string the associated database table name
     */
    public function tableName() {
        return 'User';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('firstName, lastName, email, type, password, dateCreate', 'required'),
            array('firstName, lastName, email, type, avatar, password', 'length', 'max' => 100),
            array('email','email'),
            array('email','unique'),
            array('lastLogin', 'safe'),
            
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, firstName, lastName, email, type, avatar, password, lastLogin, dateCreate', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'firstName' => 'First Name',
            'lastName' => 'Last Name',
            'email' => 'Email',
            'type' => 'Type',
            'avatar' => 'Avatar',
            'password' => 'Password',
            'lastLogin' => 'Last Login',
            'dateCreate' => 'Date Create',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('firstName', $this->firstName, true);
        $criteria->compare('lastName', $this->lastName, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('type', $this->type, true);
        $criteria->compare('avatar', $this->avatar, true);
        $criteria->compare('password', $this->password, true);
        $criteria->compare('lastLogin', $this->lastLogin, true);
        $criteria->compare('dateCreate', $this->dateCreate, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 5
            )
        ));
    }
    
    /**
     * Encrypt
     * @author Igor Chepurnoi <Chepurnoy@zfort.com>
     */
    public static function encrypt($string) {
        return md5($string);
    }
    
    /**
     * beforeValidate
     * @return boolean
     */
    protected function beforeValidate() {
        if (parent::beforeSave()) {
            if ($this->isNewRecord) {
                $this->type  = 'user';
                $this->dateCreate  = time();
            }
            return true;
        }
        else
            return false;
    }
    
    /**
     * Event for coco uploader
     */
    public function onFileUploaded($fullFileName, $userdata, $results)
    {
        //Save to session
        $this->onAfterFileUploaded($fullFileName, 'avatar');
    }
    
    /**
     * Get Image Path
     * @author    Igor Chepurnoy <Chepurnoy@zfort.com>
     * @param type $id
     * @return type
     */
    public static function getImagePath($id) {
        $avatar = UserModel::model()->findByPk($id);
        if($avatar) {
            return "/uploads/User/".$id."/avatar/".$avatar->avatar;
        }
        
    }

    public function behaviors()
    {
        return array(
            'CocoFileBehavior' => array(
                'class' => 'application.models.behaviors.CocoFileBehavior',
                'path' => Yii::getPathOfAlias('webroot') . '/uploads/',
                'url' => Yii::app()->getBaseUrl(true) . '/uploads/',
                'fields' => array('avatar'),
                'primaryKey' => 'id',
            ),
            'ActionExBehavior' => array(
                'class' => 'application.models.behaviors.ActionExBehavior',
                'exDeletePrimaryKey' => array(1),
                'exUpdatePrimaryKey' => array(1),
                'primaryKey' => 'id',
            )
        );
    }
    
    /**
     * beforeSave
     * @return boolean
     */
    protected function beforeSave() {
        if (parent::beforeSave()) {
            if ($this->isNewRecord) {
                $this->type  = 'user';
                $this->dateCreate  = new CDbExpression("NOW()");
                $this->password = $this->encrypt($this->password);  
            }
            return true;
        }
        else
            return false;
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return UserModel the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
