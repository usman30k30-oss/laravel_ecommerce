<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        //$products = Product::all();
        $search = request('search');
        $category = request('category');
        $sort = request('sort');

        $products = Product::when($search, function ($q) use ($search)
        {
            $q->where('name', 'like', '%' . $search . '%');
        })->when($category, function ($q) use ($category)
        {
            $q->where('category_id', $category);
        })->when($sort, function ($q) use ($sort) 
        {
            if ($sort == 'price_asc') $q->orderBy('price', 'asc');
            if ($sort == 'price_desc') $q->orderBy('price', 'desc');
            if ($sort == 'name') $q->orderBy('name', 'asc');
        })->paginate(10);

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
        ]);
        $product = new Product();

        $product->name = $request->name;
        $product->price = $request->price;

        //Image files 
        if ($request->hasFile('image')) {

            if ($product->image && file_exists(public_path('uploads/products/'.$product->image))) {
                unlink(public_path('uploads/products/'.$product->image));
            }

            $filename = time() . '_' . $request->image->getClientOriginalName();
            $request->image->move(public_path('uploads/products'), $filename);
            $product->image = $filename;

        }
        $product->category_id = $request->category_id;
        $product->description = $request->description;

        $product->save();
        
        return redirect('/products')->with('success', 'Product saved successfully');
    }

    public function edit($id)
    {
        $product = Product::find($id);
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
        ]);
        
        $product = Product::find($id);

        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;

        if ($request->hasFile('image')) {

            $filename = time().'_'.$request->image->getClientOriginalName();

            $request->image->move(public_path('uploads/products'), $filename);

            $product->image = $filename;
        }

        $product->category_id = $request->category_id;

        $product->save();

        return redirect('/products')->with('success', 'Product updated successfully');
    }

    public function delete($id)
    {
        $product = Product::find($id);

        if ($product) {
            $product->delete();
        }

        return redirect('/products')->with('success', 'Product deleted successfully');        
    }

/*** public function search()
{
    $search = request('search');

    if (!$search) {
        return redirect('/products');
    }

    $products = Product::where('name', 'like', '%' . $search . '%')->get();

    return view('admin.products.index', compact('products'));
} ***/
}
