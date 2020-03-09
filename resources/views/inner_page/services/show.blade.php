@extends('layouts.app')

@section('content')
   @section('title', $data['service']['name'])

   <div class="content-service">
      <div class="container-fluid">
         <div class="row">
            <div class="col-12 col-md-7 ">
               <div class="information">
                  <h3>Общая информация</h3>
                  <hr>
                  <p>{!!$data['service']['description']!!}</p>
                  <br>
                  <h3>Часто задаваемые вопросы</h3>
                  <hr>
                  <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                     @foreach($data['questions'] as $key => $value)
                        <div class="panel panel-default">
                           <div class="panel-heading active" role="tab" id="heading{{$value->id}}">
                              <h4 class="panel-title">
                                 <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$value->id}}" aria-expanded="true" aria-controls="collapse{{$value->id}}">
                                    {{$value->title}}
                                    
                                 </a>
                              </h4>
                           </div>
                           <div id="collapse{{$value->id}}" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="{{$value->id}}">
                              <div class="panel-body">
                                 {{$value->text}}
                              </div>
                           </div>
                        </div>
                     @endforeach

                  </div>
               </div>
            </div>
            <div class="col-12 col-md-5">
               <div class="juristers items">

                  @foreach ($data['lawyers'] as $key => $item)
                     <a href="{{route('lawyers.show', $item->id)}}" class="item">
                        <div class="card " style="max-width: 540px;">
                           <div class="row no-gutters">
                              <div class="col-md-4 image">
                                 <img src="{{asset('/uploads').'/'.$item->user['profile_photo']}}" class="card-img" alt="...">
                              </div>
                              <div class="col-md-8">
                                 <div class="card-body">
                                    <h5 class="card-title">{{$item->user['lastname']}} {{$item->user['firstname']}}</h5>
                                    <p class="card-text">
                                       @php
                                       $specialization_arr = [];
                                       foreach ($data['specializations'] as $key => $specialization){
                                          foreach (json_decode($item->specialization_id) as $key => $spec){
                                             if($specialization->id == $spec){
                                                $specialization_arr[] = $specialization->name;
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
   </div>

@endsection
