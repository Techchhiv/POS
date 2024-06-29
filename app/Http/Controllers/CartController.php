<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\PInformation;
use App\Models\Product;
use App\Models\User;
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
<<<<<<< HEAD
          'quantity' => 'nullable',
=======
          'quantity' => 'required',
>>>>>>> 5a3a02ee4411f2d88c5ee71db2a902940e95ec8a
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


        if(!$pinfo){
            return response()->json([
              'status' => 'false',
              'message' => 'Product information not found!'
            ]);
        }


<<<<<<< HEAD
        if( $request->has('quantity')){
            if($pinfo->quantity < $request->get('quantity')){
                return response()->json([
                    'status' => 'false',
                    'message' => 'Order is higher than in stock!'
                  ]);
            }
=======
        if($pinfo->quantity < $request->get('quantity')){
            return response()->json([
                'status' => 'false',
                'message' => 'Order is higher than in stock!'
              ]);
>>>>>>> 5a3a02ee4411f2d88c5ee71db2a902940e95ec8a
        }

        $order = Order::updateOrInsert([
            'user_id'=> $customer->id,
            'customer_id'=> $customer->user_id,
        ],[
            'customer_id' => $customer->id,
            'user_id' => $customer->user_id,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        if($order){
            $c = UserCart::where('pinfo_id', $request->get('pinfo_id'))
            ->where('user_id', $customer->user_id)
            ->where('product_id', $request->get('product_id'))
            ->first();
            $cart = UserCart::updateOrInsert([
                'user_id' => $customer->user_id,
                'product_id' => $request->get('product_id'),
                'pinfo_id' => $request->get('pinfo_id'),
            ],[
                'pinfo_id' => $request->get('pinfo_id'),
                'user_id' => $customer->user_id,
                'product_id' => $request->get('product_id'),
                'quantity' => $c ? $c->quantity + $request->get('quantity') : $request->get('quantity'),
                'total' => $request->get('quantity') * $product->price,
                'updated_at' => now(),
<<<<<<< HEAD
                'created_at' => $c ? $c->created_at : now(),
=======
                'created_at' => now()
>>>>>>> 5a3a02ee4411f2d88c5ee71db2a902940e95ec8a
            ]);
            if(!$cart){
              return response()->json([
                'status' => 'false',
                'message' => 'User Cart was not added!'
              ]);
            }

             // Update the quantity in pinfo
<<<<<<< HEAD
             if($request->has('quantity')){
                 $pinfo->quantity -= $request->get('quantity');
                 $pinfo->save();
             }
=======
             $pinfo->quantity -= $request->get('quantity');
             $pinfo->save();
>>>>>>> 5a3a02ee4411f2d88c5ee71db2a902940e95ec8a

            return response()->json([
              'status' => 'true',
              'message' => 'User cart added!'
            ]);

        }

        return response()->json([
          'status' => 'false',
          'message' => 'Error with order'
        ]);
    }

    public function deleteCart(Request $request, $id){
        $validate = Validator::make($request->all(),[
            'product_id' => 'required',
            'pinfo_id' => 'required',
          ]);

        if($validate->fails()){
            return response()->json([
                'status' => 'false',
                'message' => 'Validator Error!',
                'error' => $validate->errors()
              ]);
        }

        $customer  = Customer::find($id);
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

        if(!$pinfo){
            return response()->json([
              'status' => 'false',
              'message' => 'Product information not found!'
            ]);
        }

        $cart = UserCart::where('user_id', $id)
        ->where('pinfo_id', $request->get('pinfo_id'))
        ->where('product_id', $request->get('product_id'))
        ->first();

        if($cart){
            $cart->delete();
            return response()->json([
                'status' => 'true',
                'message' => 'Product delete!',
              ]);
        }

        return response()->json([
            'status' => 'false',
            'message' => 'Product not found!',
          ]);
    }
<<<<<<< HEAD
    public function deleteOrderCart(Request $request, $id){
        $cart = UserCart::find($id);

        if($cart){
            $cart->delete();
            return response()->json([
                'status' => 'true',
                'message' => 'Product delete!',
              ]);
        }

        return response()->json([
            'status' => 'false',
            'message' => 'Product not found!',
          ]);
    }
=======
>>>>>>> 5a3a02ee4411f2d88c5ee71db2a902940e95ec8a

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
<<<<<<< HEAD
    $orders = UserCart::with('pinfo','product','user')->get();
=======
    $orders = Customer::with('ordersP','product')->get();
>>>>>>> 5a3a02ee4411f2d88c5ee71db2a902940e95ec8a

    if(sizeof($orders) == 0){
        return response()->json([
          'status' => 'false',
          'message' => 'No Ordered have been made!',
        ]);
    }

<<<<<<< HEAD


=======
>>>>>>> 5a3a02ee4411f2d88c5ee71db2a902940e95ec8a
    return response()->json([
      'status' => 'true',
      'message' => 'Successfully retrieve all customer ordered!',
      'orders' => $orders
    ]);
  }
<<<<<<< HEAD

  public function changeStatusOrder($id){
    $order = UserCart::find($id);

    if($order){
        $order->status = 1;
        $order->save();

        return response()->json([
            'status' => 'true',
            'message' => 'Update Status successfully',
          ]);
    }

    return response()->json([
        'status' => 'false',
        'message' => 'Order not found!',
      ]);
  }
  public function soldOutProduct(){
    $orders = UserCart::with('pinfo','product','user')->where('status','1')->get();

    if(sizeof($orders)){
        return response()->json([
            'status' => 'true',
            'message' => 'Soldout order returned successfully',
            'orders' => $orders,
        ]);
    }

    return response()->json([
        'status' => 'false',
        'message' => 'No Order was sold out!',
      ]);
  }
=======
>>>>>>> 5a3a02ee4411f2d88c5ee71db2a902940e95ec8a
}
