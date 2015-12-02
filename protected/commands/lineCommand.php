<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CronCommand
 *
 * @author parallels
 */
class lineCommand extends CConsoleCommand {

    public function getHelp() {
        return <<<EOD

   USAGE
        This command contains all the cron jobs for IITUBF.
        
EOD;
    }

    public function actionSermonTopics() {
        echo "Start topic creation: " . date('Y-m-d h:i:s') . "\r\n ";
        $sermons = Sermons::model()->findAll();
        foreach ($sermons as $sermon) {
            $sermon->setSermonTopics();
        }
        echo "End topic creation: " . date('Y-m-d h:i:s') . "\r\n";
    }

}
