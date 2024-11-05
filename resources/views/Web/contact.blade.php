@extends('layouts.web_layout')


@section('style')
<style>
    .btn-close{
        margin-left : auto !important;
    }
    .alert{
        display: flex
    }
</style>
@endsection

@section('content')
    

    <!-- Hero Start -->
    <div class="container-fluid bg-primary p-5 bg-hero mb-5">
        <div class="row py-5">
            <div class="col-12 text-center">
                <h1 class="display-2 text-uppercase text-white mb-md-4">Contact</h1>
                <a href="{{route('home')}}" class="btn btn-primary py-md-3 px-md-5 me-3">Home</a>
                <a href="{{route('contact')}}" class="btn btn-light py-md-3 px-md-5">Contact</a>
            </div>
        </div>
    </div>
    <!-- Hero End -->


    <!-- Contact Start -->
    <div class="container-fluid p-5">
        <div class="mb-5 text-center">
            <h5 class="text-primary text-uppercase">Contact Us</h5>
            <h1 class="display-3 text-uppercase mb-0">Get In Touch</h1>
        </div>
        <div class="row g-5 mb-5">
            <div class="col-lg-4">
                <div class="d-flex flex-column align-items-center bg-dark rounded text-center py-5 px-3">
                    <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                        <i class="fa fa-map-marker-alt fs-4 text-white"></i>
                    </div>
                    <h5 class="text-uppercase text-primary">Visit Us</h5>
                    <p class="text-secondary mb-0">{{ $company_info->address }}</p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="d-flex flex-column align-items-center bg-dark rounded text-center py-5 px-3">
                    <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                        <i class="fa fa-envelope fs-4 text-white"></i>
                    </div>
                    <h5 class="text-uppercase text-primary">Email Us</h5>
                    <p class="text-secondary mb-0">{{ $company_info->email }}</p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="d-flex flex-column align-items-center bg-dark rounded text-center py-5 px-3">
                    <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                        <i class="fa fa-phone fs-4 text-white"></i>
                    </div>
                    <h5 class="text-uppercase text-primary">Call Us</h5>
                    <p class="text-secondary mb-0">{{ $company_info->phone }}</p>
                </div>
            </div>
        </div>
        <div class="row g-0">
            <div class="col-lg-6">
                <div class="bg-dark p-5">
                    <form id="contactForm" >
                        @csrf
                        <div class="row g-3">
                            <div class="col-6">
                                <input name="name" type="text" class="form-control bg-light border-0 px-4 @error('name') is-invalid @enderror" placeholder="Your Name" style="height: 55px;">
                                <span class="text-danger">@error('name') {{$message}} @enderror</span>
                            </div>
                            <div class="col-6">
                                <input name="email" type="email" class="form-control bg-light border-0 px-4 @error('email') is-invalid @enderror" placeholder="Your Email" style="height: 55px;">
                                <span class="text-danger">@error('email') {{$message}} @enderror</span>
                            </div>
                            <div class="col-12">
                                <input name="subject" type="text" class="form-control bg-light border-0 px-4 @error('subject') is-invalid @enderror" placeholder="Subject" style="height: 55px;">
                                <span class="text-danger">@error('subject') {{$message}} @enderror</span>
                            </div>
                            <div class="col-12">
                                <textarea name="message" class="form-control bg-light border-0 px-4 py-3 @error('message') is-invalid @enderror" rows="4" placeholder="Message"></textarea>
                                <span class="text-danger">@error('message') {{$message}} @enderror</span>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary w-100 py-3" type="submit">Send Message</button>
                            </div>
                        </div>
                    </form>
                    <div id="responseMessage" class="mt-3"></div>   
                </div>
            </div>
            <div class="col-lg-6">
                <iframe class="w-100"
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3001156.4288297426!2d-78.01371936852176!3d42.72876761954724!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4ccc4bf0f123a5a9%3A0xddcfc6c1de189567!2sNew%20York%2C%20USA!5e0!3m2!1sen!2sbd!4v1603794290143!5m2!1sen!2sbd"
                    frameborder="0" style="height: 457px; border:0;" allowfullscreen="" aria-hidden="false"
                    tabindex="0"></iframe>
            </div>
        </div>
    </div>
    <!-- Contact End -->


    @endsection


    @section('script')
        <script>
            // $(document).ready(function(){
                $('#contactForm').on('submit',function(e){
                    e.preventDefault(); //prevent the default form submission
                    $.ajax({
                        url : "{{route('contact.post')}}" , //Route to handle the submission
                        method : 'POST',
                        data : $(this).serialize(),
                        success : function(response){
                            $('#responseMessage').html('<div class="alert alert-success">' + response.message + ' <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' + '</div>');
                            $('#contactForm')[0].reset();
                        
                        },
                        error : function(xhr){
                            $('#responseMessage').html('<div class="alert alert-danger">' + (xhr.responseJSON.message) + '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' + '</div>');
                        }
                    });
                })
            // })
        </script>
    @endsection


