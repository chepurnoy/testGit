<?php

/**
 * This is the model class for table "Page".
 *
 * The followings are the available columns in table 'Page':
 * @property integer $id
 * @property string $title
 * @property string $sidebar
 * @property string $template
 * @property string $content
 */
class PageModel extends CActiveRecord {

    const ACTIVE = 1;
    const NO_ACTIVE = 0;
    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'Page';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('title,  content, link, active', 'required'),
            array('title, active', 'length', 'max' => 50),
            array('link', 'length', 'max' => 75),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, link, active, title, content', 'safe', 'on' => 'search'),
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
            'title' => 'Title',
            'content' => 'Content',
            'active' => 'Visible in main menu?',
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
        $criteria->compare('title', $this->title, true);
        $criteria->compare('content', $this->content, true);
        $criteria->compare('active', $this->content, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * @author Igor Chepurnoy 
     * Generate Menu
     * @param type $arrayItems
     * @return type
     */
    public static function generateMenu($arrayItems = array()) {
        // Find all items from db
        $menu = PageModel::model()->findAllByAttributes(array('active' => self::ACTIVE));
        //Generate array from this items
        foreach ($menu as $items) {
            $arr[] = array('label' => $items->title, 'url' => array(Yii::app()->createUrl($items->link)));
        }
        //Add to array additional items if they exist
        if ($arrayItems != null && isset($arr)) {
            for ($i = 0; $i < count($arrayItems); $i++) {
                $arr[] = array_merge($arr, $arrayItems[$i]);
            }
        }
        // return complete menu
        return $arr;
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return PageModel the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
