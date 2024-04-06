<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator as FacadesValidator;

class ProductController extends Controller
{
    //show product
    public function index()
    {
        $products = Product::orderBy("created_at", "DESC")->get();
        return view("products.list", [
            "products" => $products
        ]);

    }

    // create product
    public function create()
    {
        return view("products.create");
    }

    // store product
    public function store(Request $request)
    {
        $rules  = [
            "name" => "required|min:5",
            "sku" => "required|min:3",
            "price" => "required|numeric",
        ];

        if($request->image !=""){
            $rules["image"] = "image";
        }

        $validator = FacadesValidator::make($request->all(),$rules);

        if($validator->fails()){
            return redirect()->route("products.create")->withInput()->withErrors($validator);
        }

        $product = new Product();
        $product->name = $request->name;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->save();

        if($request->image != ""){
            // here we store image
            $image = $request->image;
            $ext = $image->getClientOriginalExtension();
            $imageName = time().'.'.$ext; // unique image name

            // save image to product directory
            $image->move(public_path("uploads/products"), $imageName);

            // save image to databases
            $product->description = $imageName;
            $product->save();
        }
        return redirect()->route("products.index")->with("success", "Producced added success");
    }

    // edit product
    public function edit()
    {
    }

    // update product
    public function update()
    {
    }

    // delete product
    public function destroy()
    {
    }
}
