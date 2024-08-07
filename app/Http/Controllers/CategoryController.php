<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function getAllCategories(){
        $category = Category::all();

        if(sizeof($category)){
            return response()->json([
                'message' => 'Retreive Category successfully',
                'status' => 'true',
                'categories' => $category,
                'quantity' => $category->count(),
            ]);
        }

        return response()->json([
            'message' => 'Category not found',
            'status' => 'false',
        ]);
    }
    public function getCategoryByname($name){
        $category = Category::where('name','like',"%{$name}%")->get();

        if(sizeof($category)){
            return response()->json([
                'message' => 'Retreive Category successfully',
                'status' => 'true',
                'product' => $category
            ]);
        }

        return response()->json([
            'message' => 'Category not found',
            'status' => 'false',
        ]);
    }
    public function getCategoryById($id){
        $category = Category::find($id);

        if($category){
            return response()->json([
                'message' => 'Retreive Category successfully',
                'status' => 'true',
                'category' => $category
            ]);
        }

        return response()->json([
            'message' => 'Category not found',
            'status' => 'false',
        ]);
    }

    public function getCategory($name){
        $category = Category::with('products.pinformations')->where('name','like',"%{$name}%")->get();

        if(sizeof($category)){
            return response()->json([
                'message' => 'Retreive Category successfully',
                'status' => 'true',
                'product' => $category
            ]);
        }

        return response()->json([
            'message' => 'Category not found',
            'status' => 'false',
        ]);
    }

    public function getCategories(){
        $category = Category::with('products')->get();

        $productID = [];
        if(sizeof($category)){
            foreach($category as $index => $c){
                // dd($c->products);
                foreach($c->products as $i => $p){
                    if(empty($productID[$index])){
                        array_push($productID,(string) $p->id);
                    }else{
                        $productID[$index] .= "/".$p->id;
                    }

                }
            }

            return response()->json([
                'message' => 'Retreive Category successfully',
                'status' => 'true',
                'products' => $category,
                'productId' => $productID,
            ]);
        }

        return response()->json([
            'message' => 'Category not found',
            'status' => 'false',
        ]);
    }

    public function createCategory(Request $request){
        $validate = Validator::make($request->all(),[
            'name' => 'required|string',
        ]);

        if($validate->fails()){
            return response()->json([
                'message' => 'Please input all the information!',
                'status' => 'false',
                'errors' => $validate->errors()
            ]);
        }

        $category = Category::where('name', '=', $request->get('name'))->get();

        if(sizeof($category) == 0){
            $category = Category::insert([
                'name' => $request->get('name'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            if($category){
                return response()->json([
                    'message' => 'Category created  successfully',
                    'status' => 'true',
                ]);
            }

            return response()->json([
                'message' => 'Cannot create a new category',
                'status' => 'false',
            ]);
        }

        return response()->json([
            'message' => "Category is already exist with {$request->get('name')}",
            'status' => 'false',
        ]);
    }

    public function updateCategory(Request $request, $id){
        $validate = Validator::make($request->all(),[
            'name' => 'required|string',
        ]);

        if($validate->fails()){
            return response()->json([
                'message' => 'validation error',
                'status' => 'false',
                'errors' => $validate->errors()
            ]);
        }

        $category = Category::find($id);

        if($category){
            $category->name = $request->get('name');
            $category->updated_at = now();

            if($category->save()){
                return response()->json([
                    'message' => 'Category updated  successfully',
                    'status' => 'true',
                ]);
            }

            return response()->json([
                'message' => 'Cannot update category',
                'status' => 'false',
            ]);
        }

        return response()->json([
            'message' => "Cannot find the category",
            'status' => 'false',
        ]);
    }
    public function deleteCategory($id){
        $category = Category::find($id);

        if($category){
            if($category->delete()){
                return response()->json([
                    'message' => 'Category deleted successfully',
                    'status' => 'true',
                ]);
            }

            return response()->json([
                'message' => 'Cannot delete category',
                'status' => 'false',
            ]);
        }

        return response()->json([
            'message' => "Cannot find the category",
            'status' => 'false',
        ]);
    }
}
