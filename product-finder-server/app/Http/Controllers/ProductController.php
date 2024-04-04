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

    public function indexRanged($perPage, $page) {
        try {
            $query = Product::query();
            $totalProducts = Product::count();

            $products = $query->paginate($perPage, ['*'], 'page', $page);
    
            return response()->json([
                'content' => $products,
                'total' => $totalProducts,
                'success' => 'true'
            ], 200);
        } catch(\Exception $e) {
            return response()->json([
                'content' => 'Could not index from the specified range: ' . $e->getMessage(),
                'success' => 'false'
            ], 400);
        }
    }

    public function getProduct($id){
        try{
            $product = Product::findOrFail($id);
    
            return response()->json([
                'content' => $product,
                'success' => 'true',
            ],200);
        }catch(\Exception $e){
            return response()->json([
                'message' => 'Error fetching product: ' . $e->getMessage(),
                'success' => 'false',
            ]);
        }
    }

    public function indexRangedFiltered($perPage, $page, Request $request) {
        try {

            $validated = $request->validate([
                'filter' => 'string|required',
                'search' => 'string|nullable',
            ]);

            $filter = $validated['filter'];
            $search = $validated['search'];

            $query = Product::query();
            $totalProducts = Product::count();
    
            if ($search !== null) {
                // Split the occurrence into individual words
                $keywords = explode(' ', $search);
                
                // Loop through each keyword and add where clauses
                foreach ($keywords as $keyword) {
                    $query->where(function($q) use ($keyword) {
                        $q->where('name', 'like', "%$keyword%")
                          ->orWhere('description', 'like', "%$keyword%");
                    });
                }
            }
    
            // Apply filter if provided
            if ($filter !== null) {
                if ($filter == 'available') {
                    $query->where('stock', '>', 0)->where('available', true);
                } elseif ($filter == 'unavailable') {
                    $query->where('available', false);
                }
            }
    
            // Paginate the results
            $products = $query->paginate($perPage, ['*'], 'page', $page);
    
            return response()->json([
                'content' => $products,
                'total' => $totalProducts,
                'success' => 'true'
            ], 200);
        } catch(\Exception $e) {
            return response()->json([
                'content' => 'Could not index from the specified range: ' . $e->getMessage(),
                'success' => 'false'
            ], 400);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request){
        try{
            $product = new Product();
            $product->sku = $request->input('sku');
            $product->name = $request->input('name');
            $product->description = $request->input('description');
            $product->photos = $request->input('photos');
            $product->price = $request->input('price');
            $product->save();
    
            return response()->json([
                'message' => 'Product created successfully',
                'success' => 'true',
            ], 201);
        }catch(\Exception $e){
            return response()->json([
                'content' => 'Could not store the product item: ' . $e->getMessage(),
                'success' => 'false'
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $product){
        try{
            $productId = $product->id;
            $response = Product::findOrFail($productId);
            return response()->json([
                'content' => $response,
                'success' => 'true',
            ], 200);
        }catch(\Exception $e){
            return response()->json([
                'message' => 'Invalid id or product does not exist: ' . $e->getMessage(),
                'success' => 'false',
            ], 404); 
        }
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, $id){
        try{
            //dd($request->validated());
            $product = Product::findOrFail($id);
            


            foreach ($request as $key => $value) {
                if (empty($value)) {
                    unset($request[$key]);
                }
            }
            
            
            $product->update($request->validated());


            return response()->json([
                'message' => 'Product updated successfully',
                'success' => 'true',
            ], 200);    
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
            return response()->json([
                'message' => 'Product deleted successfully',
                'success' => 'true',
            ], 200);
        }catch(ModelNotFoundException  $e){
            return response()->json([
                'message' => 'Could not destroy the specified item: ' . $e->getMessage(),
                'success' => 'false'
            ], 404);
        }
    }
}
