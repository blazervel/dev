<?php declare (strict_types=1);

use Illuminate\Support\Collection;

final class Builder
{
    private Command $command;

    /**
     * @param array<int, string|array<string, string>> $command
     */
    public function __construct(array $command)
    {
        $this->command = new Command;

        $input = $command;

        if (is_array($input)) {
            $inputs = $input;
            unset($input);

            foreach ($inputs as $input) {
                $arguments = [];

                if (is_array($input)) {
                    [$input, $arguments] = $input;
                }
                
                $this->$input(...($arguments));
            }
        }
    }

    public function __call($name, $arguments)
    {
        $this->add($name, $arguments);
    }

    private function add(string $command, array $arguments)
    {
        $command = $this->cleanCommand($command);
        
        $arguments = $this->cleanArguments($arguments);

        $this->command->push(
            command: $command,
            arguments: $arguments
        );
    }

    private function cleanCommand(string $command): string
    {
        return trim($command);
    }

    private function cleanArguments(array $arguments): array
    {
        $args = new Collection($arguments);

        // $args->map(...)

        return $args->all();
    }
}