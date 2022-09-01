<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\userBalance;
use FFI\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Shakurov\Coinbase\Facades\Coinbase;

class ReloadBalanceController extends Controller
{
    /* https://commerce.coinbase.com/docs/api/ */

    public function index()
    {
        $userbalances = userBalance::where('user_id', Auth::id())
            ->where('credit', '>', '0')
            ->get();
        return view('FrontEnd.user.reloadBalance', compact('userbalances'));
    }
    public function CreateCharge(Request $request)
    {

        $request->validate([
            'amount' => 'required|numeric',
        ]);

        $charge = Coinbase::createCharge([
            'name' => 'Reload Balance',
            'description' => 'User Balance Reload',
            'local_price' => [
                'amount' => $request->amount,
                'currency' => $request->currency,
            ],
            'pricing_type' => 'fixed_price',
            'metadata' => [
                "customer_id" => Auth::id(),
                "customer_name" > Auth::user()->name,
            ],
            'redirect_url' => route('user.reloadBalance.ComplitedTransection'),
            'cancel_url' => route('user.reloadBalance.CancelTransection'),

        ]);
        try {
            //dd($charge['data']);
            $charge_id = $charge['data']['id'];
            Session::put('charge_id', $charge_id);
            $hosted_ur = $charge['data']['hosted_url'];
            return redirect($hosted_ur);

        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
        /*     dd($charge); */
    }
    public function ComplitedTransection()
    {
        $charge_id = Session::get('charge_id');
        if ($charge_id == null) {
            $charges = Coinbase::getCharge($charge_id);
            $charge = $charges['data'];
            if ($charge['payments']['status'] == "CONFIRMED") {
                $userbalance = new userBalance();
                $userbalance->user_id = Auth::id();
                $userbalance->description = "Reload Balance";
                $userbalance->credit = $charge['payments']['local']['amount'];
                $userbalance->debit = 0;
                $userbalance->transection = $charge['payments']['transaction_id'];
                $userbalance->currency = $charge['payments']['local']['currency'];
                $userbalance->Method = "Coinbase Currancy";
                $userbalance->status = $charge['payments']['status'];
                $userbalance->save();
            }
            Session::forget('charge_id');
            return view('FrontEnd.user.completetransection', compact('charge'));
        } else {
            Session()->flash('erorr', 'This Payment allready Completed');
            return redirect()->route('user.reloadBalance');
        }
    }

    public function CancelTransection()
    {
        Session::forget('charge_id');
        $charge_id = Session::get('charge_id');
        Session()->flash('erorr', 'Cancel Your Transection');
        $userbalances = userBalance::where('user_id', Auth::id())
            ->where('credit', '>', '0')
            ->get();
        return view('FrontEnd.user.reloadBalance', compact('userbalances'));
    }

}
