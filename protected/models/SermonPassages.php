<?php

/**
 * This is the model class for table "sermon_passages".
 *
 * The followings are the available columns in table 'sermon_passages':
 * @property integer $id
 * @property integer $sermon_id
 * @property integer $book_id
 * @property string $passage
 * @property integer $sort_order
 *
 * The followings are the available model relations:
 * @property SermonKeyVerses[] $sermonKeyVerses
 * @property Messages $sermon
 * @property Books $book
 */
class SermonPassages extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return SermonPassages the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'sermon_passages';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('sermon_id, book_id, sort_order', 'numerical', 'integerOnly' => true),
            array('passage', 'length', 'max' => 64),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, sermon_id, book_id, passage, sort_order', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'sermonKeyVerses' => array(self::HAS_MANY, 'SermonKeyVerses', 'passage_id'),
            'sermon' => array(self::BELONGS_TO, 'Messages', 'sermon_id'),
            'book' => array(self::BELONGS_TO, 'Books', 'book_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'sermon_id' => 'Sermon',
            'book_id' => 'Book',
            'passage' => 'Passage',
            'sort_order' => 'Sort Order',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('sermon_id', $this->sermon_id);
        $criteria->compare('book_id', $this->book_id);
        $criteria->compare('passage', $this->passage, true);
        $criteria->compare('sort_order', $this->sort_order);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }
    
    public function getListName() {
        return $this->book->name . " ". $this->passage;
    }

}
