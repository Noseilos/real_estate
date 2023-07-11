<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Schedule;

class UserController extends Controller
{
    public function Index(){

        return view('frontend.index');
    }// End Index




    public function UserProfile(){

        $id = Auth::user()->id;
        $userData = User::find($id);

        return view('frontend.dashboard.dashboard_edit_profile', compact('userData'));
    }// End UserProfile




    public function UserProfileStore(Request $request){

        $id = Auth::user()->id;
        $data = User::find($id);

        $data->username = $request->username;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;

        if($request->file('photo')){
            $file = request()->file('photo');
            @unlink(public_path('upload/user_images/'.$data->photo));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/user_images'), $filename);
            $data['photo'] = $filename;
        }

        $data->save();

        $notif = array(
            'message' => 'User Profile Updated Successfully',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notif);
    }// End UserProfileStore




    public function UserLogout(Request $request){

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $notif = array(
            'message' => 'User Logout Successfully',
            'alert-type' => 'success',
        );

        return redirect('/login')->with($notif);
    }// End UserLogout




    public function UserChangePassword(){

        $userID = Auth::user()->id;
        $userData = User::find($userID);
        return view('frontend.dashboard.user_change_password', compact('userData'));
    }// End UserChangePassword




    public function UserPasswordUpdate(Request $request){

        $request->validate([

            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

        if(!Hash::check($request->old_password, auth::user()->password)){

            $notif = array(
                'message' => 'Old Password Does Not Match',
                'alert-type' => 'error',
            );
            
            return back()->with($notif);
        }

        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password),
        ]);

        $notif = array(
            'message' => 'Password Updated Successfully',
            'alert-type' => 'success',
        );
        
        return back()->with($notif);
    }// END UserPasswordUpdate

    public function UserScheduleRequest(){

        $id = Auth::user()->id;
        $userData = User::find($id);

        $srequest = Schedule::where('user_id',$id)->get();
        return view('frontend.message.schedule_request',compact('userData','srequest'));

    } // End Method 

}
