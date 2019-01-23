<?php

namespace DOSBox\Command\Library;

use DOSBox\Interfaces\IDrive;
use DOSBox\Interfaces\IOutputter;
use DOSBox\Filesystem\File;
use DOSBox\Command\BaseCommand as Command;

class CmdMkFile extends Command {
    public function __construct($commandName, IDrive $drive){
        parent::__construct($commandName, $drive);
    }

    public function checkNumberOfParameters($numberOfParametersEntered) {
        return true;
    }

    public function checkParameterValues(IOutputter $outputter) {
        return true;
    }

    public function execute(IOutputter $outputter){
        $fileName = isset($this->params[0]) ? $this->params[0] : '';
        $fileContent = isset($this->params[1]) ? $this->params[1] : '';
        $fileTimeStamp = date('Y-m-d h:i:s A');
        $newFile = new File($fileName, $fileContent,$fileTimeStamp);
        $existing_content = $this->getDrive()->getCurrentDirectory()->getContent();
        $not_exist = true;
        foreach($existing_content as $val){
            if($val->getName() == $fileName){
                $not_exist = false;
            }
        }
        if($not_exist){
            $this->getDrive()->getCurrentDirectory()->add($newFile);
        } else{
            $outputter->printLine("This file name is already exist on this directory");
        }
        
    }

}