<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Amenities;
use App\Models\PropertyType;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;

class PropertyTypeController extends Controller
{
    public function AllPropertyType()
    {

        $types = PropertyType::latest()->get();
        return view('backend.type.all_type', compact('types'));

    } // End AllPropertyType

    public function AddPropertyType()
    {

        return view('backend.type.add_type');
    } // End AddPropertyType

    public function StorePropertyType(Request $request)
    {

        $request->validate([

            'type_name' => 'required|unique:property_types|max:200',
            'type_icon' => 'required',
        ]);

        PropertyType::insert([

            'type_name' => $request->type_name,
            'type_icon' => $request->type_icon,
        ]);

        $notif = array(
            'message' => 'Property Type Created Successfully',
            'alert-type' => 'success',
        );

        return redirect()->route('all.type')->with($notif);

    } // End StorePropertyType

    public function EditPropertyType($id)
    {

        $types = PropertyType::findOrFail($id);

        return view('backend.type.edit_type', compact('types'));
    } // End EditPropertyType

    public function UpdatePropertyType(Request $request)
    {

        $ptype_id = $request->id;

        PropertyType::findOrFail($ptype_id)->update([

            'type_name' => $request->type_name,
            'type_icon' => $request->type_icon,
        ]);

        $notif = array(
            'message' => 'Property Type Updated Successfully',
            'alert-type' => 'success',
        );

        return redirect()->route('all.type')->with($notif);
    } // End UpdatePropertyType

    public function DeletePropertyType($id)
    {

        PropertyType::findOrFail($id)->delete();

        $notif = array(
            'message' => 'Property Type Deleted Successfully',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notif);
    } // End DeletePropertyType

    // **************************** All Amenities ****************************

    public function AllAmenities()
    {

        $amenities = Amenities::latest()->get();
        return view('backend.amenities.all_amenities', compact('amenities'));

    } // End AllAmenities

    public function AddAmenities()
    {

        return view('backend.amenities.add_amenities');
    } // End AddAmenities

    public function StoreAmenities(Request $request)
    {

        $image = $request->file('amenities_image');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(370, 250)->save('upload/amenities/' . $name_gen);
        $save_url = 'upload/amenities/' . $name_gen;

        $amenities_id = Amenities::insertGetId([

            'amenities_name' => $request->amenities_name,
            'amenities_image' => $save_url,
            'created_at' => Carbon::now(),
        ]);

        $notif = array(
            'message' => 'Amenity Created Successfully',
            'alert-type' => 'success',
        );

        return redirect()->route('all.amenities')->with($notif);

    } // End StoreAmenities

    public function EditAmenities($id)
    {

        $amenities = Amenities::findOrFail($id);
        return view('backend.amenities.edit_amenities', compact('amenities'));
    } // End EditAmenities

    public function UpdateAmenities(Request $request)
    {

        $amenity_id = $request->id;
        $oldImage = $request->old_image;

        if ($request->file('amenities_image')) {

            if (file_exists($oldImage)) {
                unlink($oldImage);
            }
            
            $image = $request->file('amenities_image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(370, 275)->save('upload/amenities/' . $name_gen);
            $save_url = 'upload/amenities/' . $name_gen;

            Amenities::findOrFail($amenity_id)->update([
                'amenities_name' => $request->amenities_name,
                'amenities_image' => $save_url,
            ]);

            $notification = array(
                'message' => 'Amenities Updated with Image Successfully',
                'alert-type' => 'success',
            );

            return redirect()->route('all.amenities')->with($notification);

        } else {

            Amenities::findOrFail($amenity_id)->update([
                'amenities_name' => $request->amenities_name,
            ]);

            $notification = array(
                'message' => 'Amenities Updated without Image Successfully',
                'alert-type' => 'success',
            );

            return redirect()->route('all.amenities')->with($notification);

        }
    } // End UpdateAmenities

    public function DeleteAmenities($id)
    {

        Amenities::findOrFail($id)->delete();

        $notif = array(
            'message' => 'Amenity Deleted Successfully',
            'alert-type' => 'success',
        );

        return redirect()->route('all.amenities')->with($notif);
    } // End DeleteAmenities

}
