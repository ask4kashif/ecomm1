<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Validator;


class CartController extends Controller
{
    public function index()
    {
        return view('cart.index');
    }
    public function store(Request $request,Cart $cart)
    {

        $duplicates=Cart::search(function ($cartItem, $rowId) use ($request){
            return $cartItem->id === $request->id;
        });
        if ($duplicates->isNotEmpty()) {
            return redirect()->back()->with('error','Product already in your cart!');
        }
        Cart::add($request->id,$request->name,1,$request->price)
        ->associate(Product::class);

        return redirect()->back()->with('success','Product added to cart');
    }
    public function destroy($rowId)
    {

        Cart::remove($rowId);
        return redirect()->back()->with('success','Product removed successfully');
    }
    public function switchToSaveForLater($id)
    {

        $item=Cart::get($id);
        Cart::remove($id);
        $duplicates=Cart::instance('saveForLater')->search(function ($cartItem, $rowId) use ($id){
            return $rowId === $id;
        });
        if ($duplicates->isNotEmpty()) {
            return redirect()->back()->with('error','Product already in your save for list!');
        }
        Cart::instance('saveForLater')->add($item->id,$item->name,1,$item->price)
        ->associate(Product::class);

        return redirect()->back()->with('success','Product added to save for later');
    }

    public function delete($rowId)
    {
        Cart::instance('saveForLater')->remove($rowId);
        return redirect()->back()->with('success','Product removed successfully');
    }
    public function moveToCart($id)
    {

        $item=Cart::instance('saveForLater')->get($id);

        Cart::instance('saveForLater')->remove($id);
        $duplicates=Cart::instance('default')->search(function ($cartItem, $rowId) use ($id){
            return $rowId === $id;
        });
        if ($duplicates->isNotEmpty()) {
            return redirect()->back()->with('error','Product already in your cart!');
        }
        Cart::instance('default')->add($item->id,$item->name,1,$item->price)
        ->associate(Product::class);

        return redirect()->back()->with('success','Product added to cart');
    }

    public function update(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            'quantity' => 'required|numeric|between:1,5'
        ]);
        if($validator->fails()){
            session()->flash('error','Quantity must be between 1 and 5');
            return response()->json(['success'=>false],500);
        }

        Cart::update($id,$request->quantity);

        session()->flash('success','Cart udpated successfully');
        return response()->json(['success'=>true]);
    }
}
