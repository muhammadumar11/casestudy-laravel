<?php

namespace App\Console\Commands;

use App\Models\Advertiser;
use App\Models\AdvertiserDetail;
use App\Models\Hotel;
use App\Models\Room;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use App\Services\{
    AirbnbAdvertiserService,
    BookingAdvertiserService
};

class SyncAdvertisersDataCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'advertiser:sync-advertisers-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will sync advertisers data';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->output->title("Running Command: advertiser:sync-advertisers-data");

        $directory = 'advertisers-json/';

        $advertisersJson = [
            Advertiser::BOOKING => 'booking.json',
            Advertiser::AIRBNB => 'airbnb.json',
        ];

        foreach ($advertisersJson as $advertiser => $jsonFile) {

            $this->output->writeln("Start Syncing: $advertiser");

            if (! Storage::disk('local')->exists($directory.$jsonFile)) {
                $this->error("file to sync for $advertiser could not be found. Skipping...");

                continue;
            }

            $file = Storage::disk('local')->get($directory.$jsonFile);
            $data = json_decode($file, true);

            $class = ucfirst(${'advertiser'}.'AdvertiserService');

            $service = '';
            switch ($class) {
                case 'AirbnbAdvertiserService': {
                    $service = new AirbnbAdvertiserService();
                    break;
                }
                case 'BookingAdvertiserService': {
                    $service = new BookingAdvertiserService();
                    break;
                }
                default: {
                    break;
                }
            }

            if (is_null($service)) {
                $this->error("Service not found. Skipping...");
                continue;
            }

            $this->line("Mapping for $advertiser");

            $mapping = $service->mappingFileds();

            dump($mapping);

            $advertiser = Advertiser::firstOrCreate([
                'code' => $data['advertiser'],
            ], [
                'name' => ucwords($data['advertiser']),
            ]);

            $details = AdvertiserDetail::firstOrCreate([
                'advertiser_id' => $advertiser->id,
                'synced_at' => now(),
            ], [
                'data' => json_encode($data),
            ]);

            foreach ($data[$service->fieldHotel()] as $datum) {

                $hotel = Hotel::firstOrCreate([
                    'name' => $datum[$service->fieldHotelName()],
                    'advertiser_id' => $advertiser->id,
                ], [
                    'rating' => $datum[$service->fieldHotelRating()],
                ]);

                foreach ($datum[$service->fieldRoom()] as $room) {
                    $room = Room::firstOrCreate([
                        'code' => $room[$service->fieldRoomCode()],
                        'hotel_id' => $hotel->id,
                    ], [
                        'net_price' => $room[$service->fieldRoomNetAmount()],
                        'tax_price' => $room[$service->filedTax()][$service->fieldTaxAmount()],
                        'tax_type' => $room[$service->filedTax()][$service->fieldTaxType()],
                        'tax_currency' => $room[$service->filedTax()][$service->fieldTaxCurrency()],
                        'total_price' => $room[$service->fieldRoomTotalAmount()],
                    ]);
                }

            }

            $this->line("$advertiser->name at $details->synced_at is synced");
            $this->newLine();
        }

        $this->line("Command Ran Successfully");

        return 1;
    }
}
