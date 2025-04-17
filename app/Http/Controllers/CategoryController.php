<?php
namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::all();
        return view('admin.category.index', compact('categories'));
    }

    public function store(Request $request)
    {

        $input = $request->validate([
            'category_name' => 'required|unique:categories|max:255',

        ]);

        Category::create([
            'category_name' => $input['category_name'],
            'category_slug' => Str::slug($input['category_name']),
        ]);
        return redirect()->back()->with('success', 'Category created successfully.');
    }

    public function update(Request $request, Category $category)
    {
        $input = $request->validate([
            'category_name' => 'required|string|max:255|unique:categories,category_name,' . $category->id,
        ]);

        $category->update([
            'category_name' => $input['category_name'],
            'category_slug' => Str::slug($input['category_name']),
        ]);

        return redirect()->back()->with('success', 'Category updated successfully.');

    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->back()->with('success', 'Category Deleted  successfully.');
    }
}
