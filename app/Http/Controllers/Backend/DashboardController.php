<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Blood;
use App\Models\Bloodbank;
use App\Models\Donor;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){

        $user=User::count();
        // dd($user);
        $donors=Donor::count();
        $bloodbank=Bloodbank::count();
        $blood=Blood::count();
        return view('backend.dashboard',compact('user', 'donors', 'bloodbank', 'blood'));
    }
}
