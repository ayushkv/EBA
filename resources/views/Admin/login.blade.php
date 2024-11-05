<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Login Page with Background Image Example</title>
  <link rel="stylesheet" href="{{asset('css/admin-style.css')}}">
  <style>
    .fancy-flash {
    position: fixed;
    top: 20px;
    right: 20px;
    z-index: 1050;
    padding: 15px 20px;
    border-radius: 8px;
    background-color: #c54c43;
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

    input::-webkit-inner-spin-button{
      appearance: none;
      margin: none;
    }
</style>
</head>
<body>
    @if (session()->has('failed'))
    <div class="alert alert-danger alert-dismissible fade show fancy-flash" id="flash-message">
        {{session('failed') }}
        </div>
@endif
<!-- partial:index.partial.html -->
<div id="bg"></div>

<form action="{{route('login.post')}}" method="POST">
    @csrf
  <div class="form-field">
    <input name="username" type="email" placeholder="Email / Username" class="form-control @error('username') is-invalid @enderror" required/>
    <span style="color: #db1a0c;font-weight:bolder">@error('username') {{$message}}* @enderror</span>
  </div>
  
  <div class="form-field">
    <input name="password" type="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror" required/>
    <span style="color: #db1a0c;font-weight:bolder">@error('password') {{$message}}* @enderror</span>
  </div>
  
  <div class="form-field">  
    <button class="btn" type="submit">Log in</button>
  </div>
</form>
<!-- partial -->
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
  
  <script>
    $(function(){
      $('.editor1').summernote()
    })
  </script>
</body>
</html>
