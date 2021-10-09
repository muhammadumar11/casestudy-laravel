<?php

namespace Tests\Unit\Console;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class SyncAdvertisersDataCommandTest extends TestCase
{
    use DatabaseTransactions;

    /*
     * @test
     *
     * It tests the successful syncing of php artisan advertiser:sync-advertisers-data
     *
     * @return void
     */
    public function test_successful_syncing_of_advertisers_data_command()
    {
        $this->artisan('advertiser:sync-advertisers-data')
            ->expectsOutput('Command Ran Successfully');
    }

}
