<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductModel;
use App\Models\Category;
use App\Models\Branch;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{


    // Display product list filtered by selected branch
    // Supports branch switching via dropdown using ?branch=id parameter
    // Uses JOIN to display category_name and branch_name in table
    public function index(Request $request){
        // Get branch from URL query (?branch=1) or default to Surabaya (id=1)
        $branchId = $request->input('branch', 1);
        $branch = Branch::findOrFail($branchId);
        $branches = Branch::all(); // For dropdown options
        
        // Get search keyword from URL query
        $search = $request->input('search');
        
        // Join product with category and branch, filter by branch and search
        $query = DB::table('tb_product')
            ->join('tb_category', 'tb_product.id_category', '=', 'tb_category.id_category')
            ->join('tb_branch', 'tb_product.id_branch', '=', 'tb_branch.id_branch')
            ->select('tb_product.*', 'tb_category.category_name', 'tb_branch.name_branch')
            ->where('tb_product.id_branch', $branchId);
        
        if ($search) {
            $query->where('tb_product.name_product', 'LIKE', '%' . $search . '%');
        }
        
        // Pagination: 3 products per page
        // appends() keeps branch & search parameters in pagination links
        $product = $query->paginate(3)->appends(['branch' => $branchId, 'search' => $search]);

        // Return JSON for AJAX requests
        if ($request->ajax()) {
            return response()->json(['products' => $product]);
        }

        // Return full view for regular requests
        return view('pages.product.show', [
            'branch' => $branch,
            'branches' => $branches,
            'data_product' => $product
        ]);
    }
    
    // Show add product form with categories and current branch from URL
    // Branch is determined by current product view (?branch=id parameter)
    public function create(Request $request){
        $branchId = $request->input('branch', 1); // Get current branch from URL
        $branch = Branch::findOrFail($branchId);
        $categories = Category::all();
        return view('pages.product.add', [
            'categories' => $categories,
            'branch' => $branch
        ]);
    }

    // Store new product - branch is automatically set from current view
    public function store(Request $request){
        $request->validate([
            'name_product' => 'required|max:150',
            'price_product' => 'required',
            'description_product' => 'required',
            'stock_product' => 'required|integer|min:0',
            'id_category' => 'required|exists:tb_category,id_category',
            'id_branch' => 'required|exists:tb_branch,id_branch',
            'image_product' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        // Remove dots from price format
        $cleanPrice = str_replace('.', '', $request->price_product);

        // Handle image upload
        $imagePath = null;
        if ($request->hasFile('image_product')) {
            $imagePath = $request->file('image_product')->store('products', 'public');
        }

        ProductModel::create([
            'name_product' => $request->name_product,
            'price_product' => $cleanPrice,
            'description_product' => $request->description_product,
            'stock_product' => $request->stock_product,
            'id_category' => $request->id_category,
            'id_branch' => $request->id_branch,
            'image_product' => $imagePath
        ]);

        // Redirect back to the same branch view
        return redirect('/product?branch=' . $request->id_branch)->with('Message', 'Product added successfully!');
    }

    // Display single product detail
    // Returns 404 error if product ID not found
    public function show($id){
        $data = ProductModel::findOrFail($id);

        return view('pages.product.detail', [
            'product' => $data
        ]);
    }

    // Show edit product form with existing data and categories
    // Branch cannot be changed - product stays in its original branch
    public function edit($id){
        $data = ProductModel::findOrFail($id);
        $categories = Category::all();

        return view('pages.product.edit', [
            'data' => $data,
            'categories' => $categories
        ]);
    }

    // Update product - branch stays the same (cannot be changed)
    public function update(Request $request, $id){
        $product = ProductModel::findOrFail($id);

        $request->validate([
            'name_product' => 'required|max:150',
            'price_product' => 'required',
            'description_product' => 'required',
            'stock_product' => 'required|integer|min:0',
            'id_category' => 'required|exists:tb_category,id_category',
            'image_product' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $cleanPrice = str_replace('.', '', $request->price_product);

        // Handle image upload and delete old image
        $imagePath = $product->image_product;
        if ($request->hasFile('image_product')) {
            if ($imagePath) {
                Storage::disk('public')->delete($imagePath);
            }
            $imagePath = $request->file('image_product')->store('products', 'public');
        }

        $product->update([
            'name_product' => $request->name_product,
            'price_product' => $cleanPrice,
            'description_product' => $request->description_product,
            'stock_product' => $request->stock_product,
            'id_category' => $request->id_category,
            // id_branch stays the same - not updated
            'image_product' => $imagePath
        ]);

        // Redirect back to the product's branch view
        return redirect('/product?branch=' . $product->id_branch)->with('Message', 'Product updated successfully!');
    }

    // Delete product and its image from database
    public function destroy($id){
        $product = ProductModel::findOrFail($id);
        $branchId = $product->id_branch; // Save branch ID before deletion

        // Delete product image if exists
        if ($product->image_product) {
            Storage::disk('public')->delete($product->image_product);
        }

        $product->delete();
        // Redirect back to the same branch view
        return redirect('/product?branch=' . $branchId)->with('Message', 'Product deleted successfully!');
    }
}
