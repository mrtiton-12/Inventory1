<?php

namespace App\Http\Controllers;

use App\Models\Employe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class EmployeController extends Controller
{
    
    public function index()
    {
          $employes = Employe::all();
          $employee = DB::table('employes')->first();
          return view('admin.employe.index',compact('employes','employee'));
    }

   
    public function store(Request $request)
    {
        $input = $request->validate([
            'employe_name' => 'required|string|max:255',
            'employe_designation'=>'required|string|max:255',
            'employe_phone' => 'required|string|max:20',
            'employe_email' => 'required|email|unique:employes,employe_email',
            'experience' => 'nullable|string|max:255',
            'employe_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);
    
        // ইমেজ হ্যান্ডেলিং
        if ($image = $request->file('employe_image')) {
            $destinationPath = 'images/';
            $employetImage    = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $employetImage);
            $input['employe_image'] = "$employetImage";
        }
    
        // ডেটা সেভ
        Employe::create([
            'employe_name' => $input['employe_name'],
            'employe_designation' => $input['employe_designation'],
            'employe_phone' => $input['employe_phone'],
            'employe_email' => $input['employe_email'],
            'experience' => $input['experience'] ?? null,
            'employe_image' => $employetImage ?? null,
        ]);
    
        return redirect()->back()->with('success', 'Employee created successfully!');
    }

   

    public function update(Request $request, Employe $employe)
    {
        $input = $request->validate([
            'employe_name' => 'required|string|max:255',
            'employe_phone' => 'required|string|max:20',
            'employe_email' => 'required|email|unique:employes,employe_email,' . $employe->id,
            'experience' => 'nullable|string|max:255',
            'employe_designation' => 'nullable|string|max:255',
            'employe_image' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif,svg|max:2048',
        ]);
        
        $oldImage = $employe->employe_image;
        
        if ($request->hasFile('employe_image')) {
            $image = $request->file('employe_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $input['employe_image'] = $imageName;  
            if ($oldImage && File::exists(public_path('images/' . $oldImage))) {
                File::delete(public_path('images/' . $oldImage));
            }
        }
        
      
        $employe->update($input);
    
        return redirect()->back()->with('success', 'Employee updated successfully.');
    }

    
    public function destroy($id)
    {
        $employee = Employe::findOrFail($id);
    if ($employee->employe_image && File::exists(public_path('images/' . $employee->employe_image))) {
        File::delete(public_path('images/' . $employee->employe_image));
    }

    $employee->delete();

   
    return redirect()->back()->with('success', 'Employee deleted successfully!');
    }
}
