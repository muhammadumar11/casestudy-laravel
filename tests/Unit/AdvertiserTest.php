<?php

namespace Tests\Unit;

use App\Models\Advertiser;
use Database\Seeders\AdvertiserSeeder;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class AdvertiserTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @test
     *
     * A test to count advertiser after seed
     *
     * @return void
     */
    public function test_count_advertiser_after_seed()
    {
        // seed
        $this->prepareDataForTest();

        // count const in Advertiser
        $countConst = count(Advertiser::getAdvertisers());

        // count in db after seed
        $countDb = Advertiser::count();

        $this->assertTrue($countConst == $countDb, "count after AdvertiserSeeder does not match");
    }

    /**
     * prepare data
     */
    public function prepareDataForTest()
    {
        $this->artisan("db:seed", [
            '--class' => AdvertiserSeeder::class
        ]);
    }
}
