<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Donor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class DonorController extends Controller
{
    public function login(Request $request)
    {
        // dd($request->all());
        // Validate the request
        $request->validate([
            'username' => 'required|email',
            'password' => 'required|string|min:8',
        ]);

        $donorCredentials=Donor::where('email', $request->username)->first();

        if (!$donorCredentials || !Hash::check($request->password, $donorCredentials->password)) {
            return response()->json(['success' => false, 'message' => 'Invalid credentials'], 401);
        }
    
        //  Log the donor in using the custom 'donor' guard
        Auth::guard('donor')->login($donorCredentials);
    
        return response()->json(['success' => true, 'message' => 'Login successful']);
    
    }

    public function dashboard(){
        $donor= Auth::guard('donor')->user();
        // dd($donor->id);
        $bloodbank=$donor->bloodBanks;
        // dd($bloodbank);
        // dd($donor);
         return view ('frontend.donor.dashboard',compact('donor','bloodbank'));
    }

    public function logout(){
        Auth::guard('donor')->logout();

        // return redirect('/')->with('success', 'Logged out successfully');
        return response()->json(['success' => true, 'message' => 'Logged out successfully']);
        
    }


    public function uploadImage(Request $request)
    {
  
        // dd($request->all());
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $donor= Auth::guard('donor')->user();
        // dd($donor->id);
        // dd(get_class($donor));
        if ($donor) {
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                if ($donor->image) {
                    $oldImagePath = public_path('images/donors/' . $donor->image);
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath); // Delete old image file
                    }
                }
                $image->move(public_path('images/donors'), $imageName);
                $donor->image = $imageName;
                // Log::info('Donor instance class: ' . get_class($donor));
                $donor->save();
            }
            return response()->json(['success' => true, 'message' => 'Image uploaded successfully']);
        }

        return response()->json(['success' => false, 'message' => 'Donor not found'], 404);
    }


    public function changePassword(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'password' => 'required|string|min:8|',
        ]);

        $donor = Auth::guard('donor')->user();
        
        // $donor->password=$request->password;
            $donor->password = Hash::make($request->password);
            $donor->save();
            Auth::guard('donor')->logout();
            return response()->json(['success' => true, 'message' => 'Password changed successfully']);
    

        // return response()->json(['success' => false, 'message' => 'Current password is incorrect'], 401);
    }
}
