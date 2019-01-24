<?php

namespace DOSBox\Command\Library;

use DOSBox\Interfaces\IDrive;
use DOSBox\Interfaces\IOutputter;
use DOSBox\Filesystem\Directory;
use DOSBox\Command\BaseCommand as Command;

class CmdCopy extends Command {

    const SYSTEM_CANNOT_FIND_THE_PATH_SPECIFIED = "The system cannot find the path specified.";
    const DESTINATION_IS_FILE = "The directory name is invalid.";

    private $sourceFile;
    private $targetDir;
    private $isOverwrite;

    public function __construct($commandName, IDrive $drive){
        parent::__construct($commandName, $drive);
    }

    public function checkNumberOfParameters($numberOfParametersEntered) {
        return ($numberOfParametersEntered == 2);
    }

    public function checkParameterValues(IOutputter $outputter) {
        if ($this->getParameterCount() < 2) {
            return false;
        }

        $sourceFile = $this->params[0];        
        $this->targetDir = $this->checkValidTargetDir($this->params[1], $outputter);
        $this->isOverwrite = isset($this->params[2]) ? $this->params[2] : false;

        if (!$this->targetDir) {
            return false;
        }
        
        if ($this->isSameFileExist($this->targetDir, $sourceFile)) {
            $outputter->printLine("This file name is already exist on $this->targetDir directory");
        }

        foreach ($this->getDrive()->getCurrentDirectory()->getContent() as $item) {
            if ($item->getName() == $sourceFile) {
                $this->sourceFile = $item;
            }
        }
        
        return true;
    }

    private function isSameFileExist($targetDir, $fileName)
    {
        foreach ($targetDir->getContent() as $item) {
            if ($item->getName() == $fileName && !$item->isDirectory()) {
                return true;
            }
        }
        return false;
    }

    private function checkValidTargetDir($dirName, IOutputter $outputter)
    {
        $destinationDirectory = $this->drive->getItemFromPath($dirName);

        if ($destinationDirectory == null) {
            $outputter->printLine(self::SYSTEM_CANNOT_FIND_THE_PATH_SPECIFIED);
            return null;
        }

        if (!$destinationDirectory->isDirectory()) {
            $outputter->printLine(self::DESTINATION_IS_FILE);
            return null;
        }

        return $destinationDirectory;
    }

    private function checkAndPreparePathParameter($pathName, IOutputter $outputter) {
        return true;
    }

    public function execute(IOutputter $outputter){
        $validParam = $this->checkParameterValues($outputter);
        if ($validParam && $this->sourceFile) {
            $this->targetDir->add($this->sourceFile);
        }
        $outputter->printLine($this->sourceFile->getName() . ' copied to ' . $this->targetDir->getName(), $outputter);
        $outputter->newLine();
    }
}