<?php

namespace DOSBox\Command;

use DOSBox\Interfaces\IDrive;
use DOSBox\Command\Library\CmdCd as CmdCd;
use DOSBox\Command\Library\CmdDir as CmdDir;
use DOSBox\Command\Library\CmdVer as CmdVer;
use DOSBox\Command\Library\CmdCopy as CmdCopy;
use DOSBox\Command\Library\CmdTime as CmdTime;
use DOSBox\Command\Library\CmdMkDir as CmdMkDir;
use DOSBox\Command\Library\CmdMkFile as CmdMkFile;
use DOSBox\Command\Library\CmdHelp as CmdHelp;

class CommandFactory {
    private $commands = array();

    public function __construct(IDrive $drive){
        array_push($this->commands, new CmdDir("dir", $drive));
        array_push($this->commands, new CmdCd("cd", $drive));
        array_push($this->commands, new CmdCd("chdir", $drive));
        array_push($this->commands, new CmdMkDir("mkdir", $drive));
        array_push($this->commands, new CmdMkDir("md", $drive));
        array_push($this->commands, new CmdMkFile("mkfile", $drive));
        array_push($this->commands, new CmdMkFile("mf", $drive));
        array_push($this->commands, new CmdTime("time", $drive));
        array_push($this->commands, new CmdVer("ver", $drive));
        array_push($this->commands, new CmCopy("copy", $drive));
        array_push($this->commands, new CmCopy("cp", $drive));
        array_push($this->commands, new CmdHelp("help", $drive));

        // Add your commands here
    }

    public function getCommands(){
        return $this->commands;
    }
}