<?php

namespace App\Http\Controllers;

use App\Models\style;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StyleController extends Controller
{
    //
    public function index(Request $request)
    {
        $styles = style::all();
        return view('admin.style.index', compact('styles'));
    }

    public function create()
    {
        return view('admin.style.create');
    }

    public function store(Request $request)
    {
        $total = style::count();
        $angka = $total + 1;
        $request->validate([
            'image_style' => 'required|image',
        ]);

        $path = $request->file('image_style')->store("public/images/style {$angka}");
        $path2 = $request->file('image_style')->store("images/style {$angka}");
        $imageUrl = asset('storage/' . $path2);


        // style::create([
        //     'color' => $request->color,
        //     'gender' => $request->gender,
        //     'gambar_path' => $path,
        //     'gambar_url' => $imageUrl,
        // ]);

        $styles = new style();
        $styles->color = $request->input('style_color');
        $styles->gender = $request->input('gender');
        $styles->category = $request->input('category');
        $styles->gambar_path = $path;
        $styles->gambar_url = $imageUrl;
        $styles->save();
        $id = $styles->id;

        return response()->json(['id' => $id]);

        return redirect()->route('count.component', ['id' => $id])->with('success', 'Post created successfully.');
    }



    public function showing($id)
    {
        $style = Style::find($id);


        return response()->json([$style]);
    }

    public function show($id)
    {
        $style = style::find($id);
        return style::view(compact('style'));
    }

    public function view()
    {
        return style::all();
    }
    public function showproductid($id)
    {
        $idsArray = explode(',', $id);
        $styles = Style::find($id);
        return response()->json([$styles]);
    }
    public function delete($id)
    {
        $product = style::find($id);
        if ($product->link_gambar) {
            // Delete the image file from storage
            Storage::delete($product->gambar_path);
            Storage::delete($product->gambar_url);
        }
        $product->delete();
    }

    public function takeimage($id)
    {
        $product = style::find($id);

        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        return response()->json(['gambar_url' => $product->gambar_url]);
    }
}
