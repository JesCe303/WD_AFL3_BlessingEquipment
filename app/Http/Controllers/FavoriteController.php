<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Favorite;
use App\Models\ProductModel;

/**
 * Favorite Controller - Handles wishlist/favorite operations for customers
 * 
 * Features:
 * - View all favorited products
 * - Add product to favorites
 * - Remove product from favorites
 * - Toggle favorite (add if not exists, remove if exists)
 */
class FavoriteController extends Controller
{
    /**
     * Display customer's favorite products
     */
    public function index()
    {
        // Get all favorited products for current logged-in customer
        $favorites = Favorite::where('id_user', Auth::id())
            ->with(['product.branch', 'product.category'])
            ->get();

        return view('pages.favorite.index', compact('favorites'));
    }

    /**
     * Add product to favorites
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_product' => 'required|exists:tb_product,id_product'
        ]);

        // Check if already favorited
        $exists = Favorite::where('id_user', Auth::id())
            ->where('id_product', $request->id_product)
            ->exists();

        if ($exists) {
            return redirect()->back()->with('Error', 'Product already in favorites!');
        }

        // Add to favorites
        Favorite::create([
            'id_user' => Auth::id(),
            'id_product' => $request->id_product
        ]);

        return redirect()->back()->with('Message', 'Product added to favorites!');
    }

    /**
     * Remove product from favorites
     */
    public function destroy($id)
    {
        // Find favorite by its ID and ensure it belongs to the logged-in user
        $favorite = Favorite::where('id_favorite', $id)
            ->where('id_user', Auth::id())
            ->firstOrFail();
        
        $favorite->delete();

        return redirect()->back()->with('Message', 'Product removed from favorites!');
    }

    /**
     * Toggle favorite (add if not exists, remove if exists)
     * Used for heart/like button
     */
    public function toggle(Request $request)
    {
        $request->validate([
            'id_product' => 'required|exists:tb_product,id_product'
        ]);

        $favorite = Favorite::where('id_user', Auth::id())
            ->where('id_product', $request->id_product)
            ->first();

        if ($favorite) {
            // Already favorited, remove it
            $favorite->delete();
            return redirect()->back()->with('Message', 'Removed from favorites!');
        } else {
            // Not favorited yet, add it
            Favorite::create([
                'id_user' => Auth::id(),
                'id_product' => $request->id_product
            ]);
            return redirect()->back()->with('Message', 'Added to favorites!');
        }
    }
}
