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
            'image' => 'required|image',
        ]);

        $path = $request->file('image')->store("public/images/style {$angka}");
        $imageUrl = asset('storage/' . $path);


        style::create([
            'color' => $request->color,
            'gender' => $request->gender,
            'gambar_path' => $path,
            'gambar_url' => $imageUrl,
        ]);

        return redirect()->route('style.index')->with('success', 'Post created successfully.');
    }
}
