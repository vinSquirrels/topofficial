<?php

/**
 * This is the model class for table "declaration".
 *
 * The followings are the available columns in table 'declaration':
 * @property integer $DeclarationID
 * @property string $FileName
 * @property integer $OfficialID
 *
 * The followings are the available model relations:
 * @property Official $official
 */
class Declaration extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Declaration the static model class
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
		return 'declaration';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('FileName, OfficialID', 'required'),
			array('OfficialID', 'numerical', 'integerOnly'=>true),
			array('FileName', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('DeclarationID, FileName, OfficialID', 'safe', 'on'=>'search'),
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
			'official' => array(self::BELONGS_TO, 'Official', 'OfficialID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'DeclarationID' => 'Declaration',
			'FileName' => 'File Name',
			'OfficialID' => 'Official',
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

		$criteria->compare('DeclarationID',$this->DeclarationID);
		$criteria->compare('FileName',$this->FileName,true);
		$criteria->compare('OfficialID',$this->OfficialID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}