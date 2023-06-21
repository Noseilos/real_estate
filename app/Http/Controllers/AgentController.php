<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;

class AgentController extends Controller
{
    public function AgentDashboard(){
        
        return view('agent.index');

    } // END AgentDashboard





    public function AgentLogin(){

        return view('agent.agent_login');
    }// END AgentLogin





    public function AgentRegister(Request $request){

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role' => 'agent',
            'status' => 'inactive',
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::AGENT);

    }// END AgentRegister





    public function AgentLogout(Request $request){

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $notif = array(
            'message' => 'Agent Logout Successfully',
            'alert-type' => 'success',
        );

        return redirect()->route('agent.login')->with($notif);

    }// END AgentLogout




    public function AgentProfile(){

        $agentID = Auth::user()->id;
        $profileData = User::find($agentID);
        return view('agent.agent_profile', compact('profileData'));

    }// END AgentProfile





    public function AgentProfileStore(Request $request){

        $id = Auth::user()->id;
        $data = User::find($id);

        $data->username = $request->username;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;

        if($request->file('photo')){
            $file = request()->file('photo');
            @unlink(public_path('upload/agent_images/'.$data->photo));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/agent_images'), $filename);
            $data['photo'] = $filename;
        }

        $data->save();

        $notif = array(
            'message' => 'Agent Profile Updated Successfully',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notif);

    }// END AgentProfileStore





    public function AgentChangePassword(){

        $agentID = Auth::user()->id;
        $profileData = User::find($agentID);
        return view('agent.agent_change_password', compact('profileData'));

    }// END AgentChangePassword





    public function AgentUpdatePassword(Request $request){

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

    }// END AgentUpdatePassword
}
