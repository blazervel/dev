<?php declare (strict_types=1);

namespace Blazervel\Dev\Console\Commands;

use Illuminate\Console\Command;

class DevCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'blazervel:dev';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Start Blazervel dev server';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // $this->call('sail up');

        return Command::SUCCESS;
    }
}