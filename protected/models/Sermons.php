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
 * @property SermonTopics[] $sermonTopics
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
            'sermonTopics' => array(self::HAS_MANY, 'SermonTopics', 'sermon_id'),
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
    
    public function getId() {
        return $this->message_id;
    }

    public function makeSermonUrl() {
        $name = str_replace(' ', '_', preg_replace("/[^A-Za-z0-9 ]/", '', strtolower($this->title)));
        $year = date("Y", strtotime($this->sermon_date));
        $month = date("m", strtotime($this->sermon_date));
        $day = date("d", strtotime($this->sermon_date));
        return Yii::app()->createUrl('site/sermons/year/' . $year . '/month/' . $month . '/day/' . $day . '/name/' . $name);
//        return '/sermons/' . $name;
    }

    public function makeAbsoluteSermonUrl() {
        $name = str_replace(' ', '_', preg_replace("/[^A-Za-z0-9 ]/", '', strtolower($this->title)));
        $year = date("Y", strtotime($this->sermon_date));
        $month = date("m", strtotime($this->sermon_date));
        $day = date("d", strtotime($this->sermon_date));
        return Yii::app()->createAbsoluteUrl('site/sermons/year/' . $year . '/month/' . $month . '/day/' . $day . '/name/' . $name);
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
            $v = str_replace(" ", "&nbsp;", $item->passage->book->name . " " . $item->verses);
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
        return false;
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

    public function setSermonTopics() {
        $reduced_words = "";
        if ($this->text) {
            $criteria = new CDbCriteria();
            $criteria->compare("sermon_id", $this->message_id);

            $topics = SermonTopics::model()->deleteAll($criteria);

            $reduced_words = $this->title . " ";
            // Strip HTML Tags
            $clear = strip_tags($this->text);
            // Clean up things like &amp;
            $clear = html_entity_decode($clear);
            // Strip out any url-encoded stuff
            $clear = urldecode($clear);
            // Replace non-AlNum characters with space
            $clear = preg_replace('/[^A-Za-z]/', ' ', $clear);
            // Replace Multiple spaces with single space
            $clear = preg_replace('/ +/', ' ', $clear);
            // Trim the string of leading/trailing space
            $clear = trim($clear);
            $reduced_words .= " " . $this->removeCommonWords(strtolower($clear));

            $word_list = array_count_values(str_word_count($reduced_words, 1));
            arsort($word_list);
            $word_list = array_slice($word_list, 0, 20);
            foreach ($word_list as $topic => $count) {
                $model = new SermonTopics();
                $model->sermon_id = $this->message_id;
                $model->topic = $topic;
                $model->count = $count;
                $model->save();
            }
        }
    }

    public function getRelatedSermons($total = 5) {
        $criteria = new CDbCriteria();
        $criteria->limit = 8;
        $topics = array();
        foreach ($this->sermonTopics($criteria) as $topic) {
            $topics[] = $topic->topic;
            $related_criteria = new CDbCriteria();
            $related_criteria->with = array(
                "sermonTopics" => array(
                    'select' => false,
                    'joinType' => 'INNER JOIN',
//                    'condition' => 'sermonTopics.topic IN ("' . implode('","', $topics) . '")',
                ),
            );
            $related_criteria->compare("sermonTopics.topic", $topic->topic);
            $sermon_groups[$topic->topic] = self::model()->findAll($related_criteria);
        }

        $count = array();
        foreach ($sermon_groups as $topic => $list) {
            foreach ($list as $item) {
                if ($item->message_id != $this->message_id) {
                    if (isset($count[$item->message_id])) {
                        $count[$item->message_id] ++;
                    } else {
                        $count[$item->message_id] = 1;
                    }
                }
            }
        }

        arsort($count);
        $count = array_slice($count, 0, $total, true);

//        print_r($count);
//        Yii::app()->end();
        
        $sermon_ids = array ();
        foreach ($count as $key => $item) {
            $sermon_ids[] = $key;
        }
        
        $criteria = new CDbCriteria();
        $criteria->addInCondition("message_id", $sermon_ids);
        
        $sermons = Sermons::model()->findAll($criteria);


        return $sermons ? $sermons : false;
    }

    protected function removeCommonWords($input) {

        // EEEEEEK Stop words
        $commonWords = array('a', 'able', 'about', 'above', 'abroad', 'according', 'accordingly', 'across', 'actually', 'adj', 'after', 'afterwards', 'again', 'against', 'ago', 'ahead', 'ain\'t', 'all', 'allow', 'allows', 'almost', 'alone', 'along', 'alongside', 'already', 'also', 'although', 'always', 'am', 'amid', 'amidst', 'among', 'amongst', 'an', 'and', 'another', 'any', 'anybody', 'anyhow', 'anyone', 'anything', 'anyway', 'anyways', 'anywhere', 'apart', 'appear', 'appreciate', 'appropriate', 'are', 'aren\'t', 'around', 'as', 'a\'s', 'aside', 'ask', 'asking', 'associated', 'at', 'available', 'away', 'awfully', 'b', 'back', 'backward', 'backwards', 'be', 'became', 'because', 'become', 'becomes', 'becoming', 'been', 'before', 'beforehand', 'begin', 'behind', 'being', 'believe', 'below', 'beside', 'besides', 'best', 'better', 'between', 'beyond', 'both', 'brief', 'but', 'by', 'c', 'came', 'can', 'cannot', 'cant', 'can\'t', 'caption', 'cause', 'causes', 'certain', 'certainly', 'changes', 'clearly', 'c\'mon', 'co', 'co.', 'com', 'come', 'comes', 'concerning', 'consequently', 'consider', 'considering', 'contain', 'containing', 'contains', 'corresponding', 'could', 'couldn\'t', 'course', 'c\'s', 'currently', 'd', 'dare', 'daren\'t', 'definitely', 'described', 'despite', 'did', 'didn\'t', 'different', 'directly', 'do', 'does', 'doesn\'t', 'doing', 'done', 'don\'t', 'down', 'downwards', 'during', 'e', 'each', 'edu', 'eg', 'eight', 'eighty', 'either', 'else', 'elsewhere', 'end', 'ending', 'enough', 'entirely', 'especially', 'et', 'etc', 'even', 'ever', 'evermore', 'every', 'everybody', 'everyone', 'everything', 'everywhere', 'ex', 'exactly', 'example', 'except', 'f', 'fairly', 'far', 'farther', 'few', 'fewer', 'fifth', 'first', 'five', 'followed', 'following', 'follows', 'for', 'forever', 'former', 'formerly', 'forth', 'forward', 'found', 'four', 'from', 'further', 'furthermore', 'g', 'get', 'gets', 'getting', 'given', 'gives', 'go', 'goes', 'going', 'gone', 'got', 'gotten', 'greetings', 'h', 'had', 'hadn\'t', 'half', 'happens', 'hardly', 'has', 'hasn\'t', 'have', 'haven\'t', 'having', 'he', 'he\'d', 'he\'ll', 'hello', 'help', 'hence', 'her', 'here', 'hereafter', 'hereby', 'herein', 'here\'s', 'hereupon', 'hers', 'herself', 'he\'s', 'hi', 'him', 'himself', 'his', 'hither', 'hopefully', 'how', 'howbeit', 'however', 'hundred', 'i', 'i\'d', 'ie', 'if', 'ignored', 'i\'ll', 'i\'m', 'immediate', 'in', 'inasmuch', 'inc', 'inc.', 'indeed', 'indicate', 'indicated', 'indicates', 'inner', 'inside', 'insofar', 'instead', 'into', 'inward', 'is', 'isn\'t', 'it', 'it\'d', 'it\'ll', 'its', 'it\'s', 'itself', 'i\'ve', 'j', 'just', 'k', 'keep', 'keeps', 'kept', 'know', 'known', 'knows', 'l', 'last', 'lately', 'later', 'latter', 'latterly', 'least', 'less', 'lest', 'let', 'let\'s', 'like', 'liked', 'likely', 'likewise', 'little', 'look', 'looking', 'looks', 'low', 'lower', 'ltd', 'm', 'made', 'mainly', 'make', 'makes', 'many', 'may', 'maybe', 'mayn\'t', 'me', 'mean', 'meantime', 'meanwhile', 'merely', 'might', 'mightn\'t', 'mine', 'minus', 'miss', 'more', 'moreover', 'most', 'mostly', 'mr', 'mrs', 'much', 'must', 'mustn\'t', 'my', 'myself', 'n', 'name', 'namely', 'nd', 'near', 'nearly', 'necessary', 'need', 'needn\'t', 'needs', 'neither', 'never', 'neverf', 'neverless', 'nevertheless', 'new', 'next', 'nine', 'ninety', 'no', 'nobody', 'non', 'none', 'nonetheless', 'noone', 'no-one', 'nor', 'normally', 'not', 'nothing', 'notwithstanding', 'novel', 'now', 'nowhere', 'o', 'obviously', 'of', 'off', 'often', 'oh', 'ok', 'okay', 'old', 'on', 'once', 'one', 'ones', 'one\'s', 'only', 'onto', 'opposite', 'or', 'other', 'others', 'otherwise', 'ought', 'oughtn\'t', 'our', 'ours', 'ourselves', 'out', 'outside', 'over', 'overall', 'own', 'p', 'particular', 'particularly', 'past', 'per', 'perhaps', 'placed', 'please', 'plus', 'possible', 'presumably', 'probably', 'provided', 'provides', 'q', 'que', 'quite', 'qv', 'r', 'rather', 'rd', 're', 'really', 'reasonably', 'recent', 'recently', 'regarding', 'regardless', 'regards', 'relatively', 'respectively', 'right', 'round', 's', 'said', 'same', 'saw', 'say', 'saying', 'says', 'second', 'secondly', 'see', 'seeing', 'seem', 'seemed', 'seeming', 'seems', 'seen', 'self', 'selves', 'sensible', 'sent', 'serious', 'seriously', 'seven', 'several', 'shall', 'shan\'t', 'she', 'she\'d', 'she\'ll', 'she\'s', 'should', 'shouldn\'t', 'since', 'six', 'so', 'some', 'somebody', 'someday', 'somehow', 'someone', 'something', 'sometime', 'sometimes', 'somewhat', 'somewhere', 'soon', 'sorry', 'specified', 'specify', 'specifying', 'still', 'sub', 'such', 'sup', 'sure', 't', 'take', 'taken', 'taking', 'tell', 'tends', 'th', 'than', 'thank', 'thanks', 'thanx', 'that', 'that\'ll', 'thats', 'that\'s', 'that\'ve', 'the', 'their', 'theirs', 'them', 'themselves', 'then', 'thence', 'there', 'thereafter', 'thereby', 'there\'d', 'therefore', 'therein', 'there\'ll', 'there\'re', 'theres', 'there\'s', 'thereupon', 'there\'ve', 'these', 'they', 'they\'d', 'they\'ll', 'they\'re', 'they\'ve', 'thing', 'things', 'think', 'third', 'thirty', 'this', 'thorough', 'thoroughly', 'those', 'though', 'three', 'through', 'throughout', 'thru', 'thus', 'till', 'to', 'together', 'too', 'took', 'toward', 'towards', 'tried', 'tries', 'truly', 'try', 'trying', 't\'s', 'twice', 'two', 'u', 'un', 'under', 'underneath', 'undoing', 'unfortunately', 'unless', 'unlike', 'unlikely', 'until', 'unto', 'up', 'upon', 'upwards', 'us', 'use', 'used', 'useful', 'uses', 'using', 'usually', 'v', 'value', 'various', 'versus', 'very', 'via', 'viz', 'vs', 'w', 'want', 'wants', 'was', 'wasn\'t', 'way', 'we', 'we\'d', 'welcome', 'well', 'we\'ll', 'went', 'were', 'we\'re', 'weren\'t', 'we\'ve', 'what', 'whatever', 'what\'ll', 'what\'s', 'what\'ve', 'when', 'whence', 'whenever', 'where', 'whereafter', 'whereas', 'whereby', 'wherein', 'where\'s', 'whereupon', 'wherever', 'whether', 'which', 'whichever', 'while', 'whilst', 'whither', 'who', 'who\'d', 'whoever', 'whole', 'who\'ll', 'whom', 'whomever', 'who\'s', 'whose', 'why', 'will', 'willing', 'wish', 'with', 'within', 'without', 'wonder', 'won\'t', 'would', 'wouldn\'t', 'x', 'y', 'yes', 'yet', 'you', 'you\'d', 'you\'ll', 'your', 'you\'re', 'yours', 'yourself', 'yourselves', 'you\'ve', 'z', 'zero', 'rsquo', 'rdquo', 'lsquo', 'ldquo', 'jesus', 'god', 'lord', 'ndash', 'amp', 'mdash', 'nbsp', 'people', 'don', 'didn', 'time');

        return preg_replace('/\b(' . implode('|', $commonWords) . ')\b/', '', $input);
    }

}
