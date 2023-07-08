<?php

namespace App\Http\Controllers;

use App\Models\style;
use Illuminate\Http\Request;

class StyleController extends Controller
{
    //
    public function index(Request $request)
    {
        $styles = style::all();
        return view('admin.style.index',compact('styles'));
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
        $styles->gender= $request->input('gender');
        $styles->category= $request->input('category');
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
        return view('admin.style.show', compact('style'));
    }

    public function view()
    {
        return style::all();
    }


}
