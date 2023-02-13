<?php declare (strict_types=1);

namespace Blazervel\Dev\Console;

use Symfony\Component\Process\Process;

final class Command
{
    /**
     * @var string
     */
    protected string $command;

    /**
     * @var string
     */
    protected string $cwd;

    /**
     * @var array<string, string>|null
     */
    protected array|null $env = null;

    /**
     * @var array<string, string>|null
     */
    protected array|null $arguments = null;

    protected int|float|null $timeout;

    /**
     * @param string $command
     * @param array<string, string>|null $arguments
     * @param array<string, string>|null $env
     */
    public function __construct(string $command, ?array $arguments = null, ?array $env = null, int|float|null $timeout = null)
    {
        $this->command = $command;
        $this->cwd = base_path();
        $this->env = $env;
        $this->arguments = $arguments;
        $this->timeout = $timeout;
    }

    /**
     * @param string $command
     * @param array<string, string>|null $arguments
     * @param array<string, string>|null $env
     */
    public static function run(string $command, ?array $arguments = null, ?array $env = null, int|float|null $timeout = null)
    {
        return (new self($command, $arguments, $env, $timeout))->execute();
    }

    public function execute(): void
    {
        $process = Process::fromShellCommandline(
            command: $this->command,
            cwd: $this->cwd,
            env: $this->env,
            input: $this->arguments,
            timeout: $this->timeout
        );

        // $process->setOptions(['create_new_console' => true]); // Run as subprocess
        // $process->getPid(); // Get process ID

        $process->mustRun(fn ($t, $b) => $this->handleOutput($t, $b));
    }

    private function handleOutput($type, $buffer)
    {
        if (Process::ERR === $type) {
            echo "ERROR: ";
        }

        echo $buffer;
    }
}