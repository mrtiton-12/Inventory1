<?php
namespace App\Http\Controllers;

use App\Models\WebsiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class WebsiteSettingController extends Controller
{
    public function edit()
    {
        $websitesetting = DB::table('website_settings')->first();
        return view('admin.settings.websitesetting', compact('websitesetting'));
    }

    public function update(Request $request, $id)
    {
        $data = WebsiteSetting::findOrFail($id);

        $oldImage = $data->header_logo;

        if ($request->hasFile('header_logo')) {
            $header_logo = $request->file('header_logo');
            $imageName   = time() . '.' . $header_logo->getClientOriginalExtension();
            $header_logo->move(public_path('images'), $imageName);

            $data->header_logo = $imageName;

            if ($oldImage && File::exists(public_path('images/' . $oldImage))) {
                File::delete(public_path('images/' . $oldImage));
            }
        }

        $data->update([

            'website_name'    => $request->website_name,
            'website_phone'   => $request->website_phone,
            'website_address' => $request->website_address,
            'website_email'   => $request->website_email,
            'currency'        => $request->currency,
        ]);
        $data->save();

        return redirect()->back()->with('success', 'Data updated successfully!');
    }

}
