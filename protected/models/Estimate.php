<?php

/**
 * This is the model class for table "estimate".
 *
 * The followings are the available columns in table 'estimate':
 * @property integer $EstimateID
 * @property integer $Value
 * @property string $IpAddress
 * @property integer $CriteriaTypeID
 * @property string $Timestamp
 * @property integer $OfficialID
 * @property string $AuthorName
 * @property string $AuthorEmail
 * @property string $Review
 *
 * The followings are the available model relations:
 * @property Criteriatype $criteriaType
 * @property Official $official
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
			array('Value, IpAddress, CriteriaTypeID, OfficialID, Review', 'required'),
			array('Value, CriteriaTypeID, OfficialID', 'numerical', 'integerOnly'=>true),
			array('IpAddress, AuthorName, AuthorEmail', 'length', 'max'=>45),
			array('Timestamp', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('EstimateID, Value, IpAddress, CriteriaTypeID, Timestamp, OfficialID, AuthorName, AuthorEmail, Review', 'safe', 'on'=>'search'),
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
			'official' => array(self::BELONGS_TO, 'Official', 'OfficialID'),
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
			'IpAddress' => 'Ip Address',
			'CriteriaTypeID' => 'Criteria Type',
			'Timestamp' => 'Timestamp',
			'OfficialID' => 'Official',
			'AuthorName' => 'Author Name',
			'AuthorEmail' => 'Author Email',
			'Review' => 'Review',
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
		$criteria->compare('IpAddress',$this->IpAddress,true);
		$criteria->compare('CriteriaTypeID',$this->CriteriaTypeID);
		$criteria->compare('Timestamp',$this->Timestamp,true);
		$criteria->compare('OfficialID',$this->OfficialID);
		$criteria->compare('AuthorName',$this->AuthorName,true);
		$criteria->compare('AuthorEmail',$this->AuthorEmail,true);
		$criteria->compare('Review',$this->Review,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}