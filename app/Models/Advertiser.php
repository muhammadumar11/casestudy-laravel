<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advertiser extends Model
{
    use HasFactory;

    const BOOKING = 'booking';
    const AIRBNB = 'airbnb';


    protected $fillable = [
        'name',
        'code',
    ];

    public static function getAdvertisers()
    {
        return [
            [
                'code' => self::BOOKING,
            ],
            [
                'code' => self::AIRBNB,
            ],
        ];
    }
}
