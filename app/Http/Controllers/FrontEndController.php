<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\product;
use Illuminate\Http\Request;

class FrontEndController extends Controller
{
    public function index()
    {
        $categories = category::all();
        $recentProducts = product::orderBy('created_at', 'desc')->take(8)->get();
        return view('welcome', [
            'categories' => $categories,
            'recentProducts' => $recentProducts
        ]);
    }
}
