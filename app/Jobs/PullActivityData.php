<?php

namespace App\Jobs;

use App\Models\ActivityModel;
use GuzzleHttp\Exception\BadResponseException;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpKernel\Exception\HttpException;

class PullActivityData implements ShouldQueue, ShouldBeUnique
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(ActivityModel $activityModel): void
    {
        $response = Http::acceptJson()->get('http://www.boredapi.com/api/activity');

        // Validate response
        if ($response->failed()) {
            throw new HttpException($response->status(), 'Failed to retrieve API data: ' . $response->reason());
        }

        $data = $response->json();
        if (json_last_error() !== JSON_ERROR_NONE || empty($data)) {
            throw new BadResponseException('Invalid/empty response from API');
        }

        // Insert data to model
        foreach ($data as $key => $value) {
            $activityModel->$key = $value;
        }
        $activityModel->save();
    }
}
