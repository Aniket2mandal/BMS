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

    public function user()
{
    return $this->belongsToMany(User::class, 'blood_bank_user', 'blood_bank_id', 'user_id')->withTimestamps()->as('pivot')->limit(1);
}

}
