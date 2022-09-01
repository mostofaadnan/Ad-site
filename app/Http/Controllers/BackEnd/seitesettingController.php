<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Image;

class seitesettingController extends Controller
{
    public function show()
    {

        return view('BackEnd.general.show');
    }

    public function update(Request $request)
    {

        $request->validate([
            'company_name' => 'required',
            'Short_description' => 'required',
            'email' => 'required',
            'mail_password' => 'required',
            'Mail_Host' => 'required',
            'copy_rights' => 'required',
        ]);
       
        if ($request->hasfile('main_logo')) {

            $file = $request->file('main_logo');
            $Path = public_path('/image/logo/');
            $mainimg = time() . rand(1, 100) . '.' . $file->getClientOriginalExtension();
            $Mainimg = Image::make($file->getRealPath());
            $Mainimg->save($Path . '/' . $mainimg, 50);
        } else {
            $mainimg=config('company.main_logo');
        }

        if ($request->hasfile('side_logo')) {

            $file = $request->file('side_logo');
            $Path = public_path('/image/logo/');
            $sidelogo = time() . rand(1, 100) . '.' . $file->getClientOriginalExtension();
            $Sidelogo = Image::make($file->getRealPath());
            $Sidelogo->save($Path . '/' . $sidelogo, 50);
        }else{
            $sidelogo=config('company.side_logo');
        }

        $company_name = $request->company_name;
        $Short_description = $request->Short_description;
        $email = $request->email;
        $mail_password = $request->mail_password;
        $Mail_Host = $request->Mail_Host;
        $copy_rights = $request->copy_rights;
        $main_logo = $mainimg;
        $side_logo = $sidelogo;
        $ad_banner=$request->ad_banner;
        $array = [
            'company_name' => $company_name,
            'Short_description' => $Short_description,
            'email' => $email,
            'mail_password' => $mail_password,
            'Mail_Host' => $Mail_Host,
            'copy_rights' => $copy_rights,
            'main_logo' => $main_logo,
            'side_logo' => $side_logo,
            'ad_banner' => $ad_banner,
        ];
        $fp = fopen(base_path('config/company.php'), 'w');
        fwrite($fp, '<?php return ' . var_export($array, true) . ';');
        fclose($fp);
        Artisan::call('config:cache');
 /*        Session()->flash('success', 'Api Key Update Sccesfuly'); */
        return redirect()->route('general.show');

    }
}
