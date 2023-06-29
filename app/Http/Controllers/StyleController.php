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

        return view('admin.index',compact('styles'));
    }
}
