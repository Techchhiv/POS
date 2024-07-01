<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function createCustomer(Request $request){
        $validateData = Validator::make($request->all(),[
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            // 'password' => 'nullable|string|min:4',
            'email' => 'required|string|email',
            'phone' => 'nullable',
            'address' => 'nullable|string',
            'avatar' => 'nullable|string',
        ]);

        if($validateData->fails()){
            return response()->json([
                'status' => 'false',
                'message' => 'Please input all information!',
                'errors' => $validateData->errors()
              ]
            );
        }

        $user = User::where('email','=',$request->get('email'))->first();

        if(!$user){
            $user = User::create([
                'first_name' => $request->get('first_name'),
                'last_name' => $request->get('last_name'),
                'email' => $request->get('email'),
                'password' => bcrypt(123456),
              ]
            );

            if($user){
                $c = Customer::create([
                    'user_id' => $user->id,
                    'first_name' => $request->get('first_name'),
                    'last_name' => $request->get('last_name'),
                    'email' => $request->get('email'),
                    'phone' => $request->get('phone'),
                    'address' => $request->get('address'),
                    'avatar' => $request->get('avatar')
                ]);

                if($c){
                    return Response()->json([
                        'status' => 'true',
                        'message' => 'Customer created successfully',
                        'token' => $user->createToken('Api Token')->plainTextToken,
                    ]);
                }else{
                    return Response()->json([
                      'status' => 'false',
                      'message' => 'Customer cannot be created',

                    ]);
                }
            }
        }else{
            return Response()->json([
              'status' => 'false',
              'message' => 'User already exist!'
            ]);
        }
    }

    public function updateCustomer(Request $request,$id){
        $validateData = Validator::make($request->all(),[
            'first_name' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'email' => 'nullable|string|email',
            'phone' => 'nullable',
            'address' => 'nullable|string',
            'avatar' => 'nullable|string',
        ]);

        if($validateData->fails()){
            return response()->json([
                'status' => 'false',
                'message' => 'validation failed',
                'errors' => $validateData->errors()
              ]
            );
        }

        $user = User::find($id);

        if($user){
            $user->update([
                'first_naqme' => $request->get('first_name') ? $request->get('first_name') : $user->first_name,
                'last_name' => $request->get('last_name') ? $request->get('last_name') : $user->last_name,
                'email' => $request->get('email') ? $request->get('email') : $user->email,
            ]);

            $user->save();
            // $user->phone = $request->get('phone');
            // $user->address = $request->get('address');
            // $user->avatar = $request->get('avatar');
            $customer = Customer::find($id);

            $result = $customer->update([
                'first_naqme' => $request->get('first_name') ? $request->get('first_name') : $customer->first_name,
                'last_name' => $request->get('last_name') ? $request->get('last_name') : $customer->last_name,
                'email' => $request->get('email') ? $request->get('email') : $customer->email,
                'phone' => $request->get('phone') ? $request->get('phone') : $customer->phone,
                'address' => $request->get('address') ? $request->get('address') : $customer->address,
                'avatar' => $request->get('avatar') ? $request->get('avatar') : $customer->avatar,
                'updated_now' => now(),
            ]);

            if($result){
                return response()->json([
                    'status' => 'true',
                    'message' => 'User Update successfully.',
                  ]
                );
            }else{
                return response()->json([
                    'status' => 'false',
                    'message' => 'Cannot update user informaiton.',
                  ]
                );
            }
        }
        return response()->json([
            'status' => 'false',
            'message' => 'User not found.',
          ]
        );
    }

    public function getCustomers(){
        $customers = Customer::all();

        return Response(compact('customers'));
    }

    public function loginUser(Request $request){
      $validateData = Validator::make($request->all(),[
        'email' => 'required|string|email',
        'password' => 'required|string|'
      ]);

      if($validateData->failed()){
        return response()->json([
          'status' => 'false',
          'message' => 'validate error',
          'errors' => $validateData->errors()
        ]);
      }

      if(!Auth::attempt($request->only(['email', 'password']))){
        return response()->json([
          'status' => 'false',
          'message' => 'Email or Password is incorrect',
        ]);
      }

      $user = User::where('email','=',$request->get('email'))->first();

      return response()->json([
        'status' => 'true',
        'message' => 'User logged in successfully',
        'token' => $user->createToken('Api Token')->plainTextToken,
      ]);

    }

    public function getCustomer(Request $request){
      $validateData = Validator::make($request->all(),[
        'first_name' => 'required|string',
        'last_name' => 'required|string',
      ]);

      if($validateData->failed()){
        return response()->json([
          'status' => 'false',
          'message' => 'validation error',
          'errors' => $validateData->errors()
        ]);
      }

      $customer = Customer::with('user')->where(
        'first_name', $request->get('first_name'))
        ->where('last_name', $request->get('last_name'))
        ->first();

      if(!$customer){
        return response()->json([
          'status' => 'false',
          'message' => 'Customer was not found',
        ]);
      }

      return response()->json([
        'status' => 'true',
        'message' => 'Customer Retrieve Successfully',
        'customer' => $customer
      ]);
    }
    public function getCustomerById($id){
      $customer = Customer::find($id);

      if(!$customer){
        return response()->json([
          'status' => 'false',
          'message' => 'No Cusotmer',
        ]);
      }

      return response()->json([
        'status' => 'true',
        'message' => 'Customer Retrieve Successfully',
        'customer' => $customer
      ]);
    }
    public function getAllCustomer(){

      $customers = Customer::all();

      if(sizeof($customers)==0){
        return response()->json([
          'status' => 'false',
          'message' => 'No Cusotmer',
        ]);
      }

      return response()->json([
        'status' => 'true',
        'message' => 'Customer Retrieve Successfully',
        'customers' => $customers
      ]);
    }

    public function getCustomerP(Request $request){
      $validateData = Validator::make($request->all(),[
        'first_name' => 'required|string',
        'last_name' => 'required|string',
      ]);

      if($validateData->failed()){
        return response()->json([
          'status' => 'false',
          'message' => 'validation error',
          'errors' => $validateData->errors()
        ]);
      }

      $customer = Customer::with('products','product')->where(
        'first_name', $request->get('first_name'))
        ->where('last_name', $request->get('last_name'))
        ->first();

      if(!$customer){
        return response()->json([
          'status' => 'false',
          'message' => 'Customer\'s Products was not found',
        ]);
      }

      return response()->json([
        'status' => 'true',
        'message' => 'Customer\'s Products Retrieve Successfully',
        'customer' => $customer
      ]);
    }

    public function getCustomersProduct(){
      $customer = Customer::with('product.pinformations')->get();

      $customers = [];

      foreach($customer as $c){
          if(sizeof($c['product'])){
            $customers[] = $c;
          }
      }

      if(!$customers){
        return response()->json([
          'status' => 'false',
          'message' => 'No Customer have ordered any products'
        ]);
      }

      return response()->json([
        'status' => 'true',
        'message' => 'Successfully Retrieve Customer\'s Products',
        'customers' => $customers
      ]);
    }
    public function getCustomerCart($id){
      $customer = Customer::with('product.pinformations')->find($id);

      if(!$customer){
        return response()->json([
          'status' => 'false',
          'message' => 'Customer not found!'
        ]);
      }

      return response()->json([
        'status' => 'true',
        'message' => 'Successfully Retrieve Customer\'s Products',
        'customers' => $customer
      ]);
    }
    public function getCustomersOrder(){
      $customer = Customer::with('ordersP')->get();

      $customers = [];

      foreach($customer as $c){
          if(sizeof($c['products'])){
            $customers[] = $c;
          }
      }

      if(!$customers){
        return response()->json([
          'status' => 'false',
          'message' => 'No Customer have ordered any products'
        ]);
      }

      return response()->json([
        'status' => 'true',
        'message' => 'Successfully Retrieve Customer\'s Products',
        'customer' => $customers
      ]);
    }

    public function deleteCustomer($id){
        $customer = Customer::find($id);
        $user = User::find($customer->user_id);

        if($user){
            if($user->delete()){
                return response()->json([
                    'message' => 'Customer deleted successfully',
                    'status' => 'true',
                ]);
            }

            return response()->json([
                'message' => 'Cannot delete customer',
                'status' => 'false',
            ]);
        }

        return response()->json([
            'message' => "Cannot find the customer",
            'status' => 'false',
        ]);
    }
}
