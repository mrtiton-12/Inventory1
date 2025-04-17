<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{

    public function login_form()
    {
        return view('admin.login-form');
    }

    public function adminlogin(Request $request)
    {
        $request->validate([
            'email'    => 'required',
            'password' => 'required',
        ]);

        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('dashboard');
        } else {
            Session::flash('error-message', 'Invalid Email or Password');
            return back();
        }
    }

    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('login.form');
    }

    public function adminedit()
    {
        $admin = DB::table('admins')->first();
        return view('admin.admin.edit', compact('admin'));
    }

    public function profileUpdate(Request $request)
    {
        $admin = Auth::guard('admin')->user();
        $request->validate([
            'name'          => 'required|string|max:255',
            'email'         => 'required|email|unique:admins,email,' . $admin->id,
            'username'      => 'required|string|unique:admins,username,' . $admin->id,
            'profile_image' => 'nullable|mimes:jpg,jpeg,png,webp,avif|max:2048',
        ]);

        if ($request->hasFile('profile_image')) {
            if ($admin->profile_image && file_exists(public_path($admin->profile_image))) {
                unlink(public_path($admin->profile_image));
            }
            $image     = $request->file('profile_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/admin_profiles'), $imageName);
            $admin->profile_image = 'uploads/admin_profiles/' . $imageName;
        }

        $admin->name     = $request->name;
        $admin->email    = $request->email;
        $admin->username = $request->username;
        $admin->save();

        return redirect()->route('dashboard')->with('success', 'Profile updated successfully');
    }

}
