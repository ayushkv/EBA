<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Admin;
use App\Models\Inquiry;
use App\Models\CompanyInfo;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function dashboard(){
        return view('Admin.dashboard');
    }

    public function inquiry(){
        $inqs = Inquiry::orderBy('id','desc')->get();
        return view('Admin.inquiry',compact('inqs'));
    }

    public function removeInq($id){
        $inq = Inquiry::find($id);
        $inq->delete();
        return response()->json([
            'message' => 'Inquiry deleted successfully :)'
        ]);
    }

    public function about(){
        $about = About::first();
        return view('Admin.about',compact('about'));
    }

    public function aboutPost(Request $req){
        $validated = $req->validate([
            'heading' => 'required',
            'sub_heading' => 'required',
            'about_detail' => 'required',
            'why_choose_us_detail' => 'required',
        ]);

        if($validated){
            $about = About::first();
            $about->heading = $req->heading;
            $about->sub_heading = $req->sub_heading;
            $about->about_detail = $req->about_detail;
            $about->why_choose_us_detail = $req->why_choose_us_detail;

            //Handle Image Upload If It Exists
            if($req->hasFile('about_img')){
                
                //Remove Existing About Image
                $oldImagePath = public_path('img/'.$about->about_image);
                if(file_exists($oldImagePath)){
                    unlink($oldImagePath);
                }
                //Now Upload new About Image
                $image = $req->file('about_img');
                $imageName = time().'.'.$image->getClientOriginalExtension();
                $image->move(public_path('img'),$imageName);
                $about->about_image = $imageName;
            }

            $about->save();
            return redirect()->back()->with('success','About Page Updated Successfully');
        }
    }

    public function companyInfo(){
        $company_info = CompanyInfo::first();
        return view('Admin.company_info',compact('company_info'));
    }

    public function companyInfoPost(Request $req){
        $validated = $req->validate([
        'address' => 'required',
        'email' => 'required',
        'phone' => 'required'
        ]);

        if($validated){
            $company_info = CompanyInfo::first();
            $company_info->address = $req->address;
            $company_info->email = $req->email;
            $company_info->phone = $req->phone;
            $company_info->save();
            return redirect()->back()->with('success','Compnay Information Updated Successfully!');
        }

    }

    public function testimonial(){
        $testimonials = Testimonial::all();
        return view('Admin.testimonial',compact('testimonials'));
    }

    public function testimonialAdd(Request $req){
            $validated = $req->validate([
                'name' => 'required',
                'review' => 'required'
            ]);

            if($validated){
                $testimonial = new Testimonial();
                $testimonial->name = $req->name;
                $testimonial->review = $req->review;

                //Handle Upload Image
                if($req->hasFile('new_client_img')){

                //Upload New Client Image
                $image = $req->file("new_client_img");
                $imageName = time().'.'.$image->getClientOriginalExtension();
                $image->move(public_path('img'),$imageName);
                $testimonial->client_img = $imageName;
            }
            $testimonial->save();
            return redirect()->back()->with('success','Testimonial Added Successfully');

            }
    }

    public function testimonialEdit(Request $req,$id){
        $validated = $req->validate([
            'name' => 'required',
            'review' => 'required'
        ]);

        if($validated){

            $testimonial = Testimonial::find($id);
            $testimonial->name = $req->name;
            $testimonial->review = $req->review;

            //Handle Image Upload
            if($req->hasFile('new_client_img')){

                //Remove Existing Image
                $oldImagePath = public_path('img/'.$testimonial->client_img);
                if(file_exists($oldImagePath)){
                    unlink($oldImagePath);
                }

                //Upload New Client Image
                $image = $req->file("new_client_img");
                $imageName = time().'.'.$image->getClientOriginalExtension();
                $image->move(public_path('img'),$imageName);
                $testimonial->client_img = $imageName;
            }

            $testimonial->save();
            return redirect()->back()->with('success','Testimonial updated successfully');

        }
    }

    public function testimonialRemove($id){
        $testimonial = Testimonial::find($id);
        $testimonial->delete();
        return response()->json([
            'message' => 'Testimonial Removed Successfully',
        ]);
    }

    public function login(){
        return view('Admin.login');
    }

    public function loginPost(Request $req){
        $credentials = $req->validate([
           'username' => 'required|email|max:255',
           'password' => 'required|max:255',
        ]);
// dd(Auth::guard('admin')->attempt($credentials));
        if(Auth::guard('admin')->attempt($credentials)){
            return redirect()->route('dashboard');
        }else{
            return redirect()->back()->with('failed','invalid credentials');
        }
    }

    public function logout(){
         Auth::guard('admin')->logout();
         return redirect()->route('admin.login');
    }

    public function changePassword(){
        return view('Admin.changePass');
    }

    public function changePasswordPost(Request $req){
        $validated = $req->validate([
            'current_password' => 'required|max:10|min:5',
            'new_password' => 'required|max:10|min:5|confirmed',
            'new_password_confirmation' => 'required|max:10|min:5',
        ]);
        
        if($validated){
            $admin = Auth::guard('admin')->user();
            if(Hash::check($req->current_password,$admin->password)){
            $admin->password =  Hash::make($req->new_password); 
            $admin->save();
            return redirect()->back()->with('success','password updated successfully');
            }else{
                return redirect()->back()->with('failed','please enter correct password');
            }
        }
    
    }

}