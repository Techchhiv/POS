<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CategoryProduct;
use App\Models\PInformation;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function getProducts(){
        $product = Product::with('pinformations','categories')->get();

        if(sizeof($product)){
            return response()->json([
                'message' => 'Retreive Product successfully',
                'status' => 'true',
                'products' => $product,
                'quantity' => $product->count(),
            ]);
        }

        return response()->json([
            'message' => 'Product not found',
            'status' => 'false',
        ]);
    }
    public function getProduct($name){
        $product = Product::with('pinformations')->where('name', 'LIKE',"%{$name}%")->get();

        if(sizeof($product)){
            return response()->json([
                'message' => 'Retreive Product successfully',
                'status' => 'true',
                'product' => $product
            ]);
        }

        return response()->json([
            'message' => 'Product not found',
            'status' => 'false',
        ]);
    }
    public function getProductById($id){
        $product = Product::with('pinformations','categories')->find($id);

        if($product){
            return response()->json([
                'message' => 'Retreive Product successfully',
                'status' => 'true',
                'product' => $product
            ]);
        }

        return response()->json([
            'message' => 'Product not found',
            'status' => 'false',
        ]);
    }
    public function getProductInfoById($id){
        $product = PInformation::withfind($id);

        if($product){
            return response()->json([
                'message' => 'Retreive Product successfully',
                'status' => 'true',
                'product' => $product
            ]);
        }

        return response()->json([
            'message' => 'Product not found',
            'status' => 'false',
        ]);
    }

    public function createProduct(Request $request){
        $validator = Validator::make($request->all(),[
            'category_name' => 'required',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'image' => 'nullable|file|image|max:255',
            'barcode' => 'required|integer',
            'price' => 'required',
            'size' => 'nullable',
            'color' => 'nullable',
            'qty' => 'nullable',
            'status' => 'nullable|boolean',
        ]);

        if($validator->fails()){
            return response()->json([
                'message' => 'Please fill in all information!',
                'status' => 'false',
                'errors' => $validator->errors()
            ]);
        }

        $image = $request->file('image');
        $imageName = $image->getClientOriginalName();


        $p = Product::where('name','=',$request->get('name'))->first();

        if($p){
            return response()->json([
                'message' => 'Product already exist',
                'status' => 'false',
           ]);
        }

        $category = Category::where('name', '=', $request->get('category_name'))->first();

        if(!$category)
            return response()->json([
                'message' => 'Category Not found',
                'status' => 'false',
           ]);


        $product = Product::create([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'image' => $imageName,
            'barcode' => $request->get('barcode'),
            'price' => $request->get('price'),
            'status' => $request->get('status') ? $request->get('status') : 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $categoryP = CategoryProduct::insert([
            'product_id' => $product->id,
            'category_id' => $category->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Storage::disk('minio')->put('image/'. $imageName, file_get_contents($request->file('image')));

        if(!$categoryP)
            return response()->json([
                'message' => 'Error with putting the product with the given category',
                'status' => 'false',
        ]);

        if($product){
            $pinfo = PInformation::insert([
                'product_id' => $product->id,
                'size' => $request->get('size') ? $request->get('size') : "N/A",
                'color' => $request->get('color') ? $request->get('color') : "N/A",
                'quantity' => $request->get('qyt') ? $request->get('qyt') : 1,
                'created_at' => now(),
                'updated_at'=> now(),
            ]);

            return response()->json([
                'status' => 'true',
                'message' => 'Product Created succesfully',
            ]);
        }

        return response()->json([
            'status' => 'false',
            'message' => 'Cannot create product',
        ]);

    }
    public function createProductInfo(Request $request, $id){
        $validator = Validator::make($request->all(),[
            'color' => 'nullable',
            'size' => 'nullable',
            'quantity' => 'nullable|integer'
        ]);

        if($validator->fails()){
            return response()->json([
                'message' => 'validation error',
                'status' => 'false',
                'errors' => $validator->errors()
            ]);
        }

        $p = PInformation::insert([
            'product_id' => $id,
            'size' => $request->get('size'),
            'color' => $request->get('color'),
            'quantity' => $request->get('quantity') ? $request->get('quantity') : 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        if($p)
            return response()->json([
                'status' => 'true',
                'message' => 'Product Items Created succesfully',
            ]);

        return response()->json([
            'status' => 'false',
            'message' => 'Cannot create product item',
        ]);

    }

    public function updateProduct(Request $request,$id){
        $product = Product::find($id);

        if(!$product){
            return response()->json([
                'message' => 'Cannot find product',
                'status' => 'false',
            ]);
        }

        $p = $product->update([
            'name' => $request->get('name') ? $request->get('name') : $product->name,
            'description' => $request->get('description') ? $request->get('description') : $product->description,
            'image' => $request->get('image') ? $request->get('image') : $product->image,
            'barcode' => $request->get('barcode') ? $request->get('barcode') : $product->barcode,
            'price' => $request->get('price') ? $request->get('price') : $product->price,
            'status' => $request->get('status') ? $request->get('status') : $product->status,
            'updated_now' => now()
        ]);

        if($p){
            return response()->json([
                'message' => 'Product updated successfully',
                'status' => 'true',
            ]);
        }

        return response()->json([
            'message' => 'Error when updating product',
            'status' => 'false',
        ]);

    }
    public function updateProductInfo(Request $request,$id){
        $product = PInformation::find($id);

        if(!$product){
            return response()->json([
                'message' => 'Cannot find product item',
                'status' => 'false',
            ]);
        }

        $p = $product->update([
            'size' => $request->get('size') ? $request->get('size') : $product->size,
            'quantity' => $request->get('quantity') ? $request->get('quantity') : $product->quantity,
            'color' => $request->get('color') ? $request->get('color') : $product->color,
        ]);

        if($p){
            return response()->json([
                'message' => 'Product updated successfully',
                'status' => 'true',
            ]);
        }

        return response()->json([
            'message' => 'Error when updating product',
            'status' => 'false',
        ]);


    }

    public function deleteProduct($id){
        $product = Product::find($id);

        if($product){
            if($product->delete()){
                return response()->json([
                    'message' => 'Product deleted successfully',
                    'status' => 'true',
                ]);
            }

            return response()->json([
                'message' => 'Cannot delete product',
                'status' => 'false',
            ]);
        }

        return response()->json([
            'message' => "Cannot find the product",
            'status' => 'false',
        ]);
    }
    public function deleteProductInfo($id){
        $product = PInformation::find($id);

        if($product){
            if($product->delete()){
                return response()->json([
                    'message' => 'Product deleted successfully',
                    'status' => 'true',
                ]);
            }

            return response()->json([
                'message' => 'Cannot delete product',
                'status' => 'false',
            ]);
        }

        return response()->json([
            'message' => "Cannot find the product",
            'status' => 'false',
        ]);
    }

    public function changeStatus($id){
        $product = Product::find($id);

        if($product){
            $product->status = !$product->status;
            $product->save();
            return response()->json([
                'message' => 'Product update status successfully',
                'status' => 'true',
            ]);
        }
        return response()->json([
            'message' => 'Product not found!',
            'status' => 'false',
        ]);
    }

    function getallProductInfo(){
        $product = PInformation::with('product')->where('quantity', '>', 0)->get();

        if(sizeof($product)){
            return response()->json([
                'message' => 'Retrieve product!',
                'status' => 'true',
                'products' => $product
            ]);
        }

        return response()->json([
            'message' => 'No Product found!',
            'status' => 'false',
        ]);
    }

}
