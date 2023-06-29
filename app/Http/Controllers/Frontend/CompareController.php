<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Compare;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class CompareController extends Controller
{
    public function AddToCompare(Request $request, $property_id){

        if(Auth::check()){
            $exists = Compare::where('user_id', Auth::id())->where('property_id', $property_id)->first();

            if(!$exists){
                Compare::insert([
                    'user_id' => Auth::id(),
                    'property_id' => $property_id,
                    'created_at' => Carbon::now(),
                ]);
                return response()->json(['success' => 'Property Added to Comparison List']);

            }
            else{
                
                return response()->json(['error' => 'Property Is Already on Comparison List']);
            }
        }
        else{
            
            return response()->json(['error' => 'Log In First']);
        }

    }// End AddToWishlist
}
