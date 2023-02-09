<?php

namespace App\Http\Controllers;

use App\Exports\InvoicesExport;
use App\Models\categories;
use App\Models\products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = products::all();
        return view('products.products', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = categories::all();
        return view('products.add_product', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'Product_name' => 'required',
            'color' => 'required',
            'brand' => 'required',
            'size' => 'required',
            'price' => 'required',
            'quantity' => 'required',

        ]);

        $requestData = $request->all();
        $fileName = time().$request->file('photo')->getClientOriginalName();
        $path = $request->file('photo')->storeAs('images',$fileName, 'public');
        $requestData["photo"] = 'storage/'.$path;
        $copy = 'storage/haha';
        File::copy($requestData["photo"], 'C:\xampp\htdocs\clothing-ecommerce\public\\'.$requestData["photo"]);
        products::create($requestData);

        session()->flash('Add', 'تم اضافة المنتج بنجاح');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */
    public function show(products $products)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product= products::where('id',$id)->first();
        $categories= categories::all();
        return view('products.edit_product', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request,[
            'Product_name' => 'required',
            'color' => 'required',
            'brand' => 'required',
            'size' => 'required',
            'price' => 'required',
            'quantity' => 'required',

        ]);
       $products = products::findOrFail($request->id);
       $oldPhoto = $products['photo'];


        unlink($oldPhoto);


       $requestData = $request->all();
        $fileName = time().$request->file('photo')->getClientOriginalName();
        $path = $request->file('photo')->storeAs('images',$fileName, 'public');
        $requestData["photo"] = 'storage/'.$path;



       $products->update($requestData);

       session()->flash('edit', 'تم تعديل المنتج بنجاح');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

        $id = $request->product_id;
        $product = products::where('id', $id)->first();
        $products = products::findOrFail($id);
       $oldPhoto = $products['photo'];
        unlink($oldPhoto);

        $product->delete();
         session()->flash('delete');
         return back();
    }

    
}
