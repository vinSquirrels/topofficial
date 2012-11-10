<?php

/**
 * This is the model class for table "criteriatype".
 *
 * The followings are the available columns in table 'criteriatype':
 * @property integer $CriteriaTypeID
 * @property string $Name
 *
 * The followings are the available model relations:
 * @property Estimate[] $estimates
 */
class CriteriaType extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return CriteriaType the static model class
     */
    public static function model($className=__CLASS__)
    {
            return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
            return 'criteriatype';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('Name', 'required'),
            array('Name', 'length', 'max'=>255),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('CriteriaTypeID, Name, IsPositive, IconFileName', 'safe', 'on'=>'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
                'estimates' => array(self::HAS_MANY, 'Estimate', 'CriteriaTypeID'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'CriteriaTypeID' => 'Criteria Type',
            'Name' => 'Name',
            'IsPositive' => 'IsPositive',
            'IconFileName' => 'IconFileName'
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria=new CDbCriteria;

        $criteria->compare('CriteriaTypeID',$this->CriteriaTypeID);
        $criteria->compare('Name',$this->Name,true);
        $criteria->compare('Name',$this->IsPositive);
        $criteria->compare('IconFileName',$this->IconFileName);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
}