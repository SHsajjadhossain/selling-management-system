<?php

namespace App\Http\Controllers;

use App\Mail\SendInvoice;
use App\Models\Product;
use App\Models\Selling_info;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SellingInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_sellings = Selling_info::where('employee_id', auth()->id())->paginate('10');
        return view('selling_info.index', compact('all_sellings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('selling_info.create');
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
            '*' => 'required',
        ]);

        Selling_info::insert([
            'employee_id' => auth()->id(),
            'customer_name' => $request->customer_name,
            'customer_email' => $request->customer_email,
            'customer_phone' => $request->customer_phone,
            'product_name' => $request->product_name,
            'product_price' => $request->product_price,
            'product_quantity' => $request->product_quantity,
            'created_at' => Carbon::now(),
        ]);

        return back()->with('success', 'Selling Info Added Successfully!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Selling_info  $selling_info
     * @return \Illuminate\Http\Response
     */
    public function show(Selling_info $selling_info)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Selling_info  $selling_info
     * @return \Illuminate\Http\Response
     */
    public function edit(Selling_info $selling_info)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Selling_info  $selling_info
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Selling_info $selling_info)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Selling_info  $selling_info
     * @return \Illuminate\Http\Response
     */
    public function destroy(Selling_info $selling_info)
    {
        //
    }

    // public function getProductinfo(Request $request)
    // {
    //     $search = $request->product_name;

    //     if($search == ''){
    //      $products = Product::orderby('product_name','asc')->select('product_name, product_selling_price','')->limit(5)->get();
    //   }else{
    //      $products = Product::orderby('product_name','asc')->select('product_name','product_selling_price')->where('product_name', 'like', '%' .$search . '%')->limit(5)->get();
    //   }

    //   $response = array();
    //   foreach($products as $product){
    //      $response[] = array("value"=>$product->product_selling_price,"label"=>$product->product_name);
    //   }

    //   return response()->json($response);
    // }

    public function adminindex ()
    {
        return view('selling_info.adminindex',[
            'all_sellings' => Selling_info::paginate('10'),
        ]);
    }

    public function sendinvoice ($id)
    {
        $cusotmer_info = Selling_info::find($id);
        Mail::to($cusotmer_info->customer_email)->send(new SendInvoice($cusotmer_info));
        Selling_info::find($id)->update([
            'mail_status' => 1
        ]);

        return back();
    }
}
