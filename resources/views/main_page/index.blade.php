@extends('layouts.app')

@section('main_page')


   <div id="one" class="full-page-slider">
      @include('main_page.slider')
   </div>


   <div id="two" class="page">
      <div class="container padding-top">
         @include('main_page.services_1')
      </div>
   </div>
   <div id="three" class="page">
      <div class="container padding-top">
         @include('main_page.services_2')
      </div>
   </div>
   <div id="four" class="page">
      @include('main_page.specialists')
   </div>






@endsection



