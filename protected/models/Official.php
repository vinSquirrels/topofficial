<?php

/**
 * This is the model class for table "official".
 *
 * The followings are the available columns in table 'official':
 * @property integer $OfficialID
 * @property string $FirstName
 * @property string $LastName
 * @property string $MiddleName
 * @property string $ImageFileName
 * @property string $Post
 * @property string $Description
 * @property string $Departament
 * @property integer $CityID
 * @property integer $RegionID
 *
 * The followings are the available model relations:
 * @property Declaration[] $declarations
 * @property Estimate[] $estimates
 * @property Region $region
 * @property City $city
 */
class Official extends CActiveRecord
{
	/**
    * Returns the static model of the specified AR class.
    * @param string $className active record class name.
    * @return Official the static model class
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
       return 'official';
    }

    /**
    * @return array validation rules for model attributes.
    */
    public function rules()
    {
       // NOTE: you should only define rules for those attributes that
       // will receive user inputs.
       return array(
           array('FirstName, LastName, MiddleName, CityID', 'required'),
           array('CityID, RegionID', 'numerical', 'integerOnly'=>true),
           array('FirstName, LastName, MiddleName, ImageFileName', 'length', 'max'=>45),
           array('Post, Departament', 'length', 'max'=>255),
           array('Description', 'safe'),
           // The following rule is used by search().
           // Please remove those attributes that should not be searched.
           array('OfficialID, FirstName, LastName, MiddleName, ImageFileName, Post, Description, Departament, CityID, RegionID', 'safe', 'on'=>'search'),
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
               'declarations' => array(self::HAS_MANY, 'Declaration', 'OfficialID'),
               'reviews' => array(self::HAS_MANY, 'Review', 'OfficialID'),
               'region' => array(self::BELONGS_TO, 'Region', 'RegionID'),
               'city' => array(self::BELONGS_TO, 'City', 'CityID'),
       );
    }

    /**
    * @return array customized attribute labels (name=>label)
    */
    public function attributeLabels()
    {
       return array(
           'OfficialID' => 'Official',
           'FirstName' => 'First Name',
           'LastName' => 'Last Name',
           'MiddleName' => 'Middle Name',
           'ImageFileName' => 'Image File Name',
           'Post' => 'Post',
           'Description' => 'Description',
           'Departament' => 'Departament',
           'CityID' => 'City',
           'RegionID' => 'Region',
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

        $criteria->compare('OfficialID',$this->OfficialID);
        $criteria->compare('FirstName',$this->FirstName,true);
        $criteria->compare('LastName',$this->LastName,true);
        $criteria->compare('MiddleName',$this->MiddleName,true);
        $criteria->compare('ImageFileName',$this->ImageFileName,true);
        $criteria->compare('Post',$this->Post,true);
        $criteria->compare('Description',$this->Description,true);
        $criteria->compare('Departament',$this->Departament,true);
        $criteria->compare('CityID',$this->CityID);
        $criteria->compare('RegionID',$this->RegionID);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
        
    /**
     * Рейтинг чиновника по каждому из критериев
     * 
     * @return array
     */
    public function getCriteriaEstimates() {
        $sql = '
            SELECT 
                    estimate.CriteriaTypeID,
                    sum( estimate.Value ) / count(*) as Value,
                    topofficial.criteriatype.Name
            FROM
                    topofficial.estimate
            LEFT JOIN
                    topofficial.review ON topofficial.review.ReviewID = estimate.ReviewID
            LEFT JOIN
                    topofficial.criteriatype ON criteriatype.CriteriaTypeID = topofficial.estimate.CriteriaTypeID
            WHERE
                    topofficial.review.OfficialID = :officialID
            GROUP BY
                    estimate.CriteriaTypeID, topofficial.criteriatype.Name
        ';
        
        $command = Yii::app()->db->createCommand( $sql );
        $criteriaValues = $command->queryAll( 
            true,
            array( 
                ':officialID' => $this->OfficialID,
            )
        );
        
        
        return $criteriaValues;
    }

    
    /**
     * Приоритет чиновника
     * 
     * @return integer
     */
    public function getRank() {
        $sql = '
            SELECT 
                    sum(
                            CASE 
                                    WHEN
                                            topofficial.criteriatype.IsPositive
                                    THEN
                                            estimate.Value
                                    ELSE
                                            (-estimate.Value)
                            END

                    ) / count(*) as Value
            FROM
                topofficial.estimate
            LEFT JOIN
                    topofficial.review ON topofficial.review.ReviewID = estimate.ReviewID
            LEFT JOIN
                    topofficial.criteriatype ON criteriatype.CriteriaTypeID = estimate.CriteriaTypeID
            WHERE
               topofficial.review.OfficialID = :officialID
            LIMIT 1
        ';

        $command = Yii::app()->db->createCommand( $sql );
        $rankValue = $command->queryScalar( 
            array( 
                ':officialID' => $this->OfficialID,
            )
        );
        
        
        return $rankValue;
    }
    
    
    /**
     *  Определить путь к изображению чиновника
     * 
     * @return string
     */
    public function getImage() {
        if( !empty( $this->ImageFileName ) ) {
            return Yii::app()->params[ 'default' ][ 'images' ] . '/' . $this->ImageFileName;
        }
        else {
            return 'http://yii-booster.clevertech.biz/images/placeholder260x180.gif';
        }
    }
    
    
    public function getList( $filter ) {
        $criteria = new CDbCriteria();
        $officials = $this->findAll( $criteria );
        
        return $officials;
    }
    
    
}