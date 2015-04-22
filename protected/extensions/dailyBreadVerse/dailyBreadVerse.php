<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of dailyBreadVerse
 *
 * @author parallels
 */
class dailyBreadVerse extends CWidget {

    public $location;

    public function init() {
        uploadDBtoDB::archive();
    }

    public function run() {
        $criteria = new CDbCriteria();
        $criteria->compare('date', date('Y-m-d'));

        $model = DailyBreadArchive::model()->find($criteria);

        $token = "iax7j0J2ZRgWCdcQfg0fGa0Qa0Ttsq1LNkdajJGX";

        $verse = str_replace(' ', '+', $model->key_verse);

        $url = "https://bibles.org/v2/passages.xml?q[]=$verse&version=eng-ESV";

        // Set up cURL
        $ch = curl_init();
// Set the URL
        curl_setopt($ch, CURLOPT_URL, $url);
// don't verify SSL certificate
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
// Return the contents of the response as a string
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
// Follow redirects
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
// Set up authentication
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_USERPWD, "$token:X");

// Do the request
        $response = curl_exec($ch);
        curl_close($ch);

// Parse the XML into a SimpleXML object
        $xml = new SimpleXMLElement($response);

// Print the text from the 0th verse
//        print ($xml->verses->verse[0]->text);
        $regex = "#<h3(.*?)</h3>#";
        $regex2 = "#<sup(.*?)</sup>#";
        $tmp = preg_replace($regex, '', $xml->search->result->passages->passage[0]->text);
        $text = preg_replace($regex2, '', $tmp);

        if ($this->location == 'sidebar') {
            $this->render('dailyBreadVerseSidebar', array(
                'model' => $model,
                'text' => $text,
            ));
        } else {
            $this->render('dailyBreadVerse', array(
                'model' => $model,
                'text' => $text,
            ));
        }
    }

}
