<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donor extends Authenticatable
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'password',
        'allergy',
        'blood',
        'quantity_donated',
        'donation_date',
        'image',
    ];

    public function bloodBanks()
    {
        return $this->belongsToMany(Bloodbank::class, 'donor_bloodbanks')->withPivot('donation_date','quantity_donated')->withTimestamps();
    }
    
}
