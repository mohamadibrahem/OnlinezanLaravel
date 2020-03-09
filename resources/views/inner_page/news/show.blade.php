@extends('layouts.app')

@section('content')
   @section('title', 'Новости')

   <div class="content-news pt-4 pb-4">
      <div class="container ">

         <div class="items">
            <div class="row item">
               <div class="group-left">
                  <div class="title">
                     <h4>{{$news->title}}</h4>
                  </div>
               </div>

               <div class="group-right">
                  <div class="text">
                     <p>{!!$news->text!!}</p>
                  </div>
               </div>
            </div>

         </div>


      </div>
   </div>

@endsection
