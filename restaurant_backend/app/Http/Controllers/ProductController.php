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
        // Fetch the product based on the ID
        $editid = $request->input('id');
        $product = Product::find($editid);
        // Redirect to the Inertia page with the product data
        return redirect()->route('products.edit', ['id' => $editid]);
    }

    public function showEditPage($id)
    {
        // Fetch the product
        $product = Product::find($id);

        // Render the Inertia page with the product data
        return Inertia::render('products/Edit_product', [
            'edit_product' => $product
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
{
    
    // Find the product by ID
    $product = Product::find($id);

    // dd($product->image);

    // $imageName = ''; 

    // if ($request->hasFile('image')) {
    //     $image = $request->image;
    //     dd($image);
    //     $destinationPath = public_path('/images/products');
    //     $imageName = time() . '-' . uniqid() . '.' . $image->getClientOriginalExtension(); 
    //     $image->move($destinationPath, $imageName);

        
    // }

    // $product->update([
    //     'title' => $request->title,
    //     'description' => $request->description,
    //     'image' => $imageName,
    //     'price' => $request->price,
    // ]);

    // Update product details
    $product->title = $request->title;
    $product->description = $request->description;
    $product->price = $request->price;

    
    // Handle the image upload
    if ($request->hasFile('image')) {
        // Delete the old image if it exists
        // dd($product->image);
        if ($product->image) {
            Storage::delete($product->image); // Adjust path if necessary
        }

        // Store the new image
        $path = $request->file('image')->store('images/products', 'public');
        $product->image = $path; // Save the path in the database
    }

    // Save the updated product
    $product->save();


    
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
