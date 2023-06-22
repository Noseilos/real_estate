<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\MultiImage;
use App\Models\Facility;
use App\Models\Amenities;
use App\Models\PropertyType;
use App\Models\User;
use Intervention\Image\Facades\Image;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use DB;

class AgentPropertyController extends Controller
{
    public function AllAgentProperty(){

        $id = Auth::user()->id;
        $property = Property::where('agent_id', $id)->latest()->get();
        return view('agent.property.all_property', compact('property'));

    }// End AllProperty




    public function AddAgentProperty(){

        $propertyType = PropertyType::latest()->get();
        $amenities = Amenities::latest()->get();
        return view('agent.property.add_property', compact('propertyType','amenities'));

    }// End AddProperty




    public function StoreAgentProperty(Request $request){

        $id = Auth::user()->id;
        $uid = User::findOrFail($id);
        $nid = $uid->credit;

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
            'agent_id' => Auth::user()->id,
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

        // END Facilities

        User::where('id', $id)->update([

            'credit' => DB::raw('1 +'.$nid),

        ]);

        $notif = array(
            'message' => 'Property Inserted Successfully',
            'alert-type' => 'success',
        );

        return redirect()->route('agent.all.property')->with($notif);


    }// End StoreProperty




    public function EditAgentProperty($id){

        $facilities = Facility::where('property_id', $id)->get();
        $property = Property::findOrFail($id);
        $propertyType = PropertyType::latest()->get();
        $amenities = Amenities::latest()->get();

        $multiImage = MultiImage::where('property_id',$id)->get();

        $amen = $property->amenities_id;
        $property_amenities = explode(',', $amen);

        return view('agent.property.edit_property', compact('property', 'propertyType', 'amenities', 'property_amenities', 'multiImage', 'facilities'));

    }// End EditProperty




    public function UpdateAgentProperty(Request $request){

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
            'agent_id' => Auth::user()->id,
            'updated_at' => Carbon::now(),

        ]);

        $notif = array(
            'message' => 'Property Updated Successfully',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notif);

    }// End UpdateProperty




    

    public function AgentUpdatePropertyThumbnail(Request $request){

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

    }// End AgentUpdatePropertyThumbnail 




    

    public function AgentUpdatePropertyMultiImage(Request $request){

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
    }// End AgentUpdatePropertyMultiImage
    
    




    public function AgentDeletePropertyMultiImage($id){

        $old_image = MultiImage::findOrFail($id);
        unlink($old_image->photo_name);

        MultiImage::findOrFail($id)->delete();

        $notif = array(
            'message' => 'Property Multiple Image Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notif); 

    }// End AgentDeletePropertyMultiImage 




    public function AgentStoreNewMultiImage(Request $request){

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
        
    }// End AgentStoreNewMultiImage




    public function AgentUpdatePropertyFacilities(Request $request){

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
        
    }// End AgentUpdatePropertyFacilities





    public function AgentDetailsProperty($id){

        $facilities = Facility::where('property_id', $id)->get();
        $property = Property::findOrFail($id);
        $propertyType = PropertyType::latest()->get();
        $amenities = Amenities::latest()->get();

        $multiImage = MultiImage::where('property_id',$id)->get();

        $amen = $property->amenities_id;
        $property_amenities = explode(',', $amen);

        return view('agent.property.details_property', compact('property', 'propertyType', 'amenities','property_amenities', 'multiImage', 'facilities'));
        
    }// End AgentDetailsProperty




    public function AgentDeleteProperty($id){

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

    }// End AgentDeleteProperty






    public function BuyPackage(){


        return view('agent.package.buy_package');

    }// END AgentPropertyController

}
