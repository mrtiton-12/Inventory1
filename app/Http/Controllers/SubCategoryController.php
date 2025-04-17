<?php
namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SubCategoryController extends Controller
{

    public function index()
    {
        $subcategories = SubCategory::all();
        $categories    = Category::all();
        return view('admin.subcategory.index', compact('subcategories', 'categories'));
    }

    public function store(Request $request)
    {
        $input = $request->validate([
            'subcategory_name' => 'required|unique:sub_categories|max:255',
            'category_id'      => 'required|exists:categories,id',
        ]);

        Subcategory::create([
            'subcategory_name' => $input['subcategory_name'],
            'category_id'      => $input['category_id'],
            'subcategory_slug' => Str::slug($input['subcategory_name']),
        ]);

        return redirect()->back()->with('success', 'Subcategory added successfully!');
    }

    public function update(Request $request, $id)
    {
        $input = $request->validate([
            'subcategory_name' => 'required|string|max:255|unique:sub_categories,subcategory_name,' . $id,
            'category_id'      => 'required|exists:categories,id',
        ]);

        $subCategory = Subcategory::findOrFail($id);

        $subCategory->update([
            'subcategory_name' => $input['subcategory_name'],
            'category_id'      => $input['category_id'],
            'subcategory_slug' => Str::slug($input['subcategory_name']),
        ]);

        return redirect()->back()->with('success', 'Subcategory updated successfully.');
    }

    public function destroy($id)
    {
        SubCategory::findOrFail($id)->delete();

        return redirect()->back()->with('warning', 'Subcategory deleted successfully.');
    }
}
