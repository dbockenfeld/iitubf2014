<?php

/**
 * This is the model class for table "messages".
 *
 * The followings are the available columns in table 'messages':
 * @property integer $message_id
 * @property string $sermon_date
 * @property integer $series_id
 * @property string $title
 * @property string $passage
 * @property integer $book_id
 * @property string $verses
 * @property string $key_verse
 * @property string $key_verse_text
 * @property string $message_description
 * @property string $message_file
 * @property string $text
 * @property string $question_file
 * @property string $questions
 * @property string $message_author
 * @property integer $active
 * @property string $posted_by
 * @property string $posted_date
 * @property string $updated_by
 * @property string $updated_date
 *
 * The followings are the available model relations:
 * @property Books $book
 * @property Series $series
 * @property PodcastSermons[] $podcastSermons
 * @property SermonFiles[] $sermonFiles
 * @property SermonKeyVerses[] $sermonKeyVerses
 * @property SermonPassages[] $sermonPassages
 */
class Sermons extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Sermons the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'messages';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('series_id, book_id, active', 'numerical', 'integerOnly' => true),
            array('title, passage, message_author, posted_by, updated_by', 'length', 'max' => 50),
            array('verses, key_verse', 'length', 'max' => 64),
            array('message_file, question_file', 'length', 'max' => 100),
            array('sermon_date, key_verse_text, message_description, text, questions, posted_date, updated_date', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('message_id, sermon_date, series_id, title, passage, book_id, verses, key_verse, key_verse_text, message_description, message_file, text, question_file, questions, message_author, active, posted_by, posted_date, updated_by, updated_date', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'book' => array(self::BELONGS_TO, 'Books', 'book_id'),
            'series' => array(self::BELONGS_TO, 'SermonSeries', 'series_id'),
            'podcastSermons' => array(self::HAS_MANY, 'PodcastSermons', 'sermon_id'),
            'sermonFiles' => array(self::HAS_MANY, 'SermonFiles', 'sermon_id'),
            'sermonViewLog' => array(self::HAS_MANY, 'SermonViewLog', 'sermon_id'),
            'sermonKeyVerses' => array(self::HAS_MANY, 'SermonKeyVerses', 'sermon_id'),
            'sermonPassages' => array(self::HAS_MANY, 'SermonPassages', 'sermon_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'message_id' => 'Message',
            'sermon_date' => 'Sermon Date',
            'series_id' => 'Series',
            'title' => 'Title',
            'passage' => 'Passage',
            'book_id' => 'Book',
            'verses' => 'Verses',
            'key_verse' => 'Key Verse',
            'key_verse_text' => 'Key Verse Text',
            'message_description' => 'Message Description',
            'message_file' => 'Message File',
            'text' => 'Text',
            'question_file' => 'Question File',
            'questions' => 'Questions',
            'message_author' => 'Message Author',
            'active' => 'Active',
            'posted_by' => 'Posted By',
            'posted_date' => 'Posted Date',
            'updated_by' => 'Updated By',
            'updated_date' => 'Updated Date',
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

        $criteria->compare('message_id', $this->message_id);
        $criteria->compare('sermon_date', $this->sermon_date, true);
        $criteria->compare('series_id', $this->series_id);
        $criteria->compare('title', $this->title, true);
        $criteria->compare('passage', $this->passage, true);
        $criteria->compare('book_id', $this->book_id);
        $criteria->compare('verses', $this->verses, true);
        $criteria->compare('key_verse', $this->key_verse, true);
        $criteria->compare('key_verse_text', $this->key_verse_text, true);
        $criteria->compare('message_description', $this->message_description, true);
        $criteria->compare('message_file', $this->message_file, true);
        $criteria->compare('text', $this->text, true);
        $criteria->compare('question_file', $this->question_file, true);
        $criteria->compare('questions', $this->questions, true);
        $criteria->compare('message_author', $this->message_author, true);
        $criteria->compare('active', $this->active);
        $criteria->compare('posted_by', $this->posted_by, true);
        $criteria->compare('posted_date', $this->posted_date, true);
        $criteria->compare('updated_by', $this->updated_by, true);
        $criteria->compare('updated_date', $this->updated_date, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function makeSermonUrl() {
        $name = str_replace(' ', '_', preg_replace("/[^A-Za-z0-9 ]/", '', strtolower($this->title)));
        $year = date("Y", strtotime($this->sermon_date));
        $month = date("m", strtotime($this->sermon_date));
        $day = date("d", strtotime($this->sermon_date));
        return Yii::app()->createUrl('site/sermons/year/' . $year . '/month/' . $month . '/day/' . $day . '/name/' . $name);
//        return '/sermons/' . $name;
    }

    public function getSermonPassage() {
        if ($this->sermonPassages) {
            $passage = '';
            foreach ($this->sermonPassages as $key => $item) {
                $p = str_replace(" ", "&nbsp;", $item->book->name . ' ' . $item->passage);
                $passage .= $p;
//            echo $passage;
//            Yii::app()->end();
                if ($key + 1 < count($this->sermonPassages)) {
                    $passage .= ", ";
                }
            }
        } else {
            $passage = $this->passage;
        }
        return $passage;
    }

    public function getBookClasses() {
        $passage = '';
        foreach ($this->sermonPassages as $key => $item) {
            $passage .= "book_" . $item->book->id;
            if ($key + 1 < count($this->sermonPassages)) {
                $passage .= " ";
            }
        }
        return $passage;
    }

    public function getKeyVerse() {
        $kv = "";
        foreach ($this->sermonKeyVerses as $key => $item) {
            $v = str_replace(" ", "&nbsp;", $item->passage->book->name." " .$item->verses);
            $kv .= $v;
            if ($key + 1 < count($this->sermonKeyVerses)) {
                $kv .= "; ";
            }
        }
        return $kv;
    }
    
    public function getKeyVerseText() {
        $kv = "";
        foreach ($this->sermonKeyVerses as $key => $item) {
            $kv .= $item->text;
            if ($key + 1 < count($this->sermonKeyVerses)) {
                $kv .= "<br/>";
            }
        }
        return $kv;
    }
    
    public function getSermonDate() {
        if ($this->sermon_date != '')
            $date = $this->sermon_date;
        else {
            $date = $this->posted_date;
        }
        return $date;
    }

    public function getSermonMonth() {
        return date('M', strtotime($this->getSermonDate()));
    }

    public function getSermonDay() {
        return date('j', strtotime($this->getSermonDate()));
    }

    public function getSermonYear() {
        return date('Y', strtotime($this->getSermonDate()));
    }

    public function hasQuestions() {
        if ($this->question_file || $this->questions) {
            return true;
        } else {
            return false;
        }
    }

    public function getQuestions() {
        if ($this->questions) {
            return Yii::app()->createUrl('site/generateSermonQuestions/id/' . $this->message_id);
        }
        if ($this->question_file) {
            return '/docs/questions/' . $this->question_file;
        }
    }

    public function getTranscript() {
        if ($this->text) {
            return Yii::app()->createUrl('site/generateSermonTranscript/id/' . $this->message_id);
        }
        if ($this->message_file) {
            return '/docs/sermons/' . $this->message_file;
        }
    }

    public function hasSermonFiles() {
        if ($this->sermonFiles) {
            return true;
        } else {
            return false;
        }
    }

    public function getSermonFiles() {
        $list = array();
        foreach ($this->sermonFiles as $item) {
            $list[] = array(
                'type' => $item->type,
                'url' => Yii::app()->createUrl('site/downloadSermonFile/id/' . $item->id),
                'file_url' => $item->filename,
            );
        }
        return $list;
    }

    public function hasSermonAudio() {
        $criteria = new CDbCriteria();
        $criteria->compare('type', 'Audio');

        if ($this->sermonFiles($criteria)) {
            return true;
        } else {
            return false;
        }
    }

    public function getSermonAudio() {
        $criteria = new CDbCriteria();
        $criteria->compare('type', 'Audio');

        $search = $this->sermonFiles($criteria);

        $audio = $search[0];

        return $audio->filename;
    }

}
