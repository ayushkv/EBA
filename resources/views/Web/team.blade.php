@extends('layouts.web_layout')
  
@section('content')

  <!-- Hero Start -->
    <div class="container-fluid bg-primary p-5 bg-hero mb-5">
        <div class="row py-5">
            <div class="col-12 text-center">
                <h1 class="display-2 text-uppercase text-white mb-md-4">Trainers</h1>
                <a href="{{route('home')}}" class="btn btn-primary py-md-3 px-md-5 me-3">Home</a>
                <a href="{{route('team')}}" class="btn btn-light py-md-3 px-md-5">Trainers</a>
            </div>
        </div>
    </div>
    <!-- Hero End -->


    <!-- Team Start -->
    <div class="container-fluid p-5">
        <div class="mb-5 text-center">
            <h5 class="text-primary text-uppercase">The Team</h5>
            <h1 class="display-3 text-uppercase mb-0">Expert Trainers</h1>
        </div>
        <div class="row g-5">
            <div class="w-100 d-flex justify-content-center">
                <div class="col-lg-3 col-md-6 m-2">
                    <div class="team-item position-relative">
                        <div class="position-relative overflow-hidden rounded">
                            <img class="img-fluid w-100" src="{{asset('img/team-1.jpg')}}" alt="">
                        </div>
                        <div class="position-absolute start-0 bottom-0 w-100 rounded-bottom text-center p-4" style="background: rgba(34, 36, 41, .9);">
                            <h5 class="text-uppercase text-light">John Deo</h5>
                            <p class="text-uppercase text-secondary m-0">Trainer</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 m-2">
                    <div class="team-item position-relative">
                        <div class="position-relative overflow-hidden rounded">
                            <img class="img-fluid w-100" src="{{asset('img/team-2.jpg')}}" alt="">
                        </div>
                        <div class="position-absolute start-0 bottom-0 w-100 rounded-bottom text-center p-4" style="background: rgba(34, 36, 41, .9);">
                            <h5 class="text-uppercase text-light">James Taylor</h5>
                            <p class="text-uppercase text-secondary m-0">Trainer</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Team End -->
    
@endsection