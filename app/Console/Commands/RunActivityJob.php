<?php

namespace App\Console\Commands;

use App\Jobs\PullActivityData;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class RunActivityJob extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'activity:run {--sleep=0}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Dispatches the PullActivityData job and runs the queue worker for processing';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $sleep = $this->option('sleep');

        PullActivityData::dispatch()->delay(now()->addSeconds($sleep));;
        Artisan::call('queue:work --max-jobs=1 --sleep=' . $sleep + 1);
    }
}
