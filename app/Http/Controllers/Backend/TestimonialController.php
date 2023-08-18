<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PropertyType;
use App\Models\Testimonial;
use App\Models\MultiImageTestimonial;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;
use App\Imports\TestimonialImport;
use Maatwebsite\Excel\Facades\Excel;

class TestimonialController extends Controller
{
    public function AllTestimonials()
    {

        $testimonial = Testimonial::latest()->get();
        return view('backend.testimonial.all_testimonial', compact('testimonial'));

    } // End Method 

    public function AddTestimonials()
    {
        return view('backend.testimonial.add_testimonial');
    } // End Method 


    public function StoreTestimonials(Request $request)
    {

        $image = $request->file('image');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(100, 100)->save('upload/testimonial/' . $name_gen);
        $save_url = 'upload/testimonial/' . $name_gen;

        $testimonial_id = Testimonial::insertGetId([
            'name' => $request->name,
            'position' => $request->position,
            'message' => $request->message,
            'image' => $save_url,
        ]);

        // Testimonial::insert([
        //     'name' => $request->name,
        //     'position' => $request->position,
        //     'message' => $request->message,
        //     'image' => $save_url,
        // ]);

        /// Multiple Image Upload From Here ////

        $images = $request->file('multi_images');
        foreach ($images as $img) {

            $make_name = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();
            Image::make($img)->resize(770, 520)->save('upload/testimonial/multi-image-testimonial/' . $make_name);
            $uploadPath = 'upload/testimonial/multi-image-testimonial/' . $make_name;

            MultiImageTestimonial::insert([

                'testimonial_id' => $testimonial_id,
                'photo_name' => $uploadPath,
                'created_at' => Carbon::now(),

            ]);
        } // End Foreach

        /// End Multiple Image Upload From Here ////



        $notification = array(
            'message' => 'Testimonial Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.testimonials')->with($notification);

    } // End Method 

    public function EditTestimonials($id)
    {

        $testimonial = Testimonial::findOrFail($id);
        $multiImage = MultiImageTestimonial::where('testimonial_id', $id)->get();
        return view('backend.testimonial.edit_testimonial', compact('testimonial', 'multiImage'));

    } // End Method 


    public function UpdateTestimonials(Request $request)
    {

        $test_id = $request->id;

        if ($request->file('image')) {

            $image = $request->file('image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(100, 100)->save('upload/testimonial/' . $name_gen);
            $save_url = 'upload/testimonial/' . $name_gen;

            Testimonial::findOrFail($test_id)->update([
                'name' => $request->name,
                'position' => $request->position,
                'message' => $request->message,
                'image' => $save_url,
            ]);

            $notification = array(
                'message' => 'Testimonial Updated Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('all.testimonials')->with($notification);

        } else {

            Testimonial::findOrFail($test_id)->update([
                'name' => $request->name,
                'position' => $request->position,
                'message' => $request->message,
            ]);

            $notification = array(
                'message' => 'Testimonial Updated Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('all.testimonials')->with($notification);

        }

    } // End Method 


    public function DeleteTestimonials($id)
    {

        $test = Testimonial::findOrFail($id);
        $img = $test->image;
        unlink($img);

        Testimonial::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Testimonial Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    } // End Method

    public function StoreNewMultiImageTestimonial (Request $request)
    {

        $new_multi = $request->imageId;
        $image = $request->file('multi_image');

        $make_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(770, 520)->save('upload/testimonial/multi-image-testimonial/' . $make_name);
        $uploadPath = 'upload/testimonial/multi-image-testimonial/' . $make_name;

        MultiImageTestimonial::insert([

            'testimonial_id' => $new_multi,
            'photo_name' => $uploadPath,
            'created_at' => Carbon::now(),

        ]);

        $notif = array(
            'message' => 'Testimonial Multiple Image Added Successfully',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notif);

    } // End StoreNewMultiImage

    public function UpdateTestimonialMultiImage (Request $request)
    {

        $images = $request->multi_image;

        foreach ($images as $id => $img) {
            $imgDelete = MultiImageTestimonial::findOrFail($id);
            unlink($imgDelete->photo_name);

            $make_name = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();
            Image::make($img)->resize(770, 520)->save('upload/testimonial/multi-image-testimonial/' . $make_name);
            $uploadPath = 'upload/testimonial/multi-image-testimonial/' . $make_name;

            MultiImageTestimonial::where('id', $id)->update([

                'photo_name' => $uploadPath,
                'updated_at' => Carbon::now(),

            ]);

        } // End Foreach

        $notif = array(
            'message' => 'Testimonial Multiple Image Updated Successfully',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notif);
    } // End Method

    public function DeleteTestimonialMultiImage($id)
    {

        $old_image = MultiImageTestimonial::findOrFail($id);
        unlink($old_image->photo_name);

        MultiImageTestimonial::findOrFail($id)->delete();

        $notif = array(
            'message' => 'Testimonial Multiple Image Deleted Successfully',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notif);

    } // End Method

    public function TestimonialList()
    {

        $testimonial = Testimonial::latest()->get();
        return view('frontend.testimonials.testimonial_list', compact('testimonial'));

    } // End Method

    public function TestimonialDetails($id)
    {

        $testimonial = Testimonial::where('id', $id)->first();
        $multiImage = MultiImageTestimonial::where('testimonial_id', $id)->get();

        return view('frontend.testimonials.testimonial_details', compact('testimonial', 'multiImage'));

    } // End Method

    public function ImportTestimonial(){

        return view('backend.testimonial.import_testimonial');

    }// End Method 

    public function TestimonialImport(Request $request){

        Excel::import(new TestimonialImport, $request->file('import_file'));

        $notif = array(
        'message' => 'Testimonial Imported Successfully',
        'alert-type' => 'success'
    );

    return redirect()->back()->with($notif);

    }
}