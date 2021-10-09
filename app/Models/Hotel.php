<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'advertiser_id',
        'rating',
    ];

    protected $dates = [
        'deleted_at',
        'created_at',
        'updated_at',
    ];

    // Relationships
    public function advertiser()
    {
        return $this->belongsTo(Advertiser::class);
    }

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    // Scopes
    public function scopeAdvertisersJoin($query, $advertiserId = null)
    {
        $query = $query->join('advertisers', function ($join) use ($advertiserId) {
            $join->on('hotels.advertiser_id', '=', 'advertisers.id');

            if (! is_null($advertiserId)) {
                $join->where('hotels.advertiser_id', '=', $advertiserId);
            }
        });

        if (! is_null($advertiserId)) {
            $query->where('hotels.advertiser_id', '=', $advertiserId);
        }

        return $query;
    }
}
