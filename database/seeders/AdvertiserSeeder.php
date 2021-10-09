<?php

namespace Database\Seeders;

use App\Models\Advertiser;
use Illuminate\Database\Seeder;

class AdvertiserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (Advertiser::getAdvertisers() as $advertiser) {
            Advertiser::firstOrCreate([
                'code' => $advertiser['code'],
            ], [
                'name' => ucwords($advertiser['code']),
            ]);
        }
    }
}
