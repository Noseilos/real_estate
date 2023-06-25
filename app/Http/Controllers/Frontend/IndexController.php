<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\MultiImage;
use App\Models\Facility;
use App\Models\Amenities;
use App\Models\PropertyType;
use App\Models\User;
use App\Models\PackagePlan;

class IndexController extends Controller
{
    public function PropertyDetails($id, $slug){

        $property = Property::findOrFail($id);

        $amenities = Amenities::latest()->get();
        $amenity_ids = explode(',', $property->amenities_id);
        $property_amenities = $amenities->whereIn('id', $amenity_ids);

        $multiImage = MultiImage::where('property_id', $id)->get();
        return view('frontend.property.property_details', compact('property', 'multiImage', 'property_amenities'));

    }// END PropertyDetails






}
