<?php

namespace LaravelersAcademy\ZoomMeeting\Tests;

use LaravelersAcademy\ZoomMeeting\Providers\ZoomMeetingServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{

    public function setUp(): void
    {
        
        parent::setUp();
        // additional setup

    }

    protected function getPackageProviders($app)
    {
        
        return [
            ZoomMeetingServiceProvider::class
        ];

    }

    protected function getEnvironmentSetUp($app)
    {
        
        // perform environment setup

    }

}