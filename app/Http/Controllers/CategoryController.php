<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    // Display category list page
    // Handles both regular page load and AJAX search requests
    public function index(Request $request)
    {
        // Get search keyword from URL query (?search=keyword)
        $search = $request->input('search');
        
        // Filter categories by name if search keyword exists, otherwise get all categories
        // Pagination: 10 categories per page, appends() keeps search parameter in links
        if (isset($search)) {
            $category = Category::where('category_name', 'LIKE', '%' . $search . '%')->paginate(10)->appends(['search' => $search]);
        } else {
            $category = Category::paginate(10);
        }

        // For AJAX requests (from JavaScript search), return JSON data only
        // This allows real-time search without page reload
        if ($request->ajax()) {
            return response()->json([
                'categories' => $category
            ]);
        }

        // For regular page load, return full HTML view with layout
        return view('pages.category.show', ['data_category' => $category]);
    }

    // Show add category form
    public function create()
    {
        return view('pages.category.add');
    }

    // Store new category to database
    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required',
            'category_description' => 'required',
        ]);

        Category::create([
            'category_name' => $request->category_name,
            'category_description' => $request->category_description,
        ]);

        return redirect('/category')->with('Message', 'Category added successfully!');
    }

    // Show method not used for category
    public function show(string $id)
    {
        //
    }

    // Show edit category form with existing data
    public function edit(string $id)
    {
        $data = Category::findOrFail($id);

        return view('pages.category.edit', [
            'data' => $data
        ]);
    }

    // Update existing category in database
    public function update(Request $request, string $id)
    {
        $request->validate([
            'category_name' => 'required',
            'category_description' => 'required',
        ]);

        $category = Category::findOrFail($id);
        $category->update([
            'category_name' => $request->category_name,
            'category_description' => $request->category_description,
        ]);

        return redirect('/category')->with('Message', 'Category updated successfully!');
    }

    // Delete category with protection for default category
    // Prevents deletion of "Uncategorized" - required as default category for products
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        
        // Block deletion of Uncategorized (same protection as Surabaya branch)
        if ($category->category_name === 'Uncategorized') {
            return redirect('/category')->with('Error', 'Cannot delete default category "Uncategorized"!');
        }
        
        $category->delete();

        return redirect('/category')->with('Message', 'Category deleted successfully!');
    }
}
