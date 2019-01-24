<?php

namespace DOSBox\Command\Library;

use DOSBox\Interfaces\IDrive;
use DOSBox\Interfaces\IOutputter;
use DOSBOx\Filesystem\Directory;
use DOSBox\Command\BaseCommand as Command;

class CmdHelp extends Command {

    const COMMAND_NOT_FOUND = 'Error :  This Command is not supported by the help utility';
    private static $COMMAND_LIST = array(
                        0 => array(
                            'command'   => 'CD',
                            'desc'      => 'Display the name of or changes the current directory.'
                        ),
                        1 => array(
                            'command'   => 'DIR',
                            'desc'      => 'Display a list of files and subdirectories in a directory.'
                        ),
                        2 => array(
                            'command'   => 'EXIT',
                            'desc'      => 'Quits the CMD.EXE program (command interpreter).'
                        ),
                        3 => array(
                            'command'   => 'Format',
                            'desc'      => 'Format disk for use with Windows.'
                        ),
                        4 => array(
                            'command'   => 'HELP',
                            'desc'      => 'Provides Help information for Windows commands.'
                        ),
                        5 => array(
                            'command'   => 'LABEL',
                            'desc'      => 'Creates, changes, or deletes the volume label of a disk.'
                        ),
                        6 => array(
                            'command'   => 'MKDIR',
                            'desc'      => 'Creates a directory.'
                        ),
                        7 => array(
                            'command'   => 'MKFILE',
                            'desc'      => 'Created a file.'
                        ),
                        8 => array(
                            'command'   => 'MOVE',
                            'desc'      => 'Moves one or more files from one directory to another disk.'
                        )
                    );

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
        $found = false;
        if ($this->getParameterCount() == 0) {
            $outputter->printLine("For more information on a specific command, type HELP <command-name>");
            for($i=0; $i<count(self::$COMMAND_LIST) ;$i++){
                $outputter->printLine(self::$COMMAND_LIST[$i]['command']."\t\t ".self::$COMMAND_LIST[$i]['desc']);
            }
        } else {
            $param = $this->params[0];
            for($i=0; $i<count(self::$COMMAND_LIST) ;$i++){
                if (strcasecmp($param,self::$COMMAND_LIST[$i]['command']) == 0 ) {
                    $outputter->printLine(self::$COMMAND_LIST[$i]['command']."\t\t ".self::$COMMAND_LIST[$i]['desc']);
                    $found = true;
                    break;
                }
            }
            ($found == false) ? $outputter->printLine(self::COMMAND_NOT_FOUND) : null ;
        }
    }
}