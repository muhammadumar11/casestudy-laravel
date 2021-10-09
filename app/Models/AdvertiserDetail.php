<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdvertiserDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'advertiser_id',
        'data',
        'synced_at',
    ];

    // Relationships
    public function advertiser_details()
    {
        return $this->hasMany(AdvertiserDetail::class);
    }

    public function last_synced_advertiser_detail()
    {
        return $this->hasOne(AdvertiserDetail::class)->latest();
    }

    public function hotels()
    {
        return $this->hasMany(Hotel::class);
    }
}
