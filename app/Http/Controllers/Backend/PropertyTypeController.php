<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Amenities;
use App\Models\MultiImageAmenities;
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

        $amenity_id = Amenities::insertGetId([

            'amenities_name' => $request->amenities_name,
            'short_desc' => $request->short_desc,
            'long_desc' => $request->long_desc,
            'amenities_image' => $save_url,
            'created_at' => Carbon::now(),
        ]);

        /// Multiple Image Upload From Here ////

        $images = $request->file('multi_images');
        foreach ($images as $img) {

            $make_name = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();
            Image::make($img)->resize(770, 520)->save('upload/amenities/multi-image-amenities/' . $make_name);
            $uploadPath = 'upload/amenities/multi-image-amenities/' . $make_name;

            MultiImageAmenities::insert([

                'amenity_id' => $amenity_id,
                'photo_name' => $uploadPath,
                'created_at' => Carbon::now(),

            ]);
        } // End Foreach

        $notif = array(
            'message' => 'Amenity Created Successfully',
            'alert-type' => 'success',
        );

        return redirect()->route('all.amenities')->with($notif);

    } // End StoreAmenities

    public function EditAmenities($id)
    {

        $amenities = Amenities::findOrFail($id);
        $multiImage = MultiImageAmenities::where('amenity_id', $id)->get();
        return view('backend.amenities.edit_amenities', compact('amenities', 'multiImage'));
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
                'short_desc' => $request->short_desc,
                'long_desc' => $request->long_desc,
                'amenities_image' => $save_url,
                'updated_at' => Carbon::now(),
            ]);

            $notification = array(
                'message' => 'Amenities Updated with Image Successfully',
                'alert-type' => 'success',
            );

            return redirect()->route('all.amenities')->with($notification);

        } else {

            Amenities::findOrFail($amenity_id)->update([
                'amenities_name' => $request->amenities_name,
                'short_desc' => $request->short_desc,
                'long_desc' => $request->long_desc,
                'updated_at' => Carbon::now(),
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

        $amenities = Amenities::findOrFail($id);
        unlink($amenities->amenities_image);

        Amenities::findOrFail($id)->delete();

        $multi_image = MultiImageAmenities::where('amenity_id', $id)->get();

        foreach ($multi_image as $image) {
            
            unlink($image->photo_name);
            MultiImageAmenities::where('amenity_id', $id)->delete();
        }

        $notif = array(
            'message' => 'Amenity Deleted Successfully',
            'alert-type' => 'success',
        );

        return redirect()->route('all.amenities')->with($notif);
    } // End DeleteAmenities

    public function StoreNewMultiImageAmenity(Request $request)
    {

        $new_multi = $request->imageId;
        $image = $request->file('multi_image');

        $make_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(770, 520)->save('upload/amenities/multi-image-amenities/' . $make_name);
        $uploadPath = 'upload/amenities/multi-image-amenities/' . $make_name;

        MultiImageAmenities::insert([

            'amenity_id' => $new_multi,
            'photo_name' => $uploadPath,
            'created_at' => Carbon::now(),

        ]);

        $notif = array(
            'message' => 'Amenity Multiple Image Added Successfully',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notif);

    } // End StoreNewMultiImage

    public function UpdateAmenityMultiImage(Request $request)
    {

        $images = $request->multi_image;

        foreach ($images as $id => $img) {
            $imgDelete = MultiImageAmenities::findOrFail($id);
            unlink($imgDelete->photo_name);

            $make_name = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();
            Image::make($img)->resize(770, 520)->save('upload/amenities/multi-image-amenities/' . $make_name);
            $uploadPath = 'upload/amenities/multi-image-amenities/' . $make_name;

            MultiImageAmenities::where('id', $id)->update([

                'photo_name' => $uploadPath,
                'updated_at' => Carbon::now(),

            ]);

        } // End Foreach

        $notif = array(
            'message' => 'Amenity Multiple Image Updated Successfully',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notif);
    } // End Method

    public function DeleteAmenityMulti($id)
    {

        $old_image = MultiImageAmenities::findOrFail($id);
        unlink($old_image->photo_name);

        MultiImageAmenities::findOrFail($id)->delete();

        $notif = array(
            'message' => 'Amenity Multiple Image Deleted Successfully',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notif);

    } // End Method

    public function AmenityList()
    {

        $amenities = Amenities::latest()->get();
        return view('frontend.amenities.amenities_list', compact('amenities'));

    } // End Method

    public function AmenityDetails($id)
    {

        // $blog = BlogPost::where('post_slug', $slug)->first();

        // $tags = $blog->post_tags;
        // $tags_all = explode(',', $tags);

        // $bcategory = BlogCategory::latest()->get();
        // $dpost = BlogPost::latest()->limit(3)->get();
        $amenities = Amenities::where('id', $id)->first();
        $multiImage = MultiImageAmenities::where('amenity_id', $id)->get();

        return view('frontend.amenities.amenities_details', compact('amenities', 'multiImage'));

    } // End Method

}
