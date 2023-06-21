<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AgentController extends Controller
{
    public function AgentDashboard(){
        
        return view('agent.agent_dashboard');

    } // END AgentDashboard





    public function AgentLogin(){

        return view('agent.agent_login');
    }// END AgentLogin
}
