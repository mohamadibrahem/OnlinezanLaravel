@extends('layouts.app')

@section('content')
   @section('title', 'Новости')

   <div class="content-news pt-4 pb-4">
      <div class="container ">

         <div class="items">
            @foreach ($news as $value)
               <div class="row item">
                  <div class="group-left">
                     <div class="title">
                        <h4>{{$value->title}}</h4>
                     </div>
                  </div>

                  <div class="group-right">
                     <div class="text">
                        <p>{!!substr($value->text, 0,200)!!}</p>
                     </div>
                     <div class="link">
                        <a href="{{route('news.show', $value->id)}}">Подробнее</a>
                     </div>
                  </div>
               </div>
            @endforeach

         </div>


      </div>
   </div>

@endsection
