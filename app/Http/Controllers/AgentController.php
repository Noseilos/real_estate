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
}
