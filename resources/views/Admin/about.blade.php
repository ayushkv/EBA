@extends('layouts.admin_layout')
 
@section('style')
    <style>
        .fancy-flash {
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 1050;
        padding: 15px 20px;
        border-radius: 8px;
        background-color: #4caf50;
        color: white;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        opacity: 0;
        transform: translateY(-20px);
        animation: slideIn 0.5s forwards;
        }
        
        .fancy-flash .close {
        color: white;
        opacity: 0.8;
        font-size: 1.2rem;
        border: none;
        background: none;
        cursor: pointer;
        }
        
        .fancy-flash .close:hover {
        opacity: 1;
        }
        
        @keyframes slideIn {
        to {
        opacity: 1;
        transform: translateY(0);
        }
        }
        
        @keyframes fadeOut {
        to {
        opacity: 0;
        transform: translateY(-20px);
        }
        }
    </style>
    @endsection



@section('content')

@if (session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show fancy-flash" id="flash-message">
        {{session('success') }}
        </div>

@endif

<div class="container mt-4 d-flex justify-content-center">
    <div class="m-2">
        <h1>About Page</h1>
        <form action="{{route('about.post')}}" method="POST" enctype="multipart/form-data">
            @csrf
                <div class="form-group">
                    <label for="heading">Heading</label>
                    <input name="heading" type="text" class="form-control @error('heading') is-invalid @enderror" value="{{$about->heading}}">
                    <span class="text-danger">@error('heading') {{$message}} @enderror</span>
                </div>
                    <div class="form-group">
                        <label for="sub_heading">Sub Heading</label>
                        <input name="sub_heading" type="text" class="form-control @error('sub_heading') is-invalid @enderror" value="{{$about->sub_heading}}">
                        <span class="text-danger">@error('sub_heading') {{$message}} @enderror</span>
                    </div>

                <div class="form-group">
                    <label for="about_detail">About Detail</label>
                    <textarea id="about_detail"  name="about_detail" cols="30" rows="10" class="form-control editor1 @error('about_detail') is-invalid @enderror">{!! $about->about_detail !!}</textarea>
                    <span class="text-danger">@error('about_detail') {{$message}} @enderror</span>
                </div>

                <div class="form-group">
                    <label for="why_choose_us_detail">Why Choose Us Detail</label>
                    <textarea id="why_choose_us_detail" name="why_choose_us_detail" cols="30" rows="10" class="form-control editor1 @error('why_choose_us_detail') is-invalid @enderror ">{!! $about->why_choose_us_detail !!}</textarea>
                    <span class="text-danger">@error('why_choose_us_detail') {{$message}} @enderror</span>
                </div>

                <div class="form-group">
                    <label for="about_img">About Image</label><br>
                    <img src="{{asset('img/'.$about->about_image)}}" alt="about image" style="width: 20rem;height:20rem"><br><br>
                    <label for="new_about_img">Upload New About Image</label><br>
                    <input name="about_img" id="new_about_img" type="file" name="about_img">
                </div>
            <input type="submit" value="Update" name="submit" class="btn btn-warning">
        </form>
    </div>
</div>
@endsection


@section('script')
<script>
    setTimeout(function() {
    var flashMessage = document.getElementById('flash-message');
    if (flashMessage) {
    flashMessage.style.animation = 'fadeOut 0.5s forwards';
    setTimeout(function() {
    flashMessage.style.display = 'none';
    }, 400);
    }
    }, 4000);
    </script>   
@endsection