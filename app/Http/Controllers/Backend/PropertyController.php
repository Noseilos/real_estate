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
use App\Models\PackagePlan;
use App\Models\PropertyMessage;
use App\Models\State;

use Intervention\Image\Facades\Image;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class PropertyController extends Controller
{
    public function AllProperty(){

        $property = Property::latest()->get();
        return view('backend.property.all_property', compact('property'));

    }// End AllProperty




    public function AddProperty(){

        $propertyType = PropertyType::latest()->get();
        $pstate = State::latest()->get();
        $amenities = Amenities::latest()->get();
        $activeAgent = User::where('status','active')->where('role','agent')->latest()->get();
        return view('backend.property.add_property',compact('propertyType','amenities','activeAgent','pstate'));

    }// End AddProperty




    public function StoreProperty(Request $request){

        $amen = $request->amenities_id;
        $amenities = implode(",", $amen);

        $pcode = IdGenerator::generate(['table' => 'properties','field' => 'property_code','length' => 5, 'prefix' => 'PC' ]);

        $image = $request->file('property_thumbnail');
        $name_generate = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(370,250)->save('upload/property/thumbnail/'.$name_generate);
        $save_url = 'upload/property/thumbnail/'.$name_generate;

        $property_id = Property::insertGetId([

            'ptype_id' => $request->ptype_id,
            'amenities_id' => $amenities,
            'property_name' => $request->property_name,
            'property_slug' => strtolower(str_replace(' ', '-', $request->property_name)),
            'property_code' => $pcode,
            'property_status' => $request->property_status,

            'lowest_price' => $request->lowest_price,
            'max_price' => $request->max_price,
            'short_desc' => $request->short_desc,
            'long_desc' => $request->long_desc,
            'bedrooms' => $request->bedrooms,
            'bathrooms' => $request->bathrooms,
            'garage' => $request->garage,
            'garage_size' => $request->garage_size,

            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'postal_code' => $request->postal_code,
            
            'property_size' => $request->property_size,
            'property_video' => $request->property_video,
            'neighborhood' => $request->neighborhood,

            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'featured' => $request->featured,
            'hot' => $request->hot,
            'agent_id' => $request->agent_id,
            'status' => 1,
            'property_thumbnail' => $save_url,
            'created_at' => Carbon::now(),
            //Carbon means present date

        ]);

        /// Multiple Image Upload From Here ////

        $images = $request->file('multi_images');
        foreach($images as $img){

            $make_name = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
            Image::make($img)->resize(770,520)->save('upload/property/multi-image/'.$make_name);
            $uploadPath = 'upload/property/multi-image/'.$make_name;

            MultiImage::insert([

                'property_id' => $property_id,
                'photo_name' => $uploadPath,
                'created_at' => Carbon::now(), 

            ]); 
        } // End Foreach

         /// End Multiple Image Upload From Here ////


        //  START Facilities

        $facilities = Count($request->facility_name);

        if ($facilities != NULL) {
            
            for ($i=0; $i < $facilities; $i++) { 
                
                $fcount = new Facility();
                $fcount->property_id = $property_id;
                $fcount->facility_name = $request->facility_name[$i];
                $fcount->distance = $request->distance[$i];
                $fcount->save();
            }
        }

        $notif = array(
            'message' => 'Property Inserted Successfully',
            'alert-type' => 'success',
        );

        return redirect()->route('all.property')->with($notif);

        // END Facilities

    }// End StoreProperty




    public function EditProperty($id){

        $facilities = Facility::where('property_id', $id)->get();
        $property = Property::findOrFail($id);
        $propertyType = PropertyType::latest()->get();
        $amenities = Amenities::latest()->get();
        $activeAgent = User::where('status','active')->where('role','agent')->latest()->get();

        $multiImage = MultiImage::where('property_id',$id)->get();

        $pstate = State::latest()->get();
        $amen = $property->amenities_id;
        $property_amenities = explode(',', $amen);

        return view('backend.property.edit_property',compact('property','propertyType','amenities','activeAgent','property_amenities','multiImage','facilities','pstate'));

    }// End EditProperty




    public function UpdateProperty(Request $request){

        $property_id = $request->id;
        $amen = $request->amenities_id;
        $amenities = implode(",", $amen);

        Property::findOrFail($property_id)->update([

            'ptype_id' => $request->ptype_id,
            'amenities_id' => $amenities,
            'property_name' => $request->property_name,
            'property_slug' => strtolower(str_replace(' ', '-', $request->property_name)),
            'property_status' => $request->property_status,

            'lowest_price' => $request->lowest_price,
            'max_price' => $request->max_price,
            'short_desc' => $request->short_desc,
            'long_desc' => $request->long_desc,
            'bedrooms' => $request->bedrooms,
            'bathrooms' => $request->bathrooms,
            'garage' => $request->garage,
            'garage_size' => $request->garage_size,

            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'postal_code' => $request->postal_code,
            
            'property_size' => $request->property_size,
            'property_video' => $request->property_video,
            'neighborhood' => $request->neighborhood,

            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'featured' => $request->featured,
            'hot' => $request->hot,
            'agent_id' => $request->agent_id,
            'updated_at' => Carbon::now(),

        ]);

        $notif = array(
            'message' => 'Property Updated Successfully',
            'alert-type' => 'success',
        );

        return redirect()->route('all.property')->with($notif);

    }// End UpdateProperty






    public function UpdatePropertyThumbnail(Request $request){

        $property_id = $request->id;
        $oldImage = $request->old_image;

        $image = $request->file('property_thumbnail');
        $name_generate = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(370,250)->save('upload/property/thumbnail/'.$name_generate);
        $save_url = 'upload/property/thumbnail/'.$name_generate;

        if (file_exists($oldImage)) {
            unlink($oldImage);
        }

        Property::findOrFail($property_id)->update([

            'property_thumbnail' => $save_url,
            'updated_at' => Carbon::now(), 
        ]);

        $notif = array(
            'message' => 'Property Image Thumbnail Updated Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notif); 

    }// End Method 




    

    public function UpdatePropertyMultiImage(Request $request){

        $images = $request->multi_image;

        foreach($images as $id => $img){
            $imgDelete = MultiImage::findOrFail($id);
            unlink($imgDelete->photo_name);

        $make_name = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
        Image::make($img)->resize(770,520)->save('upload/property/multi-image/'.$make_name);
        $uploadPath = 'upload/property/multi-image/'.$make_name;

        MultiImage::where('id',$id)->update([

            'photo_name' => $uploadPath,
            'updated_at' => Carbon::now(),

        ]);

        } // End Foreach 

        $notif = array(
            'message' => 'Property Multiple Image Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notif); 
    }// End Method 

    public function DeletePropertyMultiImage($id){

        $old_image = MultiImage::findOrFail($id);
        unlink($old_image->photo_name);

        MultiImage::findOrFail($id)->delete();

        $notif = array(
            'message' => 'Property Multiple Image Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notif); 

    }// End Method 




    public function StoreNewMultiImage(Request $request){

        $new_multi = $request->imageId;
        $image = $request->file('multi_image');

        $make_name = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(770,520)->save('upload/property/multi-image/'.$make_name);
        $uploadPath = 'upload/property/multi-image/'.$make_name;

        MultiImage::insert([

            'property_id' => $new_multi,
            'photo_name' => $uploadPath,
            'created_at' => Carbon::now(),

        ]);

        $notif = array(
            'message' => 'Property Multiple Image Added Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notif); 
        
    }// End StoreNewMultiImage




    public function UpdatePropertyFacilities(Request $request){

        $propertyId = $request->id;

        if ($request->facility_name == NULL) {
            return redirect()->back();

        }else {

            Facility::where('property_id', $propertyId)->delete();

            $facilities = Count($request->facility_name);

            if ($facilities != NULL) {
                
                for ($i=0; $i < $facilities; $i++) { 
                    
                    $fcount = new Facility();
                    $fcount->property_id = $propertyId;
                    $fcount->facility_name = $request->facility_name[$i];
                    $fcount->distance = $request->distance[$i];
                    $fcount->save();
                }
            }
        }

        $notif = array(
            'message' => 'Property Facilities Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notif); 
        
    }// End UpdatePropertyFacilities




    public function DeleteProperty($id){

        $property = Property::findOrFail($id);
        unlink($property->property_thumbnail);

        Property::findOrFail($id)->delete();

        $multi_image = MultiImage::where('property_id', $id)->get();

        foreach ($multi_image as $image) {
            
            unlink($image->photo_name);
            MultiImage::where('property_id', $id)->delete();
        }

        $facilities = Facility::where('property_id', $id)->get();

        foreach ($facilities as $landmark) {
            $landmark->facility_name;
            Facility::where('property_id', $id)->delete();

        }

        $notif = array(
            'message' => 'Property Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notif); 

    }// End DeleteProperty





    public function DetailsProperty($id){

        $facilities = Facility::where('property_id', $id)->get();
        $property = Property::findOrFail($id);
        $propertyType = PropertyType::latest()->get();
        $amenities = Amenities::latest()->get();
        $activeAgent = User::where('status','active')->where('role','agent')->latest()->get();

        $multiImage = MultiImage::where('property_id',$id)->get();

        $amen = $property->amenities_id;
        $property_amenities = explode(',', $amen);

        return view('backend.property.details_property', compact('property', 'propertyType', 'amenities', 'activeAgent', 'property_amenities', 'multiImage', 'facilities'));
        
    }// End DetailsProperty





    public function InactiveProperty(Request $request){

        $property_id = $request->id;

        Property::findOrFail($property_id)->update([

            'status' => 0,
        ]);


        $notif = array(
            'message' => 'Property Deactivated Successfully',
            'alert-type' => 'success',
        );
        
        return redirect()->route('all.property')->with($notif);
        
    }// End InactiveProperty





    public function ActiveProperty(Request $request){

        $property_id = $request->id;

        Property::findOrFail($property_id)->update([

            'status' => 1,
        ]);


        $notif = array(
            'message' => 'Property Activated Successfully',
            'alert-type' => 'success',
        );
        
        return redirect()->route('all.property')->with($notif);
        
    }// End InactiveProperty

    public function AdminPackageHistory(){

        $packageHistory = PackagePlan::latest()->get();
        return view('backend.package.package_history',compact('packageHistory'));
        
        
    }// End AdminPackageHistory

    public function PackageInvoice($id){

        $packageHistory = PackagePlan::where('id',$id)->first();

        $pdf = Pdf::loadView('backend.package.package_history_invoice', compact('packageHistory'))->setPaper('a4')->setOption([
            'tempDir' => public_path(),
            'chroot' => public_path(),
        ]);
        return $pdf->download('invoice.pdf');

    }// End PackageInvoice

    public function AdminPropertyMessage(){

        $user_message = PropertyMessage::latest()->get();
        return view('backend.message.all_message',compact('user_message'));

    }// End AdminPropertyMessage
}
