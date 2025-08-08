<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Blood;
use App\Models\Bloodbank;
use App\Models\Donor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BloodController extends Controller
{
    public function index()
    {
        $blood = Blood::with('bloodBanks')->paginate(10);
        //  $previous_quantity=0;
        //  $donated_quantity=0;
        // foreach($blood as $bloods){
        //     foreach($bloods->bloodBanks as $bloodBank){
        //         // dd($bloodBank->pivot->quantity);
        //         $previous_quantity += $bloodBank->pivot->quantity;
        //         $donated_quantity=Donor::with('bloodBanks')->get()->sum(function ($donor) {
        //             return $donor->bloodBanks->sum('pivot.quantity_donated');
        //         });
        
        //         $final_quantity = $previous_quantity + $donated_quantity;
        //     }
        // }
        // dd($previous_quantity);

      
    //   dd($final_quantity);
    // $donatedByGroup = Donor::with('bloodBanks')->get()
    // ->groupBy('blood') // group donors by their blood type
    // ->map(function ($group) {
    //     return $group->sum(function ($donor) {
    //         return $donor->bloodBanks->sum(function ($bloodBank) {
    //             return $bloodBank->pivot->quantity_donated ?? 0;
    //         });
    //     });
    // });

    $donatedByGroup = Donor::with('bloodBanks')->get()
    ->groupBy('blood') // Group by blood type
    ->map(function ($donors) {
        $bloodBankQuantities = [];

        foreach ($donors as $donor) {
            foreach ($donor->bloodBanks as $bloodBank) {
                $bankName = $bloodBank->name;
                $quantity = $bloodBank->pivot->quantity_donated ?? 0;

                if (!isset($bloodBankQuantities[$bankName])) {
                    $bloodBankQuantities[$bankName] = 0;
                }

                $bloodBankQuantities[$bankName] += $quantity;
            }
        }

        return $bloodBankQuantities;
    });


// dd($donatedByGroup);
        
        $user = auth()->user();
        $userBloodBanks = $user->bloodBank()->where('status', 1)->get();
        return view('backend.blood.index', compact('blood', 'userBloodBanks','donatedByGroup'));
    }

    public function create()
    {
        $bloodbank = Bloodbank::where('status', 1)->get();
        $user = auth()->user();
        $userBloodBanks = $user->bloodBank()->where('status', 1)->get();

        return view('backend.blood.create', compact('userBloodBanks', 'bloodbank'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'status' => 'integer',
            'description' => 'nullable|string|max:65535',
        ]);


        $blood = new Blood;
        $blood->name = $request->name;
        $blood->status = $request->status;
        $blood->description = $request->description;
        $blood->save();
        return redirect()->route('blood.index')->with('success', 'Blood Added Successfully');
    }

    public function edit($id)
    {
        // dd($id);
        $blood = Blood::where('status', 1)->with('bloodBanks')->find($id);
        if ($blood == null) {
            return redirect()->back()->with('error', 'Blood Not Found');
        }
        $quantity = $blood->bloodBanks->pluck('pivot.quantity')->first();

        $user = auth()->user();
        $userBloodBanks = $user->bloodBank()->where('status', 1)->get();
        $bloodbank = Bloodbank::where('status', 1)->get();

        return view('backend.blood.edit', compact('blood', 'quantity', 'userBloodBanks', 'bloodbank'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'status' => 'integer',
            'description' => 'nullable|string|max:65535',
        ]);

        $blood = Blood::find($id);
        if ($blood) {
            $blood->name = $request->name;
            $blood->status = $request->status;
            $blood->description = $request->description;
            $blood->save();

            return redirect()->route('blood.index')->with('success', 'Blood Updated Successfully');
        } else {
            return redirect()->back()->with('error', 'Blood not found.');
        }
    }

    public function delete($id)
    {
        $blood = Blood::find($id);
        if ($blood) {
            $blood->delete();
            return redirect()->back()->with('success', 'Blood Deleted Successfully');
        } else {
            return redirect()->back()->with('error', 'Blood Not Found');
        }
    }


    public function addBloodQuantity(Request $request)
    {
        $request->validate([
            'quantity' => 'required|integer',
            'bloodbank' => 'required|integer|exists:bloodbanks,id',
        ]);

        $blood = Blood::find($request->blood_id);

        $exists = $blood->bloodBanks()->where('bloodbank_id', $request->bloodbank)->exists();

        if ($exists) {
            // Update existing pivot record
            $blood->bloodBanks()->updateExistingPivot($request->bloodbank, [
                'quantity' => $request->quantity,
            ]);
        } else {

            $blood->bloodBanks()->attach($request->bloodbank, [
                'quantity' => $request->quantity,
            ]);
        }
        return response()->json([
            'success' => true,
            'message' => 'Blood bank added successfully'
        ]);
    }


}
