<?php

namespace App\Http\Controllers;

use App\Models\style;
use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        if ($request->isMethod('post')) {
            $bookData = $request->all();

            foreach ($bookData['forms'] as $key => $value) {
                $book = new product;
                $book->style_id = $value['style_id'];
                $book->category = $value['category'];
                $book->deskripsi = $value['deskripsi'];
                $book->link_toko = $value['link_toko'];
                $path2 = $value['image_file']->store("public/images/style {$value['style_id']}");
                $path = $value['image_file']->store("/images/style {$value['style_id']}");
                $imageUrl = asset('storage/' . $path);
                $book->link_local = $path2;
                $book->link_gambar = $imageUrl;
                $book->save();
            }
            return response()->json(['message' => 'Books added Successfully']);
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
        if ($products->isEmpty()) {
            return response()->json(null);
        }
        return response()->json([$products]);
    }

    public function sending(Request $request, $id)
    {
        $style = style::find($id);
        $count = $request->input('count');

        return view('admin.product.CreateComponent', ['style' => $style, 'count' => $count]);

        return view('admin.style.show', compact('products', 'styles'));
    }

    public function showstyleid($id)
    {
        $products = Product::where('style_id', $id)->get();
        return response()->json([$products]);
    }

    public function showproductid($id)
    {
        $products = Product::where('style_id', $id)->get();
        return response()->json($products);
    }

    public function delete($id)
    {
        $product = Product::find($id);
        if ($product->link_gambar) {
            // Delete the image file from storage
            Storage::delete($product->link_gambar);
            Storage::delete($product->link_local);
        }
        $product->delete();

    }

    public function perbarui(Request $request, $id)
    {
        $request->validate([
            'imageFile' => 'required',
        ]);

        $file = $request->file('imageFile');
        $style = $request->input('style_id');
        $product = Product::find($id);
        if ($product->link_gambar) {
            // Delete the image file from storage
            Storage::delete($product->link_gambar);
            Storage::delete($product->link_local);
        }

        $path2 = $file->store("public/images/style {$style}");
        $imagePath = $file->store("images/style {$style}");
        $imageUrl = asset('storage/' . $imagePath);
        $product->link_local = $path2 ;
        $product->link_gambar = $imageUrl;
        $product->save();

        return response()->json(['message' => 'Product image updated successfully'], 200);
    }

    public function updatecomponent($id, Request $request)
    {
        // dd($request->all());
        $request->validate([
            'deskrip' => 'required',
            'link_toko' => 'required',
            // 'imageFile' => 'image', // Adjust the file validation rule as per your requirements
        ]);

        // Find the product
        $product = Product::find($id);

        // Update the product data
        $product->deskripsi = $request->input('deskrip');
        $product->link_toko = $request->input('link_toko');

        // Save the updated product
        $product->save();

        return response()->json(['message' => 'Product updated successfully'], 200);
    }


}
