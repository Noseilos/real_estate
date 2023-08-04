<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\MultiImageState;
use App\Models\State;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class StateController extends Controller
{
    public function AllState()
    {

        $state = State::latest()->get();
        return view('backend.state.all_state', compact('state'));

    } // End AllState

    public function AddState()
    {
        return view('backend.state.add_state');
    } // End Method

    public function StoreState(Request $request)
    {

        $image = $request->file('state_image');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(370, 275)->save('upload/state/' . $name_gen);
        $save_url = 'upload/state/' . $name_gen;

        $state_id = State::insertGetId([
            'state_name' => $request->state_name,
            'state_image' => $save_url,
        ]);

        /// Multiple Image Upload From Here ////

        $images = $request->file('multi_images');
        foreach ($images as $img) {

            $make_name = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();
            Image::make($img)->resize(770, 520)->save('upload/state/multi-image-state/' . $make_name);
            $uploadPath = 'upload/state/multi-image-state/' . $make_name;

            MultiImageState::insert([

                'state_id' => $state_id,
                'photo_name' => $uploadPath,
                'created_at' => Carbon::now(),

            ]);
        } // End Foreach

        /// End Multiple Image Upload From Here ////

        $notification = array(
            'message' => 'State Inserted Successfully',
            'alert-type' => 'success',
        );

        return redirect()->route('all.state')->with($notification);

    } // End Method

    public function EditState($id)
    {

        $state = State::findOrFail($id);
        $multiImage = MultiImageState::where('state_id', $id)->get();
        return view('backend.state.edit_state', compact('state', 'multiImage'));

    } // End Method

    public function UpdateState(Request $request)
    {

        $state_id = $request->id;

        if ($request->file('state_image')) {
            $image = $request->file('state_image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(370, 275)->save('upload/state/' . $name_gen);
            $save_url = 'upload/state/' . $name_gen;

            State::findOrFail($state_id)->update([
                'state_name' => $request->state_name,
                'state_image' => $save_url,
            ]);

            $notification = array(
                'message' => 'State Updated with Image Successfully',
                'alert-type' => 'success',
            );

            return redirect()->route('all.state')->with($notification);

        } else {

            State::findOrFail($state_id)->update([
                'state_name' => $request->state_name,
            ]);

            $notification = array(
                'message' => 'State Updated without Image Successfully',
                'alert-type' => 'success',
            );

            return redirect()->route('all.state')->with($notification);

        }

    } // End Method

    public function StoreNewMultiImageState(Request $request)
    {

        $new_multi = $request->imageId;
        $image = $request->file('multi_image');

        $make_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(770, 520)->save('upload/state/multi-image-state/' . $make_name);
        $uploadPath = 'upload/state/multi-image-state/' . $make_name;

        MultiImageState::insert([

            'state_id' => $new_multi,
            'photo_name' => $uploadPath,
            'created_at' => Carbon::now(),

        ]);

        $notif = array(
            'message' => 'State Multiple Image Added Successfully',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notif);

    } // End StoreNewMultiImage

    public function UpdateStateMultiImage(Request $request)
    {

        $images = $request->multi_image;

        foreach ($images as $id => $img) {
            $imgDelete = MultiImageState::findOrFail($id);
            unlink($imgDelete->photo_name);

            $make_name = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();
            Image::make($img)->resize(770, 520)->save('upload/state/multi-image-state/' . $make_name);
            $uploadPath = 'upload/state/multi-image-state/' . $make_name;

            MultiImageState::where('id', $id)->update([

                'photo_name' => $uploadPath,
                'updated_at' => Carbon::now(),

            ]);

        } // End Foreach

        $notif = array(
            'message' => 'State Multiple Image Updated Successfully',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notif);
    } // End Method

    public function DeleteStateMulti($id)
    {

        $old_image = MultiImageState::findOrFail($id);
        unlink($old_image->photo_name);

        MultiImageState::findOrFail($id)->delete();

        $notif = array(
            'message' => 'State Multiple Image Deleted Successfully',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notif);

    } // End Method

    public function DeleteState($id)
    {

        $state = State::findOrFail($id);
        $img = $state->state_image;
        unlink($img);

        State::findOrFail($id)->delete();

        $multi_image = MultiImageState::where('state_id', $id)->get();

        foreach ($multi_image as $image) {
            
            unlink($image->photo_name);
            MultiImageState::where('state_id', $id)->delete();
        }

        $notification = array(
            'message' => 'State Deleted Successfully',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);

    } // End Method

}
