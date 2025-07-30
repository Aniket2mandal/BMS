<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Camp;

use Illuminate\Http\Request;

class FrontendBloodCampController extends Controller
{
    public function index($id){
    //    dd($id);
    
        $camp=Camp::with('bloodBanks')->where('id', $id)->first();
        // dd($camp);
        return view('frontend.camp.index', compact('camp'));
    }
}
