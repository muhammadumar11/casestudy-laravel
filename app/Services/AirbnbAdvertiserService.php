<?php


namespace App\Services;


use App\Interfaces\AdvertiserInterface;
use App\Interfaces\HotelInterface;
use App\Interfaces\RoomInterface;
use App\Models\Advertiser;

class AirbnbAdvertiserService implements AdvertiserInterface, HotelInterface, RoomInterface
{

    public function unqiueCodeOfAdvertiser()
    {
        return Advertiser::AIRBNB;
    }

    public function calculateTotalPrice()
    {
        // TODO: Implement calculateTotalPrice() method.
    }

    public function mappingFileds()
    {
        return [
            $this->fieldHotel() => [
                $this->fieldHotelName() => 'Name of Hotel',
                $this->fieldHotelRating() => 'Ratings / Stars',
                $this->fieldRoom() => [
                    $this->fieldRoomCode() => 'Room Code',
                    $this->fieldRoomName() => 'Room Name',
                    $this->fieldRoomNetAmount() => 'Amount excluding Tax',
                    $this->filedTax() => [
                        $this->fieldTaxAmount() => 'Tax Amount',
                        $this->fieldTaxCurrency() => 'Tax Currency',
                        $this->fieldTaxType() => 'Tax Type',
                    ],
                    $this->fieldRoomTotalAmount() => 'Total Price inclusive Tax',
                ],
            ],
        ];
    }

    // Hotel
    public function fieldHotel()
    {
        return "hotels";
    }

    public function fieldHotelName()
    {
        return "name";
    }

    public function fieldHotelRating()
    {
        return "ratings";
    }

    // Room
    public function fieldRoom()
    {
        return "rooms";
    }

    public function fieldRoomCode()
    {
        return "code";
    }

    public function fieldRoomName()
    {
        return "name";
    }

    public function fieldRoomNetAmount()
    {
        return "net_rate";
    }

    public function fieldRoomTotalAmount()
    {
        return "totalPrice";
    }


    // Tax
    public function filedTax()
    {
        return "taxes";
    }

    public function fieldTaxAmount()
    {
        return "amount";
    }

    public function fieldTaxCurrency()
    {
        return "currency";
    }

    public function fieldTaxType()
    {
        return "type";
    }
}
