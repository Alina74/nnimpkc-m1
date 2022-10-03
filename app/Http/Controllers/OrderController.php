<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function basket(Request $request)
    {
        $products=null;
        if($request->session()->has('basket')){
            $productIds=$request->session()->get('basket');
            $productIds=array_keys($productIds);
            $products=Product::whereIn('id', $productIds)->get();
        }
        return view('users.order.basket', compact('products'));
    }


    public function addBasket(Request $request)
    {
        $basket=[];
        if ($request->session()->has('basket'))
        $request->session()->get('basket');
        $basket[(int)$request->query('productId')]=1;
        $request->session()->put('basket', $basket);
        return back();
    }
}
