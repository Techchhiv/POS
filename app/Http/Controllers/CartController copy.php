<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\PInformation;
use App\Models\Product;
use App\Models\UserCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    public function orderItem(Request $request,$id){
        $validate = Validator::make($request->all(),[
          'product_id' => 'required',
          'pinfo_id' => 'required',
          'quantity' => 'required',
        ]);

        $customer = Customer::find($id);
        $product = Product::find($request->get('product_id'));
        $pinfo = PInformation::find($request->get('pinfo_id'));

        if(!$customer){
            return response()->json([
              'status' => 'false',
              'message' => 'Customer not found!'
            ]);
        }

        if(!$product){
            return response()->json([
              'status' => 'false',
              'message' => 'Product not found!'
            ]);
        }

        if(!$pinfo->id){
            return response()->json([
              'status' => 'false',
              'message' => 'Product information not found!'
            ]);
        }
        dd($pinfo);
        $order = Order::updateOrInsert([
            'user_id'=> $customer->id,
            'customer_id'=> $customer->user_id,
        ],[
            'customer_id' => $customer->id,
            'user_id' => $customer->user_id,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        if($pinfo->quantity >= $request->get('quantity')){
            $pinfo->quantity = $pinfo->quantity - $request->get('quantity');
        }
        else{
            return response()->json([
                'status' => 'false',
                'message' => 'Order is higher than in stock!'
              ]);
        }

        if($order){
          $cart = UserCart::updateOrCreate([
            'pinfo_id' => $request->get('pinfo_id'),
            'user_id' => $customer->user_id,
            'product_id' => $request->get('product_id')
          ],[
            'user_id' => $customer->user_id,
            'product_id' => $request->get('product_id'),
            'pinfo_id' => $request->get('pinfo_id'),
            'quantity' => $request->get('quantity'),
            'total' => $request->get('quantity') * $product->price,
            'updated_at' => now(),
            'created_at' => now()
          ]);
          if($cart){
            $pinfo->save();
            if($pinfo->quantity == 0){
              $pinfo->delete();
            }

            return response()->json([
              'status' => 'true',
              'message' => 'User cart added!'
            ]);
          }
        }

        return response()->json([
          'status' => 'false',
          'message' => 'Error with order'
        ]);
    }

  public function checkout($id){
    $order = Order::where('user_id', '=', $id)->get();

    if(sizeof($order) == 0){
        return response()->json([
          'status' => 'false',
          'message' => 'Customer Ordered was not found!',
        ]);
    }

    foreach($order as $o){
      $o->customer_id = null;
      $o->updated_at = now();
      $o->save();
    }

    return response()->json([
      'status' => 'true',
      'message' => 'Customer checkout succesfully!',
    ]);
  }

  public function allCustomerOrdered(){
    $orders = Customer::with('ordersP','product')->get();

    if(sizeof($orders) == 0){
        return response()->json([
          'status' => 'false',
          'message' => 'No Ordered have been made!',
        ]);
    }

    return response()->json([
      'status' => 'true',
      'message' => 'Successfully retrieve all customer ordered!',
      'orders' => $orders
    ]);
  }
}
