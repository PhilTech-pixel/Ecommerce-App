<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\User;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Foreach_;

class HomeController extends Controller
{
    public function index()
    {
        $product = Product::all()->count();
        $user = User::where('usertype', 'user')->get()->count();
        $order = Order::all()->count();
        $delivered_order = Order::where('status', 'Delivered')->get()->count();
        return view('admin.dashboard', compact('user', 'product', 'order', 'delivered_order'));
    }
    public function home()
    {
        $product = Product::all();

        if (Auth::id()) {

            $user = Auth::user();
            $userid = $user->id;
            $count = Cart::where('user_id', $userid)->count();
        } else {
            $count = '';
        }
        return view('home.index', compact('product', 'count'));
    }

    public function home_login()
    {
        $product = Product::all();
        if (Auth::id()) {

            $user = Auth::user();
            $userid = $user->id;
            $count = Cart::where('user_id', $userid)->count();
        } else {
            $count = '';
        }
        return view('home.index', compact('product', 'count'));
    }

    public function product_details($id)
    {
        $data = Product::find($id);

        if (Auth::id()) {

            $user = Auth::user();
            $userid = $user->id;
            $count = Cart::where('user_id', $userid)->count();
        } else {
            $count = '';
        }

        return view('home.product_details', compact('data', 'count'));
    }

    public function add_cart($id)
    {
        $product_id = $id;
        $user = Auth::user();
        $user_id = $user->id;

        $data = new Cart;

        $data->user_id = $user_id;

        $data->product_id = $product_id;
        $data->save();


        toastr()->closeButton()->timeOut(5000)->addSuccess('Product Added to the Cart Successfully');
        return redirect()->back();
    }
    public function mycart()
    {


        if (Auth::id()) {

            $user = Auth::user();
            $userid = $user->id;
            $count = Cart::where('user_id', $userid)->count();
        } else {
            $count = '';
        }

        $cart = Cart::where('user_id', $userid)->get();

        return view('home.mycart', compact('count', 'cart'));
    }

    public function delete_cart(Request $request)
    {



        $data = Cart::findOrFail($request->id);
        $data->delete();



        # $data = Cart::find($id);
        #DB::delete('DELETE FROM carts WHERE id = $id');


        toastr()->closeButton()->timeOut(5000)->addSuccess('Product Removed From Cart Successfully');

        return redirect()->back();
    }

    public function confirm_order(Request $request)
    {
        $name = $request->name;

        $address = $request->address;

        $phone = $request->phone;

        $userid = Auth::user()->id;

        $cart = Cart::where('user_id', $userid)->get();



        foreach ($cart as $carts) {
            $order = new Order;

            $order->name = $name;

            $order->rec_address = $address;

            $order->phone = $phone;

            $order->user_id = $userid;

            $order->product_id = $carts->product_id;


            $order->save();
        }



        $cart_remove = Cart::where('user_id', $userid)->get();

        foreach ($cart_remove as $remove) {
            $data = Cart::find($remove->id);

            $data->delete();
        }

        #$order = Cart::first();
        toastr()->closeButton()->timeOut(5000)->addSuccess('Added Successfully');

        return redirect()->back();
    }

    public function myorders()
    {


        $user = Auth::user();
        $userid = $user->id;
        # $count = Order::where('user_id', $userid)->count();
        $count = Cart::where('user_id', $userid)->count();


        $data = Order::where('user_id', $userid)->get();


        return view('home.orders',  compact('count', 'data'));
    }

    public function display()
    {
        $product = Product::all();
        $user = Auth::user();
        $userid = $user->id;
        $count = Cart::where('user_id', $userid)->count();
        return view('home.display', compact('count', 'product'));
    }
}
