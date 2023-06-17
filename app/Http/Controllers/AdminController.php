<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function AdminDashboard(){
        
        return view('admin.index');
    } // END AdminDashboard





    public function AdminLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $notif = array(
            'message' => 'Admin Logout Successfully',
            'alert-type' => 'success',
        );

        return redirect()->route('admin.login')->with($notif);

    } // END AdminLogout





    public function AdminLogin(){

        return view('admin.admin_login');
    }// END AdminLogin




    public function AdminProfile(){

        $adminID = Auth::user()->id;
        $profileData = User::find($adminID);
        return view('admin.admin_profile', compact('profileData'));

    }// END AdminProfile




    public function AdminProfileStore(Request $request){

        $id = Auth::user()->id;
        $data = User::find($id);

        $data->username = $request->username;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;

        if($request->file('photo')){
            $file = request()->file('photo');
            @unlink(public_path('upload/admin_images/'.$data->photo));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'), $filename);
            $data['photo'] = $filename;
        }

        $data->save();

        $notif = array(
            'message' => 'Admin Profile Updated Successfully',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notif);
    }// END AdminProfileStore




    public function AdminChangePassword(){

        $adminID = Auth::user()->id;
        $profileData = User::find($adminID);
        return view('admin.admin_change_password', compact('profileData'));
    }// END AdminChangePassword




    public function AdminUpdatePassword(Request $request){

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
    }// END AdminUpdatePassword
}
