<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Review;
use App\Artikel;

class AllController extends Controller
{
    //

    public function review()
    {
    	$reviews = Review::orderBy('created_at', 'desc')->get();
    	return view('allreview',compact('review'));
    }

    public function artikel()
    {
    	$artikel = Artikel::with('Kategori')->orderBy('created_at', 'desc')->get();
    	return view('allartikel',compact('artikel'));
    }
}
