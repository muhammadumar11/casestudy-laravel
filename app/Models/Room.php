<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'hotel_id',
        'net_price',
        'tax_price',
        'tax_type',
        'tax_currency',
        'total_price',
    ];

    protected $dates = [
        'deleted_at',
        'created_at',
        'updated_at',
    ];

    // Relationships
    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }

    // Scopes
    public function scopeHotelsJoin($query, $hotelId = null)
    {
        $query = $query->join('hotels', function ($join) use ($hotelId) {
            $join->on('rooms.hotel_id', '=', 'hotels.id');

            if (! is_null($hotelId)) {
                $join->where('rooms.hotel_id', '=', $hotelId);
            }
        });

        if (! is_null($hotelId)) {
            $query->where('rooms.hotel_id', '=', $hotelId);
        }

        return $query;
    }

    public function scopeMinRateRooms($query)
    {
        $query = $query->join(
            DB::raw("
                (
                    SELECT
                    MIN(total_price) as total_price, code
                    FROM rooms
                    GROUP BY code
                    ORDER BY total_price
                ) AS cheap_rate_rooms
            "
            ), function ($join) {
                $join->on('rooms.code', '=', 'cheap_rate_rooms.code');
                $join->on('rooms.total_price', '=', 'cheap_rate_rooms.total_price');
        });

        return $query;
    }
}
