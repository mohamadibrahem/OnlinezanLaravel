@extends('layouts.app')

@section('content')

   @section('title', 'Авторизация')

   <div class="container">

      <div id="login" class="mt-5 mb-5">
         <div id="login-row" class="row justify-content-center align-items-center">
            <div id="login-column" class="col-md-6">
               <div id="login-box" class="col-md-12">
                  <form id="login-form" class="form" action="" method="POST" action="{{ route('login') }}">
                     {{csrf_field()}}
                     {{-- <h3 class="text-center">Войти</h3> --}}
                     <div class="form-group">
                        <label for="username" class="text-primary{{ $errors->has('email') ? ' has-error' : '' }}">Email:</label><br>
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                     </div>
                     <div class="form-group">
                        <label for="password" class="text-primary{{ $errors->has('email') ? ' has-error' : '' }}">Пароль:</label><br>
                        <input id="password" type="password" class="form-control" name="password" required>
                     </div>
                     <div class="form-group">
                        {{-- <label for="remember-me" class="text-info"><span>Remember me</span> <span><input id="remember-me" name="remember-me" type="checkbox"></span></label><br> --}}
                        <input type="submit" name="submit" class="btn btn-primary btn-md" value="Войти">
                     </div>
                     {{-- <div id="register-link" class="text-right">
                     <a href="#" class="text-info">Register here</a>
                  </div> --}}
               </form>
            </div>
         </div>
      </div>
   </div>

</div>
@endsection
