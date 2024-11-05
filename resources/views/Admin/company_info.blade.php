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
            <h1>Compnay Information</h1>
            <form action="{{route('companyInfo.post')}}" method="post">
                @csrf

                <div class="form-group">
                        <label for="address">address</label>
                        <textarea name="address" id="address" cols="30" rows="10" class="form-control editor1 @error('address') is-invalid @enderror">{!! $company_info->address !!}</textarea>
                        <span class="text-danger">@error('address') {{$message}} @enderror</span>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input name="email" id="email" type="text" class="form-control @error('email') is-invalid @enderror" value="{{$company_info->email}}">
                    <span class="text-danger">@error('email') {{$message}} @enderror</span>
                </div>

                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input name="phone" id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" value="{{$company_info->phone}}">
                    <span class="text-danger">@error('phone') {{$message}} @enderror</span>
                </div>

                <h2>Social Media</h2>
                <div class="row">
                    <div class="form-group">
                        <label for="youtube">Youtube</label>
                        <input name="youtube" id="youtube" type="text" class="form-control @error('youtube') is-invalid @enderror">
                        <span class="text-danger">@error('youtube') {{$message}} @enderror</span>
                    </div>
                    <div class="form-group ml-2">
                        <label for="instagram">Instagram</label>
                        <input name="instagram" id="instagram" type="text" class="form-control @error('instagram') is-invalid @enderror">
                        <span class="text-danger">@error('instagram') {{$message}} @enderror</span>
                    </div>
                </div>

                <input type="submit" class="btn btn-warning" value="update" name="update">
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