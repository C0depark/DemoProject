<?php

namespace Tests\Unit;

use App\Jobs\PullActivityData;
use App\Models\ActivityModel;
use Illuminate\Support\Facades\Http;
use Mockery\MockInterface;
use Tests\TestCase;

class PullActivityDataTest extends TestCase {

    private string $url = 'http://www.boredapi.com/api/activity';
    private string $testJson = '{"activity":"test","type":"test","participants":1,"price":0.1,"link":"","key":"1234","accessibility":0}';

    public function httpFailuresProvider(): array {
        return [
            'error' => [
                500,
                $this->getMockedActivityModel(),
                'HttpException'
            ],
            'empty' => [
                200,
                $this->getMockedActivityModel(),
                'BadResponseException'],
        ];
    }

    /**
     * @dataProvider httpFailuresProvider
     */
    public function testHandleFailures($status, $model, $expectedException): void {
        Http::fake([$this->url => Http::response([], $status)]);

        $this->expectException($expectedException);

        $job = new PullActivityData();

        $job->handle($model);
    }

    public function testHandleSuccess(): void {
        Http::fake([
            'http://www.boredapi.com/api/activity' => Http::response(
                [$this->testJson],
                200,
                ['Content-Type' => 'application/json; charset=utf-8']
            )
        ]);
        $model = $this->getMockedActivityModel(true);
        $job = new PullActivityData();

        $job->handle($model);
    }

    private function getMockedActivityModel($shouldCallSave = false): ActivityModel {
        return $this->mock(ActivityModel::class, function (MockInterface $mock) use ($shouldCallSave) {
            if (!$shouldCallSave) {
                $mock->shouldNotReceive('save');
                $mock->shouldNotReceive('setAttribute');
            } else {
                $mock->shouldReceive('save');
                $mock->shouldReceive('setAttribute');
            }
        });
    }
}
