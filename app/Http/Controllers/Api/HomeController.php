<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubcCategory;

class HomeController extends Controller
{
    public function brand()
    {
        $brand = Brand::all();
        return response()->json([
            'success' => true,
            'Brand' => $brand,
            'message' => 'Brand Founded Successfully'
        ], 200);
    }
    public function category()
    {
        $category = Category::all();
        return response()->json([
            'success' => true,
            'Category' => $category,
            'message' => 'Category Founded Successfully'
        ], 200);
    }
    public function subcategory($id = null)
    {
        // Query subcategories
        $subcategs = SubcCategory::query();
        if ($id !== null) {
            $subcategs->where('category', $id);
        }
        $subcategs = $subcategs->get();

        return response()->json([
            'success' => true,
            'SubCategory' => $subcategs,
            'message' => 'Subcategories retrieved successfully'
        ], 200);
    }




    public function product($brand_id = null, $category_id = null, $subcategory_id = null)
    {
        $product = Product::query();

        if ($brand_id !== null) {
            $product->where('brand_name', $brand_id);
        }

        if ($category_id !== null) {
            $product->where('category_name', $category_id);
        }

        if ($subcategory_id !== null) {
            $product->where('subcategory_name', $subcategory_id);
        }

        $products = $product->get();

        return response()->json([
            'success' => true,
            'products' => $products,
            'message' => 'Products found successfully'
        ], 200);
    }

}
