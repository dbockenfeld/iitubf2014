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
class cronCommand extends CConsoleCommand {

    public function getHelp() {
        return <<<EOD

   USAGE
        This command contains all the cron jobs for IITUBF.
        
EOD;
    }

    public function actionDailyBread() {
        uploadDBtoDB::archive();
    }

}
