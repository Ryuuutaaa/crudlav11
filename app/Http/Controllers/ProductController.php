<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator as FacadesValidator;

class ProductController extends Controller
{
    //show product
    public function index()
    {
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

        $validator = FacadesValidator::make($request->all(),$rules);

        if($validator->fails()){
            return redirect()->route("products.create")->withInput()->withErrors($validator);
        }
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
