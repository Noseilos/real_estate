<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\MultiImage;
use App\Models\Facility;
use App\Models\Amenities;
use App\Models\PropertyType;
use App\Models\User;
use Intervention\Image\Facades\Image;

class PropertyController extends Controller
{
    public function AllProperty(){

        $property = Property::latest()->get();
        return view('backend.property.all_property', compact('property'));

    }// End AllProperty




    public function AddProperty(){

        $propertyType = PropertyType::latest()->get();
        $amenities = Amenities::latest()->get();
        $activeAgent = User::where('status','active')->where('role','agent')->latest()->get();
        return view('backend.property.add_property', compact('propertyType','amenities','activeAgent'));

    }// End AddProperty




    public function StoreProperty(Request $request){

        $amen = $request->amenities_id;
        $amenites = implode(",", $amen);

        $image = $request->file('property_thumbnail');
        $name_generate = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(370,250)->save('upload/property/thumbnail/'.$name_generate);
        $save_url = 'upload/property/thumbnail'.$name_generate;

        $property_id = Property::insertGetId([

            'ptype_id' => $request->ptype_id,
            'amenities_id' => $amenites,
            'property_name' => $request->property_name,
            'property_slug' => strtolower(str_replace(' ', '-', $request->property_name)),
            'property_code' => $pcode,
            'property_status' => $request->property_status,

            'lowest_price' => $request->lowest_price,
            'max_price' => $request->max_price,
            'short_descp' => $request->short_descp,
            'long_descp' => $request->long_descp,
            'bedrooms' => $request->bedrooms,
            'bathrooms' => $request->bathrooms,
            'garage' => $request->garage,
            'garage_size' => $request->garage_size,

            'property_size' => $request->property_size,
            'property_video' => $request->property_video,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'postal_code' => $request->postal_code,

            'neighborhood' => $request->neighborhood,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'featured' => $request->featured,
            'hot' => $request->hot,
            'agent_id' => $request->agent_id,
            'status' => 1,
            'property_thambnail' => $save_url,
            'created_at' => Carbon::now(),

        ]);

    }// End StoreProperty
}
