<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Symfony\Contracts\Service\Attribute\Required;

class productData extends Controller
{
    public function stored(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'image' => 'required'
        ]);



        $input = $request->all();

        if ($request->hasFile('image')) {
            $image = rand(1000, 9999) . '.' . $request->image->extension();
            $path = $request->image->storeAs('image', $image, 'public');
            $input['image'] = 'storage/' . $path;
        }

        $product = Product::create($input);
        $success['status'] = 200;
        $success['message'] = 'product inserted successfully';
        return response()->json(['success' => $success]); 
    }

    public function getProduct()
    {
        $product = Product::all();

        $success['status'] = 200;
        $success['message'] = 'done';
        $success['data'] = $product;

        return response()->json(['success' => $success]);
    }


    public function gets_product()
    {
        $products = Product::all();

        return view('first', compact('products'));
    }

    public function updateProduct(Request $request, $id)
    {
        $product = Product::find($id);

        if ($product) {
            if ($request->name) {
                $product->name = $request->name;
            }
            if ($request->description) {
                $product->description = $request->description;
            }
            if ($request->price) {
                $product->price = $request->price;
            }
            if ($request->quantity) {
                $product->quantity = $request->quantity;
            }

            $product->save();

            $success['status'] = 200;
            $success['message'] = 'Product update Successfuly';
            $success['data'] = $product;
            return response()->json(['success' => $success]);
        } else {
            $success['status'] = 400;
            $success['message'] = 'User no found';
            return response()->json(['error' => $success]);
        }
    }


    public function delproduct($id)
    {
        $product = Product::find($id);
        $product->delete();
        $success['status'] = 200;
        $success['message'] = 'product delete Successfuly';
        $success['data'] = $product;
        return response()->json(['success' => $success]);
    }


    // web

    public function remove_product($id)
    {
        $product = Product::find($id);
        $product->delete();

        return redirect('/first')->with('status', 'delete data succcessfully');
    }



    public function edit_product(Request $request, $id)
    {
        $product =  Product::find($id);

        if ($product) {
            if ($request->name) {
                $product->name = $request->name;
            }
            if ($request->description) {
                $product->description = $request->description;
            }
            if ($request->price) {
                $product->price = $request->price;
            }
            if ($request->quantity) {
                $product->quantity = $request->quantity;
            }

            if ($request->hasFile('image')) {
                $image = rand(1000, 9999) . '.' . $request->image->extension();
                $path = $request->image->storeAs('image', $image, 'public');
                $product->image = 'storage/' . $path;
            }

            $product->save();

            return redirect('/first')->with('status', 'Data update succcessfully');
        }
    }


    public function add(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'image' => 'required'
        ]);

        $input = $request->all();

        if ($request->hasFile('image')) {
            $image = rand(1000, 9999) . '.' . $request->image->extension();
            $path = $request->image->storeAs('image', $image, 'public');
            $input['image'] = 'storage/' . $path;
        }
        $add_product = Product::create($input);

        return redirect('/first')->with('status', ' Product added  succcessfully');
    } 
}
