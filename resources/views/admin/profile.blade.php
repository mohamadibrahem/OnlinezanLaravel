@extends('admin.layouts.main')
@section('content')
  @section('title') {{"Профиль"}} @endsection

     {{Auth::user()->firstname}}

     <br>
     <br>

     {{Auth::user()->phone}}

     {{Auth::user()->email}}


    <!--Main layout-->
  @endsection
