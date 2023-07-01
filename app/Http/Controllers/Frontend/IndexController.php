<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\MultiImage;
use App\Models\Facility;
use App\Models\Amenities;
use App\Models\PropertyType;
use App\Models\User;
use App\Models\PackagePlan;
use Illuminate\Support\Facades\Auth;
use App\Models\PropertyMessage;

class IndexController extends Controller
{
    public function PropertyDetails($id, $slug){

        $property = Property::findOrFail($id);

        $amenities = Amenities::latest()->get();
        $amenity_ids = explode(',', $property->amenities_id);
        $property_amenities = $amenities->whereIn('id', $amenity_ids);

        $facility = Facility::where('property_id', $id)->get();
        $type_id = $property->ptype_id;
        $relatedProperty = Property::where('ptype_id', $type_id)->where('id', '!=', $id)->orderBy('id', 'DESC')->limit(3)->get();

        $multiImage = MultiImage::where('property_id', $id)->get();
        return view('frontend.property.property_details', compact('property', 'multiImage', 'property_amenities', 'facility', 'relatedProperty'));

    }// END PropertyDetails





    public function PropertyMessage(Request $request){

        $property_id = $request->property_id;
        $agent_id = $request->agent_id;

        if (Auth::check()) {
            
            PropertyMessage::insert([

                'user_id' => Auth::user()->id,
                'agent_id' => $agent_id,
                'property_id' => $property_id,
                'msg_name' => $request->msg_name,
                'msg_email' => $request->msg_email,
                'msg_phone' => $request->msg_phone,
                'message' => $request->message,
                'created_at' => Carbon::now(),

            ]);

            $notif = array(
                'message' => 'Message Sent Successfully',
                'alert-type' => 'success',
            );

            return redirect()->back()->with($notif);

        } else {
            
            $notif = array(
                'message' => 'Login To Your Account First',
                'alert-type' => 'error',
            );

            return redirect()->back()->with($notif);
        }

    }// END PropertyMessage





    public function AgentDetails($id){

        $agent = User::findOrFail($id);
        $property = Property::where('agent_id', $id)->get();

        return view('frontend.agent.agent_details', compact('agent', 'property'));

    }// END AgentDetails
}
