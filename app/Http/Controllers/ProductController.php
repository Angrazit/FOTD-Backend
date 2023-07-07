<?php

namespace App\Http\Controllers;

use App\Models\product;
use App\Models\style;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function count($id)
    {
        $style = style::find($id);

        return view('admin.product.CountComponent', ['style' => $style]);
    }

    public function send(Request $request, $id)
    {
        $style = style::find($id);
        $count = $request->input('count');

        return view('admin.product.CreateComponent', ['style' => $style, 'count' => $count]);
    }

    public function storetodata(Request $request)
    {
        $alamat = $request->input('style_id');

        foreach ($request->file('images') as $key => $image) {

            $product = new product();


            $path = $image->store("public/images/style {$alamat}");
<<<<<<< HEAD
            $path2 = $image->store("images/style {$alamat}");
=======
            $path2 = $image->store("public/images/style {$alamat}");
>>>>>>> 1e40fab5345d7866a0052a96cd195da6da6cbe95
            $imageUrl = asset('storage/' . $path2);

            $product->style_id = $alamat;
            $product->catagory = $request->input("inputs.$key.category");
            $product->link_local = $path;
            $product->link_gambar = $imageUrl;
            $product->link_toko = $request->input("inputs.$key.toko");
            $product->deskripsi = $request->input("inputs.$key.deskripsi");
            $product->save();
        }

        return redirect()->route('style.index')->with('success', 'Post created successfully.');
    }

    public function show($id)
    {
        $data->products = Product::find('style_id', $id)->get();
        $data->styles = style::find($id);
        return response()->json($data);
        // $data = Product:: findOrFail($id);
        // return response()->json($data);
        
    }

    public function index(){
        return Product::all();

    }
}
