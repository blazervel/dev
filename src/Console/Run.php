<?php declare (strict_types=1);

use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

final class Exec
{
    private string $dir;

    private Process $process;

    public function __construct(array $command, string $dir = null)
    {
        $this->dir = $dir ?: base_path();
        $this->process = new Process($command);
    }

    private function formatCommand(array $command): array
    {
        return $command;
    }

    public static function run(string ...$command)
    {
        $exec = new self(...$command);

        try {

            $exec->process->mustRun();

        } catch(ProcessFailedException $e) {

            //

        }
    }
}