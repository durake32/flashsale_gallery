<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cart\AddToCart;
use App\Http\Requests\Cart\UpdateCart;
use App\Models\Product;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function cart()
    {
       $userId = auth()->user()->id; // or any string represents user identifier
       $cartCollection = \Cart::session($userId)->getContent();
        $minimum_amt = SiteSetting::findOrFail(1)->minimum_amount;
        return view('Frontend.Cart.index')->with(['cartCollection' => $cartCollection,'minimum_amt'=>$minimum_amt]);
    }

    public function index()
    {
        return view('Frontend.Cart.index');
    }

    public function add(AddToCart $request)
    {
      $userId = auth()->user()->id; // or any string represents user identifier
      
        $productID = $request->id;
        $product = Product::where('id', $productID)->firstOrFail();

        $productImage = 'Asset/Uploads/Products/' . $product->main_image;

        $quantity = 1;

        $productSlug = $product->slug;


        if (Auth::guard('retailer')->check()) {
            if ($product->sale_price) {
                $unitPrice = $product->sale_price;
            } else {
                $unitPrice = $product->regular_price;
            }
        } elseif (Auth::guard('admin')->check()) {
            if ($product->sale_price) {
                $unitPrice = $product->sale_price;
            } else {
                $unitPrice = $product->regular_price;
            }
        } elseif (Auth::user()) {
            if (Auth::user()->is_wholesaler == 1) {
                $unitPrice = $product->wholesaler_price;
            } else {
                if ($product->sale_price) {
                    $unitPrice = $product->sale_price;
                } else {
                    $unitPrice = $product->regular_price;
                }
            }
        }

          \Cart::session($userId)->add(array(
            'id' => $productID,
            'name' => $product->name,
            'price' => $unitPrice,
            'quantity' => $quantity,
            'slug' => $productSlug,
            'attributes' => array(
                'image' => $productImage,
                'slug' => $productSlug
            )
        ));
        return redirect()->route('cart.index')->with('success_msg', 'Item is Added to Cart!');
    }

    public function addFromProductPage(AddToCart $request)
    {

        $productID = $request->id;
        $product = Product::where('id', $productID)->firstOrFail();

        // dd($product);

        $productImage = 'Asset/Uploads/Products/' . $product->main_image;

        $quantity = $request->quantity;

        $productSlug = $product->slug;

        if (Auth::guard('retailer')->check()) {
            if ($product->sale_price) {
                $unitPrice = $product->sale_price;
            } else {
                $unitPrice = $product->regular_price;
            }
        } elseif (Auth::guard('admin')->check()) {
            if ($product->sale_price) {
                $unitPrice = $product->sale_price;
            } else {
                $unitPrice = $product->regular_price;
            }
        } elseif (Auth::user()) {
            if (Auth::user()->is_wholesaler == 1) {
                $unitPrice = $product->wholesaler_price;
            } else {
                if ($product->sale_price) {
                    $unitPrice = $product->sale_price;
                } else {
                    $unitPrice = $product->regular_price;
                }
            }
        }


        $userId = auth()->user()->id; // or any string represents user identifier
          \Cart::session($userId)->add(array(
            'id' => $productID,
            'name' => $product->name,
            'price' => $unitPrice,
            'quantity' => $quantity,
            'attributes' => array(
                'image' => $productImage,
                'slug' => $productSlug
            )
        ));
        return redirect()->route('cart.index')->with('success_msg', 'Item is Added to Cart!');
    }

    public function addindexPageCart(Request $request)
    {
        $productID = $request->id;
        $product = Product::where('id', $productID)->first();

        // dd($product);

        $productImage = 'Asset/Uploads/Products/' . $product->main_image;

        $quantity = $request->quantity;

        $productSlug = $product->slug;

        if (Auth::guard('retailer')->check()) {
            if ($product->sale_price) {
                $unitPrice = $product->sale_price;
            } else {
                $unitPrice = $product->regular_price;
            }
        } elseif (Auth::guard('admin')->check()) {
            if ($product->sale_price) {
                $unitPrice = $product->sale_price;
            } else {
                $unitPrice = $product->regular_price;
            }
        } elseif (Auth::user()) {
            if (Auth::user()->is_wholesaler == 1) {
                $unitPrice = $product->wholesaler_price;
            } else {
                if ($product->sale_price) {
                    $unitPrice = $product->sale_price;
                } else {
                    $unitPrice = $product->regular_price;
                }
            }
        }


        $userId = auth()->user()->id; // or any string represents user identifier
       $cart =  \Cart::session($userId)->add(array(
            'id' => $productID,
            'name' => $product->name,
            'price' => $unitPrice,
            'quantity' => $quantity,
            'attributes' => array(
                'image' => $productImage,
                'slug' => $productSlug
            )
        ));
      
        return redirect()->route('cart.index')->with('success_msg', 'Item is Added to Cart!');
    }

    public function remove(Request $request)
    {
      $userId = auth()->user()->id; // or any string represents user identifier
       \Cart::session($userId)->remove($request->id);
        return redirect()->route('cart.index')->with('success_msg', 'Item is removed!');
    }

    public function update(UpdateCart $request)
    {
      $userId = auth()->user()->id; // or any string represents user identifier
       \Cart::session($userId)->update(
            $request->id,
            array(
                'quantity' => array(
                    'relative' => false,
                    'value' => $request->quantity
                ),
            )
        );
        return redirect()->route('cart.index')->with('success_msg', 'Cart is Updated!');
    }

    public function clear()
    {
        \Cart::clear();
        return redirect()->route('cart.index')->with('success_msg', 'Car is cleared!');
    }
}