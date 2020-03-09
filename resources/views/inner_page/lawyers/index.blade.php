@extends('layouts.app')

@section('content')
   @section('title', 'Юристы')

   <div class="content-jurist">
      <div class="container">
         <div class="row">
            <div class="col-md-6 borders-right items">

               @foreach($data['lawyers'] as $item)
                  <a href="{{route('lawyers.show', $item->id)}}" class="item">
                     <div class="card ">
                        <div class="row no-gutters">
                           <div class="col-md-4 image">
                              @if($item->user['profile_photo'] != '')
                                 <img src="{{asset('/uploads').'/'.$item->user['profile_photo']}}" class="card-img" alt="...">
                              @endif
                           </div>
                           <div class="col-md-8">
                              <div class="card-body">
                                 <h5 class="card-title">{{$item->user['lastname']}} {{$item->user['firstname']}}</h5>
                                 <p class="card-text">
                                    @php
                                    $specialization_arr = [];
                                    foreach ($data['specializations'] as $key => $specialization){
                                       if(json_decode($item->specialization_id) != null){
                                          foreach (json_decode($item->specialization_id) as $key => $spec){
                                             if($specialization->id == $spec){
                                                $specialization_arr[] = $specialization->name;
                                             }
                                          }
                                       }
                                    }
                                    @endphp
                                    {{rtrim(implode(', ', $specialization_arr), ',')}}
                                 </p>
                              </div>
                           </div>
                        </div>
                     </div>
                  </a>
               @endforeach

            </div>
         </div>
      </div>
   </div>

@endsection
