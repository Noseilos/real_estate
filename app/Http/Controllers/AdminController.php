<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

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




    // -------------------- AGENT MANAGEMENT -------------------- //




    public function AllAgent(){

        $allAgent = User::where('role', 'agent')->get();
        return view('backend.agents.all_agent', compact('allAgent'));

    }// END AllAgent





    public function AddAgent(){

        return view('backend.agents.add_agent');

    }// END AddAgent





    public function StoreAgent(Request $request){

        User::insert([

            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'password' =>Hash::make($request->password),
            'role' => 'agent',
            'status' => 'active',

        ]);

        $notif = array(
            'message' => 'Agent Entered Successfully',
            'alert-type' => 'success',
        );
        
        return redirect()->route('all.agent')->with($notif);

    }// END StoreAgent





    public function EditAgent($id){

        $allAgent = User::findOrFail($id);
        return view('backend.agents.edit_agent', compact('allAgent'));

    }// END EditAgent





    public function UpdateAgent(Request $request){

        $agent_id = $request->id;

        User::findOrFail($agent_id)->update([

            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,

        ]);

        $notif = array(
            'message' => 'Agent Updated Successfully',
            'alert-type' => 'success',
        );
        
        return redirect()->route('all.agent')->with($notif);

    }// END StoreAgent





    public function DeleteAgent($id){

        User::findOrFail($id)->delete();

        $notif = array(
            'message' => 'Agent Deleted Successfully',
            'alert-type' => 'success',
        );
        
        return redirect()->route('all.agent')->with($notif);

    }// END DeleteAgent





    public function changeStatus(Request $request){

        $user = User::find($request->user_id);
        $user->status = $request->status;
        $user->save();

        return response()->json(['success'=>'Status Changed Successfully']);

    }// END ChangeAgentStatus




    // -------------------- ADMIN MANAGEMENT -------------------- //




    public function AllAdmin(){

        $allAdmin = User::where('role', 'admin')->get();
        return view('backend.pages.admin.all_admin', compact('allAdmin'));

    }// END AllAdmin





    public function AddAdmin(){

        $roles = Role::all();

        return view('backend.pages.admin.add_admin', compact('roles'));

    }// END AddAdmin





    public function StoreAdmin(Request $request){

        $user = new User();

        $user->username = $request->username;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->password = Hash::make($request->password);
        $user->role = 'admin';
        $user->status = 'active';
        $user->save();

        if ($request->roles) {
            $user->assignRole($request->roles);
        }

        $notif = array(
            'message' => 'Admin Entered Successfully',
            'alert-type' => 'success',
        );
        
        return redirect()->route('all.admin')->with($notif);

    }// END StoreAdmin





    public function EditAdmin($id){

        $user = User::findOrFail($id);
        $roles = Role::all();

        return view('backend.pages.admin.edit_admin', compact('user', 'roles'));

    }// END EditAdmin





    public function UpdateAdmin(Request $request, $id){

        $user = User::findOrFail($id);

        $user->username = $request->username;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->role = 'admin';
        $user->status = 'active';
        $user->save();

        $user->roles()->detach();

        if ($request->roles) {
            $user->assignRole($request->roles);
        }

        $notif = array(
            'message' => 'Admin Updated Successfully',
            'alert-type' => 'success',
        );
        
        return redirect()->route('all.admin')->with($notif);

    }// END UpdateAdmin





    public function DeleteAdmin($id){

        $user = User::findOrFail($id);

        if (!is_null($user)) {
            $user->delete();
        }

        $notif = array(
            'message' => 'Admin Deleted Successfully',
            'alert-type' => 'success',
        );
        
        return redirect()->route('all.admin')->with($notif);

    }// END DeleteAdmin


}
