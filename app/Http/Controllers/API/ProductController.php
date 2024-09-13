<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    
    public function index(Request $request)
    {
        // Get products with pagination
        $products = Product::paginate(10); // Adjust the number per page as needed

        // Return JSON response
        return response()->json($products);
    }

}
