<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return response()->json($products);
    }

    public function indexRanged(Request $request)
    {
        $perPage = $request->input('perPage', 10);
        $page = $request->input('page', 1); 
        $products = Product::paginate($perPage, ['*'], 'page', $page);
        return response()->json($products, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request){
        $product = new Product();
        $product->sku = $request->input('sku');
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->save();

        return response()->json(['message' => 'Product created successfully'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $product){
        try{
            $productId = $product->id;
            $response = Product::findOrFail($productId);
            return response()->json($response, 200);
        }catch(\Exception $e){
            return response()->json(['message' => 'Invalid id or product does not exist'], 404); 
        }
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, $id){
        try{
            //dd($request->validated());
            $product = Product::findOrFail($id);
            $product->update($request->validated());
            return response()->json(['message' => 'Product updated successfully'], 200);    
        }catch(ModelNotFoundException $e){
            return response()->json(['message' => $e->getMessage()], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id){
        try{
            $product = Product::findOrFail($id);
            $product->delete();
            return response()->json(['message' => 'Product deleted successfully'], 200);
        }catch(ModelNotFoundException  $e){
            return response()->json(['message' => $e->getMessage()], 404);
        }
    }
}
