@extends('layouts.admin_layout');

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

        .failed{
            background-color: rgb(230, 37, 37) !important;
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
        {{ session('success') }}
    </div>
@elseif (session()->has('failed'))
    <div class="alert alert-danger alert-dismissible fade show fancy-flash failed" id="flash-message">
        {{ session('failed') }}
    </div>
@endif



<div  class="container mt-4 d-flex justify-content-center">
    <div class="m-2">
        <h1>Change Admin Password</h1>
        <form action="{{route('changePass.post')}}" method="POST">
            @csrf
            <div class="form-group">
                <input type="password" name="current_password" class="form-control @error('current_password') is-invalid @enderror" placeholder="Enter Current Password">
                <span class="text-danger">@error('password') {{$message}} @enderror</span>
            </div>
            <div class="form-group">
                <input name="new_password" type="password" class="form-control @error('new_password') is-invalid @enderror" placeholder="Enter New Password">
                <span class="text-danger">@error('new_password') {{$message}} @enderror</span>
            </div>
            <div class="form-group">
                <input name="new_password_confirmation" type="password" class="form-control @error('new_password_confirmation') is-invalid @enderror" placeholder="Confirm New Password">
                <span class="text-danger">@error('new_password_confirmation') {{$message}} @enderror</span>
            </div>
            <input type="submit" value="submit" name="submit" class="btn btn-warning">
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