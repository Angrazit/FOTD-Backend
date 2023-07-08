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
    if($request->isMethod('post')){
        $bookData = $request->all();

        foreach($bookData['forms'] as $key => $value){
            $book = new product;
            $book->style_id = $value['style_id'];
            $book->category = $value['category'];
            $book->deskripsi = $value['deskripsi'];
            $book->link_toko = $value['link_toko'];
            $path2 = $value['image_file']->store("public/images/style {$value['style_id']}");
            $path = $value['image_file']->store("public/images/style {$value['style_id']}");
            $imageUrl = asset('storage/' . $path);
            $book->link_local = $path2;
            $book->link_gambar = $imageUrl;
            $book->save();
        }
        return response()->json(['message'=>'Books added Successfully']);
    }
}

    public function show($id)
    {
        $products = Product::where('style_id', $id)->get();
        $styles = style::find($id);
        return view('admin.style.show', compact('products', 'styles'));
    }

    public function index()
    {
        return Product::all();
    }
    public function showproduct($id)
    {
        $products = Product::where('style_id', $id)->get();
        return response()->json([$products]);
    }

    public function sending(Request $request, $id)
    {
        $style = style::find($id);
        $count = $request->input('count');

        return view('admin.product.CreateComponent', ['style' => $style, 'count' => $count]);
    }
}
