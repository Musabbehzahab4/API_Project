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
    public function subcategory()
    {
        $subcateg = SubcCategory::all();
        return response()->json([
            'success' => true,
            'SubCategory' => $subcateg,
            'message' => 'SubCategory Founded Successfully'
        ], 200);
    }

    public function product()
    {
        $product = Product::all();
        return response()->json([
            'success' => true,
            'Product' => $product,
            'message' => 'Product Founded Successfully'
        ], 200);
    }
}
