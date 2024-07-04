<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\PInformation;
use App\Models\Product;
use App\Models\User;
use App\Models\UserCart;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    public function orderItem(Request $request,$id){
        $validate = Validator::make($request->all(),[
          'product_id' => 'required',
          'pinfo_id' => 'required',
          'quantity' => 'nullable',
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


        if( $request->has('quantity')){
            if($pinfo->quantity < $request->get('quantity')){
                return response()->json([
                    'status' => 'false',
                    'message' => 'Order is higher than in stock!'
                  ]);
            }
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
            if($c){
                $pinfo->quantity += $c->quantity;
            }
            $cart = UserCart::updateOrInsert([
                'user_id' => $customer->user_id,
                'product_id' => $request->get('product_id'),
                'pinfo_id' => $request->get('pinfo_id'),
            ],[
                'pinfo_id' => $request->get('pinfo_id'),
                'user_id' => $customer->user_id,
                'product_id' => $request->get('product_id'),
                'quantity' => $request->get('quantity'),
                'total' =>  $request->get('quantity') * $product->price,
                'updated_at' => now(),
                'created_at' => $c ? $c->created_at : now(),
            ]);
            if(!$cart){
              return response()->json([
                'status' => 'false',
                'message' => 'User Cart was not added!'
              ]);
            }

             // Update the quantity in pinfo
             if($request->has('quantity')){
                 $pinfo->quantity -= $request->get('quantity');
                 $pinfo->save();
             }

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

    public function UpdateQuantity(Request $request,$id){
        $customer = Customer::find($id);
        $pinfo = PInformation::find($request->get('pinfo_id'));
        $product = Product::find($request->get('product_id'));

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

        $c = UserCart::where('pinfo_id', $request->get('pinfo_id'))
            ->where('user_id', $customer->user_id)
            ->where('product_id', $request->get('product_id'))
            ->first();

        if($c){
            $pinfo->quantity += $c->quantity;
            $c->quantity = $request->get('quantity');
            $c->total = $request->get('quantity') * $product->price;

            $pinfo->save();
            if($c->save()){
                return response()->json([
                    'status' => 'true',
                    'message' => 'User cart quantity updated!'
                  ]);
                }
                return response()->json([
                    'status' => 'false',
                    'message' => 'User cart was not updated!'
                  ]);
        }

    }
    public function deleteCartById($id){
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

  public function checkout($id){
    $customerID = Customer::find($id);
    $order = Order::where('user_id', '=', $customerID->user_id)->get();

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
    $today = Carbon::today()->toDateString();
    $items = UserCart::whereDate('created_at', $today)->get();
    $orders = UserCart::with('pinfo','product','user')->get();

    if(sizeof($orders) == 0){
        return response()->json([
          'status' => 'false',
          'message' => 'No Ordered have been made!',
          'quantity' => 0,
          'todayItem' => 0
        ]);
    }

    return response()->json([
      'status' => 'true',
      'message' => 'Successfully retrieve all customer ordered!',
      'orders' => $orders,
      'quantity' => $orders->count(),
      'todayItem' => $items->count()
    ]);
  }
  public function CustomerOrdered($id){
    $customerID = Order::where('customer_id', $id)->first();
    $order = UserCart::with('pinfo','product','user')->where('user_id',$customerID->user_id)->get();

    if(sizeof($order) == 0){
        return response()->json([
          'status' => 'false',
          'message' => 'No Ordered have been made!',
        ]);
    }

    return response()->json([
      'status' => 'true',
      'message' => 'Successfully retrieve all customer ordered!',
      'order' => $order
    ]);
  }

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

    if(sizeof($orders) == 0){
        return response()->json([
            'status' => 'false',
            'message' => 'No Order was sold out!',
          ]);
    }

    return response()->json([
        'status' => 'true',
        'message' => 'Soldout order returned successfully',
        'orders' => $orders,
    ]);
  }
}
