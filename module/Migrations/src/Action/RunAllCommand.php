<?php

namespace Migrations\Action;

class RunAllCommand
{
    /**
     * @var ListCommand
     */
    private $listCommand;

    /**
     * @var RunCommand
     */
    private $runCommand;

    public function __construct(ListCommand $listCommand, RunCommand $runCommand)
    {
        $this->listCommand = $listCommand;
        $this->runCommand = $runCommand;
    }

    public function handle()
    {
        $versions = $this->listCommand->handle();

        $result = [];
        foreach ($versions as $version) {
            if (!$version['applied']) {
                $this->runCommand->handle(new RunCommandContext($version['version']));
                $result[] = $version;
            }
        }

        return $result;
    }
}
