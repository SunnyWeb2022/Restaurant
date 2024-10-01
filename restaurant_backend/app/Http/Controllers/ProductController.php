<?php

namespace App\Http\Controllers;

use App\Models\product;
use App\Http\Requests\StoreproductRequest;
use App\Http\Requests\UpdateproductRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Inertia\Inertia;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return response()->json(product::latest()->get());
        
    }

    public function laravelindex(Request $request)
    {
        return Inertia::render('products/Show_product',[
            'product' => product::all()
        ]);

    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
           $imageName = '';
            $image = $request->image;
            $destinationPath = public_path('/images/products');
            $imageName = time().'-'.uniqid().'.'.$image->getClientOriginalExtension(); 
            $image->move($destinationPath, $imageName);

        $product = product::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imageName,
            'price' => $request->price
        ]);

        return redirect(RouteServiceProvider::HOME);

    }

    /**
     * Display the specified resource.
     */
    public function show(product $product)
    {
        
        return Inertia::render('products/Add_product');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $editid = $request->input('id');
        $product = Product::find($editid);
        return redirect()->route('products.edit', ['id' => $editid]);
    }

    public function showEditPage($id)
    {
        $product = Product::find($id);

        return Inertia::render('products/Edit_product', [
            'edit_product' => $product
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
{

    $product = Product::find($id);

    if ($request->hasFile('image')) {
        if ($product->image && file_exists(public_path('/images/products/' . $product->image))) {
            unlink(public_path('/images/products/' . $product->image));
        }

        $image = $request->image;
        $destinationPath = public_path('/images/products');
        $imageName = time() . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
        $image->move($destinationPath, $imageName);
    } else {
        $imageName = $product->image;
    }

    $product->update([
        'title' => $request->title,
        'description' => $request->description,
        'image' => $imageName,
        'price' => $request->price,
    ]);



    
    return redirect()->route('Show_product')->with('success', 'Product updated successfully.');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $deleteid = $request->input('id');

        $product = product::find($deleteid);
        $product->delete();

        return redirect()->route('Show_product', ['id' => $deleteid]);
    }
}
