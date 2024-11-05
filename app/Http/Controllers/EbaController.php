<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Inquiry;
use App\Models\CompanyInfo;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class EbaController extends Controller
{
    public function home(){
        $testimonials = Testimonial::all();
        return view('Web.index',compact('testimonials'));
    }

    public function team(){
        return view('Web.team');
    }

    public function class(){
        return view('Web.class');
    }

    public function about(){
        $about = About::first();
        return view('Web.about',compact('about'));
    }

    public function contact(){
        $company_info = CompanyInfo::first();
        return view('Web.contact',compact('company_info'));
    }

    public function contactPost(Request $req){
        $validated = $req->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|max:255',
            'message' => 'required|max:4000',
        ]);

        if($validated){
            $inquiry = new Inquiry();
            $inquiry->name = $req->name;
            $inquiry->email = $req->email;
            $inquiry->subject = $req->subject;
            $inquiry->message = $req->message;
            $inquiry->save();
            return response()->json([
                'message' => 'Inquiry Submitted Successfully',
            ]);
        }
    }
}