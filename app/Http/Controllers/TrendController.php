<?php

namespace App\Http\Controllers;

use App\Models\trend;
use Illuminate\Http\Request;

class TrendController extends Controller
{
    public function addtrend(Request $request)
    {
        // Find the product
        $trend = new trend;

        // Update the trend data
        $trend->style_id = $request->input('style_id');
        $trend->gambar_url = $request->input('gambar_url');

        // Save the updated trend
        $trend->save();

        return response()->json(['message' => 'trend updated successfully'], 200);
    }
    public function gettrend()
    {
        // Find the product
        return trend::all();
    }
    public function delete($id)
    {
        $product = trend::find($id);
        $product->delete();

    }

    public function deletewithstyle($id)
    {
        $products = trend::where('style_id', $id)->get();

        foreach ($products as $product) {
            $product->delete();
        }
    }
}
