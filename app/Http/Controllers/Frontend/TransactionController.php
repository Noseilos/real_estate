<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\TransactionMail;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\Property;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class TransactionController extends Controller
{
    public function TransactComplete(Request $request)
    {

        $aid = $request->agent_id;
        $pid = $request->property_id;
        $pprice = $request->lowest_price;

        if (Auth::check()) {

            Transaction::insert([

                'user_id' => Auth::user()->id,
                'property_id' => $pid,
                'agent_id' => $aid,
                'price' => $pprice,
                'created_at' => Carbon::now(),
            ]);

            $transactionData = [
                'user' => Auth::user(),
                'aid' => $aid,
                'pid' => $pid,
                'pprice' => $pprice,
            ];
            Mail::to(Auth::user()->email)->send(new TransactionMail($transactionData));

            $notification = array(
                'message' => 'Successfull Transaction',
                'alert-type' => 'success',
            );

            return redirect()->back()->with($notification);

        } else {

            $notification = array(
                'message' => 'Plz Login Your Account First',
                'alert-type' => 'error',
            );

            return redirect()->back()->with($notification);
        }
    }
}
