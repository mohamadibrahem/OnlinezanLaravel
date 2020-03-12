@extends('layouts.app')

@section('content')
   @section('title', 'Юрист')

   <div class="in-jurist">
      <div class="container-fluid">
         <div class="row">
            <div class="col-md-6 col-12 jurist-block jurist-block-img" style=" background:url({{asset('/uploads').'/'. $data['lawyer']['user']['profile_photo']}}) no-repeat center center; background-size:cover;">


            </div>
            <div class="col-md-6 col-12 jurist-block jurist-block-info" >

               <h2>{{$data['lawyer']['user']['lastname']}} {{$data['lawyer']['user']['firstname']}}</h2>
               <hr style="width: 20%; background: #005aad;">
               <p> <strong>Город:</strong> {{$data['lawyer']['city']['name']}} </p>
               <p><strong>Отрасль:</strong>
                  @php
                  $specialization_arr = [];
                  foreach ($data['specializations'] as $key => $specialization){
                     if(json_decode($data['lawyer']['specialization_id']) != null){
                        foreach (json_decode($data['lawyer']['specialization_id']) as $key => $spec){
                           if($specialization->id == $spec){
                              $specialization_arr[] = $specialization->name;
                           }
                        }
                     }
                  }

                  $check3 = '';
                  $check4 = '';
                  if(json_decode($data['lawyer']['service_types']) != null){
                     foreach (json_decode($data['lawyer']['service_types']) as $key => $value) {
                        if($value == "3"){
                           $check3 = 'Представительство в суде';
                        }
                        if($value == "4"){
                           $check4 = 'Аутсорсинг';
                        }
                     }

                  }

                  @endphp
                  {{rtrim(implode(', ', $specialization_arr), ',')}}

               </p>
               @if($check3 != '' || $check4 != '')
                  <p>
                     {{$check3}}
                     <br>
                     {{$check4}}
                  </p>
               @endif

               @if(json_decode($data['lawyer']['service_types']) != null)
                  @foreach (json_decode($data['lawyer']['service_types']) as $key => $value)
                     @if($value == "1")
                        <p><strong>Цена за онлайн консультацию:</strong> {{number_format($data['lawyer']['online_consultation_price'] , $data['lawyer']['online_consultation_price'] = 0 ,$data['lawyer']['online_consultation_price']= "." , $data['lawyer']['online_consultation_price'] = " " )}} тг</p>
                     @endif
                  @endforeach
               @endif

               @if(json_decode($data['lawyer']['service_types']) != null)
                  @foreach (json_decode($data['lawyer']['service_types']) as $key => $value)
                     @if($value == "2")

                        <p><strong>Цена за срочную консультацию:</strong> {{number_format($data['lawyer']['urgent_consultation_price'] , $data['lawyer']['urgent_consultation_price'] = 0 ,$data['lawyer']['urgent_consultation_price'] = "." , $data['lawyer']['urgent_consultation_price'] = " " )}} тг</p>
                     @endif
                  @endforeach
               @endif

               @if($data['lawyer']['video'] != null)
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#videoanketa">
                     Видеоанкета
                  </button>
               @endif

               @if(Auth::check())
                  @if(Auth::user()->role_id == 4)
                     <div class="call-button">
                        @if(json_decode($data['lawyer']['service_types']) != null)
                           @foreach (json_decode($data['lawyer']['service_types']) as $key => $value)
                              @if($value == "1")
                                 <a href="" class="btn btn-primary" data-toggle="modal" data-target="#onlineConsultationModal">Онлайн консультация</a>
                              @endif
                           @endforeach
                        @endif

                        @if(json_decode($data['lawyer']['service_types']) != null)
                           @foreach (json_decode($data['lawyer']['service_types']) as $key => $value)
                              @if($value == "2")
                                 <a href="{{route('lawyer_info', $data['lawyer']['id'])}}" class="btn btn-primary" data-id="{{$data['lawyer']['id']}}" data-toggle="modal" data-target="#urgentConsultationModal" id="urgent_consultation_order">Срочная консультация</a>
                              @endif
                           @endforeach
                        @endif
                     </div>
                  @endif
               @else
                  <div class="call-button">
                     @if(json_decode($data['lawyer']['service_types']) != null)
                        @foreach (json_decode($data['lawyer']['service_types']) as $key => $value)
                           @if($value == "2")
                              <a href="/login" class="btn btn-primary">Онлайн консультация</a>
                           @endif
                        @endforeach
                     @endif
                     @if(json_decode($data['lawyer']['service_types']) != null)
                        @foreach (json_decode($data['lawyer']['service_types']) as $key => $value)
                           @if($value == "2")
                              <a href="/login" class="btn btn-primary">Срочная консультация</a>
                           @endif
                        @endforeach
                     @endif
                  </div>
               @endif

            </div>
         </div>
         <div class="row">
            <div class="col-md-6 col-12 jurist-block jurist-block-info1">
               {{-- <h4 style="border-bottom: 1px solid #005aad;padding-bottom: 10px;">Биография</h4>
               <p>{{$data['lawyer']['biography']}}</p> --}}
               <h4 style="border-bottom: 1px solid #005aad;padding-bottom: 10px;">Образование</h4>
               <ul>
                  @foreach ($data['education'] as $value)
                     <li>{{$value->name}}</li>
                  @endforeach
               </ul>
            </div>

            <div class="col-md-6 col-12 jurist-block jurist-block-info2">
               <h4 style="border-bottom: 1px solid #fff;padding-bottom: 10px;">Опыт работы</h4>
               <div class="panel-group" id="accordion1">

                  @foreach ($data['experience'] as $value)
                     <div class="panel panel-default">
                        <div class="panel-heading">
                           <h4 class="panel-title">
                              <a data-toggle="collapse" data-parent="#accordion1" href="#collapse{{$value->id}}">&#9878;
                                 {{$value->name}}
                              </a>
                           </h4>
                        </div>
                        <div id="collapse{{$value->id}}" class="panel-collapse collapse">
                           <div class="panel-body">
                              <p>{{$value->description}}</p>
                           </div>
                        </div>
                     </div>
                  @endforeach

               </div>
            </div>
         </div>
      </div>
      <div class="counters">
         <div class="container">
            <div class="row">
               <div class="col-md-4 col-12 text-center">
                  <div class="counter" data-count="{{$online_consultation}}"></div>
                  <h4>провел онлайн консультации</h4>
               </div>
               <div class="col-md-4 col-12 text-center">
                  <div class="counter" data-count="{{$urgent_consultation}}"></div>
                  <h4>провел срочных консультации</h4>
               </div>
               <div class="col-md-4 col-12 text-center">
                  <div class="counter" data-count="150">0</div>
                  <h4>some text</h4>
               </div>
            </div>
         </div>
      </div>

   </div>

   @include('inner_page.lawyers.modal')

@endsection
