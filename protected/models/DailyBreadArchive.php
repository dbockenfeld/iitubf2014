<?php

/**
 * This is the model class for table "daily_bread_archive".
 *
 * The followings are the available columns in table 'daily_bread_archive':
 * @property integer $id
 * @property string $date
 * @property string $title
 * @property string $passage
 * @property string $key_verse
 * @property string $text
 * @property string $prayer
 * @property string $one_word
 * @property string $intro_title
 * @property string $intro_text
 * @property string $timestamp
 */
class DailyBreadArchive extends CActiveRecord {

    public $key_verse_text = '';

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return DailyBreadArchive the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'daily_bread_archive';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('timestamp', 'required'),
            array('title, prayer, one_word, intro_title', 'length', 'max' => 255),
            array('passage, key_verse', 'length', 'max' => 64),
            array('date, text, intro_text', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, date, title, passage, key_verse, text, prayer, one_word, intro_title, intro_text, timestamp', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'dailyBreadTopics' => array(self::HAS_MANY, 'DailyBreadTopics', 'daily_bread_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'date' => 'Date',
            'title' => 'Title',
            'passage' => 'Passage',
            'key_verse' => 'Key Verse',
            'text' => 'Text',
            'prayer' => 'Prayer',
            'one_word' => 'One Word',
            'intro_title' => 'Intro Title',
            'intro_text' => 'Intro Text',
            'timestamp' => 'Timestamp',
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
        $criteria->compare('date', $this->date, true);
        $criteria->compare('title', $this->title, true);
        $criteria->compare('passage', $this->passage, true);
        $criteria->compare('key_verse', $this->key_verse, true);
        $criteria->compare('text', $this->text, true);
        $criteria->compare('prayer', $this->prayer, true);
        $criteria->compare('one_word', $this->one_word, true);
        $criteria->compare('intro_title', $this->intro_title, true);
        $criteria->compare('intro_text', $this->intro_text, true);
        $criteria->compare('timestamp', $this->timestamp, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function getFirstDB() {
        $criteria = new CDbCriteria();
        $criteria->order = 't.date ASC';
        return self::model()->find($criteria);
    }
    
    public function getLastDB() {
        $criteria = new CDbCriteria();
        $criteria->order = 't.date DESC';
        return self::model()->find($criteria);
    }
    
    public function getUrl() {
        return '/dailybread' . date('/Y/m/d', strtotime($this->date));
    }
    
    public function getAbsoluteUrl() {
        $year = date("Y", strtotime($this->date));
        $month = date("m", strtotime($this->date));
        $day = date("d", strtotime($this->date));
        return Yii::app()->createAbsoluteUrl('site/dailybread/year/' . $year . '/month/' . $month . '/day/' . $day . '/');
//        return '/dailybread' . date('/Y/m/d', strtotime($this->date));
    }
    
    public function getFeedDescription() {
        return "Today's Passage: " . $this->passage;
    }

    public function getDBDate() {
        $date = $this->date;
        return $date;
    }

    public function getDBMonth() {
        return date('M', strtotime($this->getDBDate()));
    }

    public function getDBDay() {
        return date('j', strtotime($this->getDBDate()));
    }

    public function getDBYear() {
        return date('Y', strtotime($this->getDBDate()));
    }

    public function hasPreviousDB() {
        $criteria = new CDbCriteria();
        $criteria->addCondition('t.date < "' . $this->date . '"');
        $criteria->order = 't.date DESC';

        if ($this->model()->find($criteria)) {
            return true;
        } else {
            return false;
        }
    }

    public function hasNextDB() {
        $criteria = new CDbCriteria();
        $criteria->addCondition('t.date > "' . $this->date . '"');
        $criteria->order = 't.date ASC';

        if ($this->model()->find($criteria)) {
            return true;
        } else {
            return false;
        }
    }

    public function getPreviousDB() {
        $criteria = new CDbCriteria();
        $criteria->addCondition('t.date < "' . $this->date . '"');
        $criteria->order = 't.date DESC';

        if ($db = $this->model()->find($criteria)) {
            return $db;
        } else {
            return false;
        }
    }

    public function getNextDB() {
        $criteria = new CDbCriteria();
        $criteria->addCondition('t.date > "' . $this->date . '"');
        $criteria->order = 't.date ASC';

        if ($db = $this->model()->find($criteria)) {
            return $db;
        } else {
            return false;
        }
    }

    public function setTopics() {
        $reduced_words = "";
        if ($this->text) {
            $criteria = new CDbCriteria();
            $criteria->compare("daily_bread_id", $this->id);

            $topics = DailyBreadTopics::model()->deleteAll($criteria);

            $reduced_words = $this->title . " ";

            $clear = $this->clearChars($this->text);
            $reduced_words .= " " . $this->removeCommonWords(strtolower($clear));

            $clear = $this->clearChars($this->prayer);
            $reduced_words .= " " . $this->removeCommonWords(strtolower($clear));

            $clear = $this->clearChars($this->one_word);
            $reduced_words .= " " . $this->removeCommonWords(strtolower($clear));

            $word_list = array_count_values(str_word_count($reduced_words, 1));
            arsort($word_list);
            $word_list = array_slice($word_list, 0, 20);
            foreach ($word_list as $topic => $count) {
                $model = new DailyBreadTopics();
                $model->daily_bread_id = $this->id;
                $model->topic = $topic;
                $model->count = $count;
                $model->save();
            }
        }
    }
    
    protected function clearChars($text) {
        // Strip HTML Tags
        $clear = strip_tags($text);
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
		return $clear;
    }

    protected function removeCommonWords($input) {

        // EEEEEEK Stop words
        $commonWords = array('a', 'able', 'about', 'above', 'abroad', 'according', 'accordingly', 'across', 'actually', 'adj', 'after', 'afterwards', 'again', 'against', 'ago', 'ahead', 'ain\'t', 'all', 'allow', 'allows', 'almost', 'alone', 'along', 'alongside', 'already', 'also', 'although', 'always', 'am', 'amid', 'amidst', 'among', 'amongst', 'an', 'and', 'another', 'any', 'anybody', 'anyhow', 'anyone', 'anything', 'anyway', 'anyways', 'anywhere', 'apart', 'appear', 'appreciate', 'appropriate', 'are', 'aren\'t', 'around', 'as', 'a\'s', 'aside', 'ask', 'asking', 'associated', 'at', 'available', 'away', 'awfully', 'b', 'back', 'backward', 'backwards', 'be', 'became', 'because', 'become', 'becomes', 'becoming', 'been', 'before', 'beforehand', 'begin', 'behind', 'being', 'believe', 'below', 'beside', 'besides', 'best', 'better', 'between', 'beyond', 'both', 'brief', 'but', 'by', 'c', 'came', 'can', 'cannot', 'cant', 'can\'t', 'caption', 'cause', 'causes', 'certain', 'certainly', 'changes', 'clearly', 'c\'mon', 'co', 'co.', 'com', 'come', 'comes', 'concerning', 'consequently', 'consider', 'considering', 'contain', 'containing', 'contains', 'corresponding', 'could', 'couldn\'t', 'course', 'c\'s', 'currently', 'd', 'dare', 'daren\'t', 'definitely', 'described', 'despite', 'did', 'didn\'t', 'different', 'directly', 'do', 'does', 'doesn\'t', 'doing', 'done', 'don\'t', 'down', 'downwards', 'during', 'e', 'each', 'edu', 'eg', 'eight', 'eighty', 'either', 'else', 'elsewhere', 'end', 'ending', 'enough', 'entirely', 'especially', 'et', 'etc', 'even', 'ever', 'evermore', 'every', 'everybody', 'everyone', 'everything', 'everywhere', 'ex', 'exactly', 'example', 'except', 'f', 'fairly', 'far', 'farther', 'few', 'fewer', 'fifth', 'first', 'five', 'followed', 'following', 'follows', 'for', 'forever', 'former', 'formerly', 'forth', 'forward', 'found', 'four', 'from', 'further', 'furthermore', 'g', 'get', 'gets', 'getting', 'given', 'gives', 'go', 'goes', 'going', 'gone', 'got', 'gotten', 'greetings', 'h', 'had', 'hadn\'t', 'half', 'happens', 'hardly', 'has', 'hasn\'t', 'have', 'haven\'t', 'having', 'he', 'he\'d', 'he\'ll', 'hello', 'help', 'hence', 'her', 'here', 'hereafter', 'hereby', 'herein', 'here\'s', 'hereupon', 'hers', 'herself', 'he\'s', 'hi', 'him', 'himself', 'his', 'hither', 'hopefully', 'how', 'howbeit', 'however', 'hundred', 'i', 'i\'d', 'ie', 'if', 'ignored', 'i\'ll', 'i\'m', 'immediate', 'in', 'inasmuch', 'inc', 'inc.', 'indeed', 'indicate', 'indicated', 'indicates', 'inner', 'inside', 'insofar', 'instead', 'into', 'inward', 'is', 'isn\'t', 'it', 'it\'d', 'it\'ll', 'its', 'it\'s', 'itself', 'i\'ve', 'j', 'just', 'k', 'keep', 'keeps', 'kept', 'know', 'known', 'knows', 'l', 'last', 'lately', 'later', 'latter', 'latterly', 'least', 'less', 'lest', 'let', 'let\'s', 'like', 'liked', 'likely', 'likewise', 'little', 'look', 'looking', 'looks', 'low', 'lower', 'ltd', 'm', 'made', 'mainly', 'make', 'makes', 'many', 'may', 'maybe', 'mayn\'t', 'me', 'mean', 'meantime', 'meanwhile', 'merely', 'might', 'mightn\'t', 'mine', 'minus', 'miss', 'more', 'moreover', 'most', 'mostly', 'mr', 'mrs', 'much', 'must', 'mustn\'t', 'my', 'myself', 'n', 'name', 'namely', 'nd', 'near', 'nearly', 'necessary', 'need', 'needn\'t', 'needs', 'neither', 'never', 'neverf', 'neverless', 'nevertheless', 'new', 'next', 'nine', 'ninety', 'no', 'nobody', 'non', 'none', 'nonetheless', 'noone', 'no-one', 'nor', 'normally', 'not', 'nothing', 'notwithstanding', 'novel', 'now', 'nowhere', 'o', 'obviously', 'of', 'off', 'often', 'oh', 'ok', 'okay', 'old', 'on', 'once', 'one', 'ones', 'one\'s', 'only', 'onto', 'opposite', 'or', 'other', 'others', 'otherwise', 'ought', 'oughtn\'t', 'our', 'ours', 'ourselves', 'out', 'outside', 'over', 'overall', 'own', 'p', 'particular', 'particularly', 'past', 'per', 'perhaps', 'placed', 'please', 'plus', 'possible', 'presumably', 'probably', 'provided', 'provides', 'q', 'que', 'quite', 'qv', 'r', 'rather', 'rd', 're', 'really', 'reasonably', 'recent', 'recently', 'regarding', 'regardless', 'regards', 'relatively', 'respectively', 'right', 'round', 's', 'said', 'same', 'saw', 'say', 'saying', 'says', 'second', 'secondly', 'see', 'seeing', 'seem', 'seemed', 'seeming', 'seems', 'seen', 'self', 'selves', 'sensible', 'sent', 'serious', 'seriously', 'seven', 'several', 'shall', 'shan\'t', 'she', 'she\'d', 'she\'ll', 'she\'s', 'should', 'shouldn\'t', 'since', 'six', 'so', 'some', 'somebody', 'someday', 'somehow', 'someone', 'something', 'sometime', 'sometimes', 'somewhat', 'somewhere', 'soon', 'sorry', 'specified', 'specify', 'specifying', 'still', 'sub', 'such', 'sup', 'sure', 't', 'take', 'taken', 'taking', 'tell', 'tends', 'th', 'than', 'thank', 'thanks', 'thanx', 'that', 'that\'ll', 'thats', 'that\'s', 'that\'ve', 'the', 'their', 'theirs', 'them', 'themselves', 'then', 'thence', 'there', 'thereafter', 'thereby', 'there\'d', 'therefore', 'therein', 'there\'ll', 'there\'re', 'theres', 'there\'s', 'thereupon', 'there\'ve', 'these', 'they', 'they\'d', 'they\'ll', 'they\'re', 'they\'ve', 'thing', 'things', 'think', 'third', 'thirty', 'this', 'thorough', 'thoroughly', 'those', 'though', 'three', 'through', 'throughout', 'thru', 'thus', 'till', 'to', 'together', 'too', 'took', 'toward', 'towards', 'tried', 'tries', 'truly', 'try', 'trying', 't\'s', 'twice', 'two', 'u', 'un', 'under', 'underneath', 'undoing', 'unfortunately', 'unless', 'unlike', 'unlikely', 'until', 'unto', 'up', 'upon', 'upwards', 'us', 'use', 'used', 'useful', 'uses', 'using', 'usually', 'v', 'value', 'various', 'versus', 'very', 'via', 'viz', 'vs', 'w', 'want', 'wants', 'was', 'wasn\'t', 'way', 'we', 'we\'d', 'welcome', 'well', 'we\'ll', 'went', 'were', 'we\'re', 'weren\'t', 'we\'ve', 'what', 'whatever', 'what\'ll', 'what\'s', 'what\'ve', 'when', 'whence', 'whenever', 'where', 'whereafter', 'whereas', 'whereby', 'wherein', 'where\'s', 'whereupon', 'wherever', 'whether', 'which', 'whichever', 'while', 'whilst', 'whither', 'who', 'who\'d', 'whoever', 'whole', 'who\'ll', 'whom', 'whomever', 'who\'s', 'whose', 'why', 'will', 'willing', 'wish', 'with', 'within', 'without', 'wonder', 'won\'t', 'would', 'wouldn\'t', 'x', 'y', 'yes', 'yet', 'you', 'you\'d', 'you\'ll', 'your', 'you\'re', 'yours', 'yourself', 'yourselves', 'you\'ve', 'z', 'zero', 'rsquo', 'rdquo', 'lsquo', 'ldquo', 'jesus', 'god', 'lord', 'ndash', 'amp', 'mdash', 'nbsp', 'people', 'don', 'didn', 'time', 'christ');

        return preg_replace('/\b(' . implode('|', $commonWords) . ')\b/', '', $input);
    }

}
