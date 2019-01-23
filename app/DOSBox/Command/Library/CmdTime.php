<?php

namespace DOSBox\Command\Library;

use DOSBox\Interfaces\IDrive;
use DOSBox\Interfaces\IOutputter;
use DOSBOx\Filesystem\Directory;
use DOSBox\Command\BaseCommand as Command;

class CmdTime extends Command {

    const INVALID_TIME_GIVEN = 'Invalid time given!';

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
            $outputter->printLine(date('H:i:s'));
        } else {
            $param = $this->params[0];
            if (strtotime($param)) {
                // $outputter->printLine(date('Y-m-d H:i:s'));
            }
            else {
                $outputter->printLine(self::INVALID_TIME_GIVEN . ' ' . $this->params[0]);
            }
        }
    }
}