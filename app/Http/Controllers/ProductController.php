<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ProductController extends Controller
{
    //
    public function create(Request $req)
    {
        $user = $req->user("api");
        if(!empty($user))
        {
            $product = Product::create([
                'name'=>$req->name,
                'sku'=>$req->sku,
                'price'=>$req->price,
                'user_id'=>$user->id,
            ]);

            if(!empty($product))
            {
                return ['state'=>true ,'message'=>"Product Created"];
            }
            return ['state'=>false ,'message'=>"Product Not Created"];
        }
        return ['state'=>false, 'message'=>"User is not logged in"];
    }

    public function getProduct(Request $req,int $id)
    {
        $user = $req->user('api');
        if(!empty($user))
        {
            $product = Product::with('user')->findOrFail($id);
            if(Gate::forUser($user)->allows('view-product',$product))
            {
                if(!empty($product))
                {
                    return ['state'=>true,'msg'=>$product];
                }
            }
        }
        return ['state'=>false];
    }

    public function getAllProducts(Request $req)
    {
        $user = $req->user('api');
        if(!empty($user))
        {
            $products = Product::where('user_id', $user->id)->get();
            if(!empty($products))
            {
                return ["state"=>true, 'msg'=>$products];
            }

        }
        return ['state'=>false, 'msg'=>[]];
    }

    public function updateProduct(Request $req, int $id)
    {
        $user = $req->user('api');
        if(!empty($user))
        {
            $product = Product::findorFail($id);
            if(Gate::forUser($user)->allows('edit-product',$product))
            {
                $name = $req->input('name');
                $sku = $req->input('sku');
                $price = $req->input('price');

                $product->update([
                    'name'=>$name,
                    'sku'=>$sku,
                    'price'=>$price
                ]);
                return ['state'=>true, 'msg'=>$product];
            }
            return ['state'=>false];
        }
    }

    public function destroy(Request $req, int $id)
    {
        $user = $req->user('api');
        if(!empty($user))
        {
            $product = Product::findOrFail($id);
            if(!empty($product))
            {
                if($product->user_id === $user->id)
                {
                    $product->delete();
                    return ['state'=>true, 'message'=>'Product deleted'];
                }
                return ['state'=>false, 'message'=>'Product Not Found'];
            }

        }
        return ['state'=>false];
    }


}
