<?php

/**
 * This is the model class for table "estimate".
 *
 * The followings are the available columns in table 'estimate':
 * @property integer $EstimateID
 * @property integer $Value
 * @property integer $CriteriaTypeID
 * @property integer $ReviewID
 *
 * The followings are the available model relations:
 * @property Criteriatype $criteriaType
 */
class Estimate extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Estimate the static model class
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
		return 'estimate';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Value, CriteriaTypeID, ReviewID', 'required'),
			array('Value, CriteriaTypeID, ReviewID', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('EstimateID, Value, CriteriaTypeID, ReviewID', 'safe', 'on'=>'search'),
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
			'criteriaType' => array(self::BELONGS_TO, 'Criteriatype', 'CriteriaTypeID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'EstimateID' => 'Estimate',
			'Value' => 'Value',
			'CriteriaTypeID' => 'Criteria Type',
			'ReviewID' => 'Review',
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

		$criteria->compare('EstimateID',$this->EstimateID);
		$criteria->compare('Value',$this->Value);
		$criteria->compare('CriteriaTypeID',$this->CriteriaTypeID);
		$criteria->compare('ReviewID',$this->ReviewID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}