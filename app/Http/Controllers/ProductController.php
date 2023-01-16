<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::paginate('10');
        return view('product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            '*' => 'required'
        ]);

        Product::insert([
            'product_name' => $request->product_name,
            'product_purchase_price' => $request->product_purchase_price,
            'product_selling_price' => $request->product_selling_price,
            'product_quantity' => $request->product_quantity,
            'created_at' => Carbon::now()
        ]);

        return back()->with('success', 'Product Added Sueccessfully!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('product.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            '*' => 'required'
        ]);
        Product::find($product->id)->update([
            'product_name' => $request->product_name,
            'product_purchase_price' => $request->product_purchase_price,
            'product_selling_price' => $request->product_selling_price,
            'product_quantity' => $request->product_quantity
        ]);
        return back()->with('success', 'Product Updated Successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }

    public function deleteproduct ($id)
    {
        Product::findOrFail($id)->delete();
        return back()->with('success', 'Product Deleted Successfully!!');
    }

    public function trashproduct ()
    {

        return view('product.trash', [
            'trash_products' => Product::onlyTrashed()->paginate('10'),
        ]);
    }

    public function trashrestore ($id)
    {
        Product::onlyTrashed()->findOrFail($id)->restore();
        return back()->with('success', 'Product Resotred Successfully!!');
    }

    public function trashforcedelete (Request $request)
    {
        Product::onlyTrashed()->findOrFail($request->force_delete)->forceDelete();
        return response()->json([
            'status' => 'success',
        ]);
    }
}
