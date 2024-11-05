<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        return view('index');
    }

    public function indexPost(Request $req){
        $image = $req->file('img');
        $imageName = $image->getClientOriginalName();
        $image->move(public_path('img2'),$imageName);
        return redirect()->back();
    }

    
}