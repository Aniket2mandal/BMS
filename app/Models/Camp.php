<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Camp extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'date',
        'time',
        'address',
        'description',
        'status',
    ];

    public function bloodBanks()
    {
        return $this->belongsToMany(Bloodbank::class, 'camp_bloodbanks', 'camp_id', 'bloodbank_id');
    }
}
