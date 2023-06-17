<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PropertyType;
use App\Models\Amenities;

class PropertyTypeController extends Controller
{
    public function AllPropertyType(){

        $types = PropertyType::latest()->get();
        return view('backend.type.all_type', compact('types'));
        
    }// End AllPropertyType




    public function AddPropertyType(){

        return view('backend.type.add_type');
    }// End AddPropertyType




    public function StorePropertyType(Request $request){

        $request->validate([

            'type_name' => 'required|unique:property_types|max:200',
            'type_icon' => 'required',
        ]);

        PropertyType::insert([

            'type_name' => $request->type_name,
            'type_icon' => $request->type_icon
        ]);

        $notif = array(
            'message' => 'Property Type Created Successfully',
            'alert-type' => 'success',
        );
        
        return redirect()->route('all.type')->with($notif);

    }// End StorePropertyType




    public function EditPropertyType($id){

        $types = PropertyType::findOrFail($id);

        return view('backend.type.edit_type', compact('types'));
    }// End EditPropertyType




    public function UpdatePropertyType(Request $request){

        $ptype_id = $request->id;


        PropertyType::findOrFail($ptype_id)->update([

            'type_name' => $request->type_name,
            'type_icon' => $request->type_icon
        ]);

        $notif = array(
            'message' => 'Property Type Updated Successfully',
            'alert-type' => 'success',
        );
        
        return redirect()->route('all.type')->with($notif);
    }// End UpdatePropertyType




    public function DeletePropertyType($id){

        PropertyType::findOrFail($id)->delete();

        $notif = array(
            'message' => 'Property Type Deleted Successfully',
            'alert-type' => 'success',
        );
        
        return redirect()->back()->with($notif);
    }// End DeletePropertyType



    // **************************** All Amenities ****************************

    




    public function AllAmenities(){

        $amenities = Amenities::latest()->get();
        return view('backend.amenities.all_amenities', compact('amenities'));

    }// End AllAmenities




    public function AddAmenities(){
        
        return view('backend.amenities.add_amenities');
    }// End AddAmenities




    public function StoreAmenities(Request $request){

        Amenities::insert([

            'amenities_name' => $request->amenities_name,
        ]);

        $notif = array(
            'message' => 'Amenity Created Successfully',
            'alert-type' => 'success',
        );
        
        return redirect()->route('all.amenities')->with($notif);

    }// End StoreAmenities




    public function EditAmenities($id){

        $amenities = Amenities::findOrFail($id);
        return view('backend.amenities.edit_amenities', compact('amenities'));
    }// End EditAmenities




    public function UpdateAmenities(Request $request){
        
        $amenity_id = $request->id;


        Amenities::findOrFail($amenity_id)->update([

            'amenities_name' => $request->amenities_name,
        ]);

        $notif = array(
            'message' => 'Amenity Updated Successfully',
            'alert-type' => 'success',
        );
        
        return redirect()->route('all.amenities')->with($notif);
    }// End UpdateAmenities




    public function DeleteAmenities($id){

        Amenities::findOrFail($id)->delete();

        $notif = array(
            'message' => 'Amenity Deleted Successfully',
            'alert-type' => 'success',
        );
        
        return redirect()->route('all.amenities')->with($notif);
    }// End DeleteAmenities

}
