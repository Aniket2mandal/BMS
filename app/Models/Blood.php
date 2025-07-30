<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blood extends Model
{
    use HasFactory;


    public function bloodBanks()
    {
        return $this->belongsToMany(Bloodbank::class, 'blood_bloodbanks')->withPivot('quantity') ->withTimestamps();
    }
}
