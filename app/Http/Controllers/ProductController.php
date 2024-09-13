<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function expensiveProducts($amount) {
        $data['products'] = Product::where('price', '>', $amount)->get();
        return view('products.expensive')->with($data);
    }
    public function show($id) {
        $data['product'] = Product::findOrFail($id);
        return view('products.show')->with($data);
    }
    public function showall() {
        $data['products'] = Product::all();
        return view('products.all')->with($data);
    }
    public function editForm($id){

        $data['product']=Product::findOrFail($id);
        $this->authorize('update', $data['product']); // Authorization check
        return view('products.edit')->with($data);

    }

    public function update(Request $request,  $id)
    {
        
        // $this->authorize('update', $product); // Authorization check

        // Validate the request
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
          
        ]);
    
        $product=Product::findOrFail($id);

        // Update product with validated data
        $product->update($data);
    
        return redirect('product/'. $product->id)->with('success', 'Product updated successfully.');
    
    }

    public function destroy($id)
    {
        $product=Product::findOrFail($id);
        $this->authorize('delete', $product); // Authorization check
        $product->delete();
        return redirect('products/all');
    }

    public function add(){
        return view('products.add');
    }


    public function store(Request $request)
    {
        // Validate the request
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'category_id' => 'required|integer',
        ]);
        $user_id=Auth::id();

        // Create a new product
        Product::create([
            'name' => $data['name'],
            'price' => $data['price'],
            'quantity' => $data['quantity'],
            'category_id' => $data['category_id'],
            'user_id' => $user_id,
           
        ]);

        // Return a success response
        return redirect('products/all');
    }
}
