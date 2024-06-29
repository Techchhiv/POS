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
<<<<<<< HEAD
                'categories' => $category,
                'quantity' => $category->count(),
=======
                'product' => $category
>>>>>>> 5a3a02ee4411f2d88c5ee71db2a902940e95ec8a
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
<<<<<<< HEAD
        $category = Category::with('products')->get();
=======
        $category = Category::with('products.pinformations')->get();
>>>>>>> 5a3a02ee4411f2d88c5ee71db2a902940e95ec8a

        if(sizeof($category)){
            return response()->json([
                'message' => 'Retreive Category successfully',
                'status' => 'true',
<<<<<<< HEAD
                'products' => $category
=======
                'product' => $category
>>>>>>> 5a3a02ee4411f2d88c5ee71db2a902940e95ec8a
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
                'message' => 'validation error',
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
