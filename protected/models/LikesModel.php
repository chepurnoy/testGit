<?php

/**
 * This is the model class for table "Likes".
 *
 * The followings are the available columns in table 'Likes':
 * @property integer $userId
 * @property integer $userIdLike
 *
 * The followings are the available model relations:
 * @property User    $user
 * @property User    $userIdLike0
 */
class LikesModel extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'Likes';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('ipUser, userIdLike', 'required'),
            array('userIdLike', 'numerical', 'integerOnly' => true),
            array('ipUser', 'length', 'max' => 25),
            array('ipUser, userIdLike', 'safe', 'on' => 'search'),
        );
    }

    /**
     * Check User add like
     * @author    Igor Chepurnoy <Chepurnoy@zfort.com>
     *
     * @param type $userIdLike
     *
     * @return boolean
     */
    public static function checkUserLike($userIdLike)
    {
        $ipUser = Yii::app()->request->userHostAddress;
        $model = LikesModel::model()->findAllByAttributes(array('ipUser' => $ipUser, 'userIdLike' => $userIdLike));
        if (empty($model)) {
            return true;
        } else {
            return false;
        }


    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            //'favorited' => array(self::BELONGS_TO, 'UserModel', 'userIdLike', 'condition' => 'userIdLike=:userIdLike', 'params' => array(':userIdLike' => Yii::app()->user->getId())),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'ipUser' => 'User',
            'userIdLike' => 'User Id Like',
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
    public function search()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('ipUser', $this->ipUser);
        $criteria->compare('userIdLike', $this->userIdLike);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     *
     * @param string $className active record class name.
     *
     * @return Likes the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * Save user ip and creation date.
     * @return type
     */
    protected function beforeSave()
    {
        if ($this->isNewRecord) {
            $this->createdTime = new CDbExpression('NOW()');
        }
        return parent::beforeSave();
    }
}
