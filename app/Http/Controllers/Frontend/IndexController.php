<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Amenities;
use App\Models\Facility;
use App\Models\MultiImage;
use App\Models\Property;
use App\Models\PropertyMessage;
use App\Models\PropertyType;
use App\Models\Schedule;
use App\Models\State;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function PropertyCategory(){

        $property_type = PropertyType::latest()->get();

        return view('frontend.property.category_property', compact('property_type'));
        
    }// END PropertyCategory

    public function PropertyDetails($id, $slug)
    {

        $property = Property::findOrFail($id);

        $amenities = Amenities::latest()->get();
        $amenity_ids = explode(',', $property->amenities_id);
        $property_amenities = $amenities->whereIn('id', $amenity_ids);

        $facility = Facility::where('property_id', $id)->get();
        $type_id = $property->ptype_id;
        $relatedProperty = Property::where('ptype_id', $type_id)->where('id', '!=', $id)->orderBy('id', 'DESC')->limit(3)->get();

        $multiImage = MultiImage::where('property_id', $id)->get();
        return view('frontend.property.property_details', compact('property', 'multiImage', 'property_amenities', 'facility', 'relatedProperty'));

    } // END PropertyDetails

    public function PropertyMessage(Request $request)
    {

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

    } // END PropertyMessage

    public function AgentDetails($id)
    {

        $agent = User::findOrFail($id);
        $property = Property::where('agent_id', $id)->get();
        $featured = Property::where('featured', '1')->limit(3)->get();
        $rentProperty = Property::where('status', '1')->where('property_status', 'rent')->get();
        $buyProperty = Property::where('status', '1')->where('property_status', 'buy')->get();

        return view('frontend.agent.agent_details', compact('agent', 'property', 'featured', 'rentProperty', 'buyProperty'));

    } // END AgentDetails

    public function AgentDetailsMessage(Request $request)
    {

        $agent_id = $request->agent_id;

        if (Auth::check()) {

            PropertyMessage::insert([

                'user_id' => Auth::user()->id,
                'agent_id' => $agent_id,
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

    } // END AgentDetailsMessage

    public function RentProperty()
    {

        $property = Property::where('status', '1')->where('property_status', 'rent')->paginate(3);
        $rentProperty = Property::where('status', '1')->where('property_status', 'rent')->get();
        $buyProperty = Property::where('status', '1')->where('property_status', 'buy')->get();

        return view('frontend.property.rent_property', compact('property', 'rentProperty', 'buyProperty'));

    } // END RentProperty

    public function BuyProperty()
    {

        $property = Property::where('status', '1')->where('property_status', 'buy')->paginate(3);
        $rentProperty = Property::where('status', '1')->where('property_status', 'rent')->get();
        $buyProperty = Property::where('status', '1')->where('property_status', 'buy')->get();

        return view('frontend.property.buy_property', compact('property', 'rentProperty', 'buyProperty'));

    } // END BuyProperty

    public function PropertyType($id)
    {

        $property = Property::where('status', '1')->where('ptype_id', $id)->paginate(2);
        $rentProperty = Property::where('status', '1')->where('property_status', 'rent')->get();
        $buyProperty = Property::where('status', '1')->where('property_status', 'buy')->get();

        $property_read = PropertyType::where('id', $id)->first();

        return view('frontend.property.property_type', compact('property', 'rentProperty', 'buyProperty', 'property_read'));

    } // END PropertyType

    public function StateDetails($id)
    {

        $property = Property::where('status', '1')->where('state', $id)->get();
        $bstate = State::where('id', $id)->first();

        return view('frontend.property.state_property', compact('property', 'bstate'));

    } // End StateDetails

    public function BuyPropertySeach(Request $request)
    {
        $request->validate(['search' => 'required']);
        $item = $request->search;
        $sstate = $request->state;
        $stype = $request->ptype_id;
        $rentProperty = Property::where('status', '1')->where('property_status', 'rent')->get();
        $buyProperty = Property::where('status', '1')->where('property_status', 'buy')->get();

        $property = Property::where('property_name', 'like', '%' . $item . '%')->where('property_status', 'buy')->with('type', 'pstate')
            ->whereHas('pstate', function ($q) use ($sstate) {
                $q->where('state_name', 'like', '%' . $sstate . '%');
            })
            ->whereHas('type', function ($q) use ($stype) {
                $q->where('type_name', 'like', '%' . $stype . '%');
            })
            ->paginate(2);

        return view('frontend.property.property_search', compact('property', 'rentProperty', 'buyProperty'));
    } // End BuyPropertySeach

    public function RentPropertySeach(Request $request)
    {

        $request->validate(['search' => 'required']);
        $item = $request->search;
        $sstate = $request->state;
        $stype = $request->ptype_id;
        $rentProperty = Property::where('status', '1')->where('property_status', 'rent')->get();
        $buyProperty = Property::where('status', '1')->where('property_status', 'buy')->get();

        $property = Property::where('property_name', 'like', '%' . $item . '%')->where('property_status', 'rent')->with('type', 'pstate')
            ->whereHas('pstate', function ($q) use ($sstate) {
                $q->where('state_name', 'like', '%' . $sstate . '%');
            })
            ->whereHas('type', function ($q) use ($stype) {
                $q->where('type_name', 'like', '%' . $stype . '%');
            })
            ->paginate(2);

        return view('frontend.property.property_search', compact('property'));

    } // End RentPropertySeach

    public function AllPropertySeach(Request $request)
    {

        $property_status = $request->property_status;
        $stype = $request->ptype_id;
        $sstate = $request->state;
        $bedrooms = $request->bedrooms;
        $bathrooms = $request->bathrooms;
        $rentProperty = Property::where('status', '1')->where('property_status', 'rent')->get();
        $buyProperty = Property::where('status', '1')->where('property_status', 'buy')->get();

        $property = Property::where('status', '1')->where('bedrooms', $bedrooms)->where('bathrooms', 'like', '%' . $bathrooms . '%')->where('property_status', $property_status)
            ->with('type', 'pstate')
            ->whereHas('pstate', function ($q) use ($sstate) {
                $q->where('state_name', 'like', '%' . $sstate . '%');
            })
            ->whereHas('type', function ($q) use ($stype) {
                $q->where('type_name', 'like', '%' . $stype . '%');
            })
            ->paginate(2);

        return view('frontend.property.property_search', compact('property', 'rentProperty', 'buyProperty'));

    } // End AllPropertySeach

    public function StoreSchedule(Request $request)
    {
        $aid = $request->agent_id;
        $pid = $request->property_id;

        if (Auth::check()) {

            Schedule::insert([

                'user_id' => Auth::user()->id,
                'property_id' => $pid,
                'agent_id' => $aid,
                'tour_date' => $request->tour_date,
                'tour_time' => $request->tour_time,
                'message' => $request->message,
                'created_at' => Carbon::now(),
            ]);

            $notification = array(
                'message' => 'Send Request Successfully',
                'alert-type' => 'success',
            );

            return redirect()->back()->with($notification);

        } else {

            $notification = array(
                'message' => 'Plz Login Your Account First',
                'alert-type' => 'error',
            );

            return redirect()->back()->with($notification);

        }
    } // End StoreSchedule
}
