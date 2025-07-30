<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bloodbank extends Model
{
    use HasFactory;
    public function bloods()
    {
        return $this->belongsToMany(Blood::class, 'blood_bloodbanks') ->withPivot('quantity')->withTimestamps();
    }

    public function donors()
    {
        return $this->belongsToMany(Donor::class, 'donor_bloodbanks');
    }

    
}
