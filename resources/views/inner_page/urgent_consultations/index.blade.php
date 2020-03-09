@php
   use Carbon\Carbon;
@endphp
@extends('layouts.app')

@section('content')
   @section('title', 'Срочная консультация')

   <div class="content-urgent_consultations mt-5 mb-5">
      <div class="container">
         <h5>Открытые заявки</h5>
         <br>
         @if(count($consultations_open) != 0)
            <table class="table table-bordered">

               <thead>
                  <tr>
                     <th>Дата и время</th>
                     @if(Auth::user()->role_id == 3)
                        <th>Клиент</th>
                     @endif
                     @if(Auth::user()->role_id == 4)
                        <th>Юрист</th>
                     @endif
                     @if(Auth::user()->role_id == 3)
                        <th>Телефон</th>
                     @endif
                     @if(Auth::user()->role_id == 3)
                        <th>Email</th>
                     @endif
                     <th>Описание проблемы</th>
                     @if(Auth::user()->role_id == 3)
                        <th>Заключение</th>
                     @endif
                     {{-- <th>Статус</th> --}}
                     @if(Auth::user()->role_id == 4)
                        <th>Статус</th>
                        <th>Отмена</th>
                     @endif
                     <th></th>
                  </tr>
               </thead>

               <tbody>
                  @foreach ($consultations_open as $value)
                     <tr class="@if(Carbon::parse($value->received_datetime)->addMinutes(4320) < Carbon::now()) alert alert-danger @endif">
                        <td data-label="Дата и время">{{substr($value->created_at, 0, -3)}}</td>

                        @if(Auth::user()->role_id == 3)
                           <td data-label="Клиент"> {{$value->client['user']['lastname']}} {{$value->client['user']['firstname']}}</td>
                        @endif
                        @if(Auth::user()->role_id == 4)
                           <td data-label="Юрист">{{$value->lawyer['user']['lastname']}} {{$value->lawyer['user']['firstname']}}</td>
                        @endif
                        @if(Auth::user()->role_id == 3)
                           <td data-label="Телефон">{{$value->client_phone}}</td>
                        @endif
                        @if(Auth::user()->role_id == 3)
                           <td data-label="Email">{{$value->client['user']['email']}}</td>
                        @endif
                        {{-- <td>{{$value->status}}</td> --}}
                        <td data-label="Описание">
                           @if($value->description != '')
                              <a href="{{route('consultation_description', $value->id)}}" class="btn btn-primary description" data-toggle="modal" data-target="#urgentModal">Открыть</a>
                           @else
                              Отсутствует
                           @endif
                        </td>
                        @if(Auth::user()->role_id == 3)
                           <td data-label="Заключение">
                              <a href="{{route('consultation_conclusion_get', $value->id)}}" class="btn btn-primary conclusion" data-id="{{$value->id}}" data-toggle="modal" data-target="#urgentConclusionModal">@if($value->conclusion != null) Открыть @else Создать @endif</a>
                              </td>

                              <td data-label="Заключение">
                                 Срок до: {{Carbon::parse($value->received_datetime)->addMinutes(4320)->format('Y:m:d H:i')}}
                                 <br>
                                 @if(Carbon::parse($value->received_datetime)->addMinutes(4320) < Carbon::now())
                                    {{'Просрочена'}}
                                    <br>
                                    <br>
                                 @endif

                                 @if($value->status != 'success')
                                    <form method="POST" action="{{route('urgent_consultation_success', $value->id)}}" class="success_consultation">
                                       {{ csrf_field() }}
                                       <button class="btn btn-success p-1" type="submit">Завершить</button>
                                    </form>
                                 @endif
                              </td>

                           @endif

                           @if(Auth::user()->role_id == 4)
                              <td data-label="Статус" class="pt-3-half">

                                 @if($value->status == 'new') В обработке
                                 @elseif($value->status == 'cancelled') Отменен
                                 @elseif($value->status == 'success') Исполнено
                                 @else В исполнении
                                 @endif

                              </td>
                              <td>
                                 <form method="POST" action="{{route('urgent_consultation_delete', $value->id)}}" class="delete_consultation">
                                    {{ csrf_field() }}
                                    <button class="btn btn-danger pt-2 pb-2 pr-3 pl-3" type="submit"><i class="fas fa-times"></i></button>
                                 </form>
                              </td>
                           @endif
                        </tr>

                     @endforeach

                  </tbody>
               </table>
            @else
               Нет записей
            @endif
         </div>

         <br>
         <hr>
         <br>

         <div class="container">
            <h5>Завершенные заявки</h5>
            <br>
            <table class="table table-bordered">

               <thead>
                  <tr >
                     <th>Дата и время</th>
                     @if(Auth::user()->role_id == 3)
                        <th>Клиент</th>
                     @endif
                     @if(Auth::user()->role_id == 4)
                        <th>Юрист</th>
                     @endif
                     @if(Auth::user()->role_id == 3)
                        <th>Телефон</th>
                     @endif
                     @if(Auth::user()->role_id == 3)
                        <th>Email</th>
                     @endif
                     <th>Описание проблемы</th>
                     <th>Заключение</th>
                     {{-- <th>Статус</th> --}}
                  </tr>
               </thead>

               <tbody>
                  @foreach ($consultations_close as $value)
                     <tr class="@if(Carbon::parse($value->received_datetime)->addMinutes(4320) < Carbon::now()) alert alert-danger @endif">
                        <td data-label="Время и дата">{{substr($value->created_at, 0, -3)}}</td>

                        @if(Auth::user()->role_id == 3)
                           <td data-label="Клиент">{{$value->client['user']['lastname']}} {{$value->client['user']['firstname']}}</td>
                        @endif
                        @if(Auth::user()->role_id == 4)
                           <td data-label="Юрист">{{$value->lawyer['user']['lastname']}} {{$value->lawyer['user']['firstname']}}</td>
                        @endif
                        @if(Auth::user()->role_id == 3)
                           <td data-label="Телефон">{{$value->client_phone}}</td>
                        @endif
                        @if(Auth::user()->role_id == 3)
                           <td data-label="Email">{{$value->client['user']['email']}}</td>
                        @endif
                        {{-- <td>{{$value->status}}</td> --}}
                        <td data-label="Описание">
                           @if($value->description != '')
                              <a href="{{route('consultation_description', $value->id)}}" class="btn btn-primary description" data-toggle="modal" data-target="#urgentModal">Открыть</a>
                           @else
                              Отсутствует
                           @endif
                        </td>
                        @if(Auth::user()->role_id == 3)
                           <td>
                              @if(Carbon::parse($value->received_datetime)->addMinutes(4320) < Carbon::parse($value->closing_datetime))
                                 {{'Просрочена'}}
                                 <br>
                              @endif
                              @if($value->conclusion != null) <a href="{{route('consultation_conclusion_get', $value->id)}}" class="btn btn-primary conclusion" data-id="{{$value->id}}" data-toggle="modal" data-target="#urgentConclusionModal">Открыть </a>@endif
                                 @if($value->status != 'success')
                                    <form method="POST" action="{{route('urgent_consultation_success', $value->id)}}" class="success_consultation">
                                       {{ csrf_field() }}
                                       <button class="btn btn-success p-1" type="submit">Завершить</button>
                                    </form>
                                 @endif
                              </td>


                           @endif
                           @if(Auth::user()->role_id == 4)
                              <td >

                                 @if($value->conclusion != null)<a href="{{route('consultation_conclusion_get', $value->id)}}" class="btn btn-primary conclusion" data-id="{{$value->id}}" data-toggle="modal" data-target="#urgentConclusionModal"> Открыть</a>@endif
                                 </td>
                              @endif

                           </tr>
                        @endforeach
                     </tbody>
                  </table>
               </div>


            </div>

            @include('inner_page.urgent_consultations.modal')
         @endsection
