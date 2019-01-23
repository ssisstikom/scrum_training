<?php

namespace DOSBox\Command\Library;

use DOSBox\Interfaces\IDrive;
use DOSBox\Interfaces\IOutputter;
use DOSBOx\Filesystem\Directory;
use DOSBox\Command\BaseCommand as Command;

class CmdVer extends Command {

    const OS_VERSION = 'Microsoft Windows XP [Version 5.1.2600]';
    private static $DEV = array(
                        0 => array(
                            'name' => 'Dani',
                            'email' => 'Dani@example.com'
                        ),
                        1 => array(
                            'name' => 'Adhe',
                            'email' => 'Adhe@example.com'
                        ),
                        2 => array(
                            'name' => 'Nanda',
                            'email' => 'Nanda@example.com'
                        ));

    public function __construct($commandName, IDrive $drive){
        parent::__construct($commandName, $drive);
    }

    public function checkNumberOfParameters($numberOfParametersEntered) {
        return ($numberOfParametersEntered == 0 || $numberOfParametersEntered == 1);
    }

    public function checkParameterValues(IOutputter $outputter) {
        return true;
    }

    public function execute(IOutputter $outputter){
        if ($this->getParameterCount() == 0) {
            $outputter->printLine(self::OS_VERSION);
        } else {
            $param = $this->params[0];
            if ($param == '/w') {
                $outputter->printLine(self::OS_VERSION);
                $outputter->printLine("Developer Name \t Developer Email");
                for($i=0; $i<count(self::$DEV) ;$i++){
                    $outputter->printLine(self::$DEV[$i]['name']."\t\t ".self::$DEV[$i]['email']);
                }
            }
            else {
            }
        }
    }
}