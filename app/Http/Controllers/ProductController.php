<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductModel;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index(){
        // shop type, branch, address etc
        $shop = [
            'shop_branch' => 'Blessing Equipment Surabaya',
            'address' => 'Darmo Permai selatan XIII no.33',
            'type' => 'Offline Store'
        ];  
        $product = ProductModel::get(); //query all data from tb_product
        // $queryBuilder = DB::table('tb_product')->get(); //query all data from tb_product using query builder

        return view('pages.product.show', [
            'data_shop' => $shop,
            'data_product' => $product
        ]);
         
        return view('pages.product.show', $data);
    }
    
    public function create(){
        return view('pages.product.add');
    }

    // SERVER-SIDE VALIDATION
    public function store(Request $request){
        $request->validate([
            'name_product' => 'required',
            'price_product' => 'required',
            'description_product' => 'required',
        ]);

        // Remove dots from price format (example -> 10.000.000 becomes 10000000)
        $cleanPrice = str_replace('.', '', $request->price_product);

        //add data to tb_product USING ELOQUENT ORM
        ProductModel::create([
            'name_product' => $request->name_product,
            'price_product' => $cleanPrice,
            'description_product' => $request->description_product,
            'id_category' => '1'
        ]);
        // return to product page after added data (with message ofcors)
        return redirect('/product')->with ('Message', 'Product added successfully!');
    }


    public function show($id){
        // query (perintahh)
        // why FindOrFail ? not Find?
        // Find -> unavailable id will return null
        // FindOrFail -> unavailable id will return 404 error
        $data = ProductModel::findOrFail($id);

        return view('pages.product.detail', [
            'product' => $data
        ]);
    }


    public function edit ($id){
        $data = ProductModel::findOrFail($id);

        return view('pages.product.edit', [
            'data' => $data
        ]);
    }

    public function update(Request $request, $id){
        // Validation
        $request->validate([
            'name_product' => 'required',
            'price_product' => 'required',
            'description_product' => 'required',
        ]);

        // Remove dots from price format
        $cleanPrice = str_replace('.', '', $request->price_product);

        // Find product and update
        $product = ProductModel::findOrFail($id);
        $product->update([
            'name_product' => $request->name_product,
            'price_product' => $cleanPrice,
            'description_product' => $request->description_product,
        ]);

        return redirect('/product')->with('Message', 'Product updated successfully!');
    }

    public function destroy($id){
        // Find and delete product
        $product = ProductModel::findOrFail($id);
        $product->delete();

        return redirect('/product')->with('Message', 'Product deleted successfully!');
    }
}



        // notessss
        // insert data to database
        // dd($request->all()); //debugging to see all request data

        // other method : using Query Builder
        // DB::table('tb_product')->insert([
        //     'name_product' => $request->name_product,
        //     'price_product' => $request->price_product,
        //     'description_product' => $request->description_product,
        //     'id_category' => $request->id_category
        // ]);
