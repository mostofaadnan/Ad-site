<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class ApiController extends Controller
{
    public function show()
    {
        return view('BackEnd.api.show');
    }

    public function update(Request $request)
    {

        $request->validate([
            'apiKey' => 'required',
            'apiVersion' => 'required',
            'webhookSecret' => 'required',
        ]);
        $apiKey = $request->apiKey;
        $apiVersion = $request->apiVersion;
        $webhookSecret = $request->webhookSecret;
        $array = [
            'apiKey' => $apiKey,
            'apiVersion' => $apiVersion,
            'webhookSecret' => $webhookSecret,
        ];
        $fp = fopen(base_path('config/apicoinbase.php'), 'w');
        fwrite($fp, '<?php return ' . var_export($array, true) . ';');
        fclose($fp);
        /*  config::set('coinbase.apiKey', $apiKey);
        Config::set('coinbase.apiVersion', $apiVersion);
        Config::set('coinbase.webhookSecret', $webhookSecret);
         */
        Artisan::call('config:cache');
        Session()->flash('success', 'Api Key Update Sccesfuly');
        return redirect()->route('api.show');

    }
}
