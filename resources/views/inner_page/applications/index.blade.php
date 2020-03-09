@php
use Carbon\Carbon;
@endphp

@extends('layouts.app')

@section('content')
   @section('title', 'Заявки на консультацию')

   <div class="content-application_consultations mt-5 mb-5">
      <div class="container">
         <h5>Открытые заявки</h5>
         <br>
         @if(Auth::check())
            @if(Auth::user()->role_id == 3)
               @if(count($consultations_open) != 0)
                  <table class="table table-bordered coming">

                     <thead>
                        <tr>
                           @if(Auth::user()->role_id == 3)
                              <th>Дата и время</th>
                              <th>Клиент</th>
                              <th>Телефон</th>
                              <th>Email</th>
                              <th>Детали</th>
                              <th>Статус</th>
                              <th>Заключение</th>
                              <th></th>

                           @endif
                        </tr>
                     </thead>

                     <tbody>
                        @foreach ($consultations as $value)
                           @if($value->status_id == 3)
                              <tr class="@if($value->status_id == 4) alert alert-success  @elseif($value->status_id == 5) alert alert-danger @endif @if(Carbon::parse($value->received_datetime)->addMinutes(4320) < Carbon::now()) alert alert-danger @endif">

                                 <td data-label="Дата и время">
                                    {{substr($value->created_at, 0, -3)}}
                                 </td>

                                 <td data-label="Клиент">
                                    {{$value->client_name}}
                                 </td>
                                 <td data-label="Телефон">
                                    {{$value->client_phone}}
                                 </td>
                                 <td data-label="Email">
                                    {{$value->client_email}}
                                 </td>
                                 <td data-label="Детали">
                                    <a href="{{route('application_detail', $value->id)}}" class="btn btn-primary detail" data-id="{{$value->id}}" data-toggle="modal" data-target="#ApplicationDetailModal">Открыть</a>
                                 </td>
                                 <td data-label="Статус">
                                    Срок до: {{Carbon::parse($value->received_datetime)->addMinutes(4320)->format('Y:m:d | H:i')}}
                                    <hr>
                                    @if(Carbon::parse($value->received_datetime)->addMinutes(4320) < Carbon::now())
                                       {{'Просрочена'}}
                                    @else
                                       {{$value->status['name']}}
                                    @endif
                                 </td>
                                 <td data-label="Заключение">
                                    @if($value->status_id != 5)
                                       <a href="{{route('application_conclusion_get', $value->id)}}" class="btn btn-primary conclusion" data-id="{{$value->id}}" data-toggle="modal" data-target="#ApplicationConclusionModal">
                                          @if($value->conclusion != null)
                                             Открыть
                                          @else
                                             Создать
                                          @endif
                                       </a>

                                    @endif
                                 </td>

                                 <td>
                                    <form action="{{route('application_update', $value->id)}}" method="post">
                                       {{csrf_field()}}
                                       <button type="submit" class="btn btn-primary p-1">Завершить</button>
                                    </form>
                                 </td>

                              </tr>
                           @endif
                        @endforeach
                     </tbody>
                  </table>
               @else
                  Нет записей
               @endif
            @endif
         @endif

      </div>

      <br>
      <hr>
      <br>
      @if(Auth::check())
         @if(Auth::user()->role_id == 3)
            @if(count($consultations_close) != 0)
               <div class="container">
                  <h5>Закрытые заявки</h5>
                  <br>
                  <table class="table table-bordered completed">

                     <thead>
                        <tr>
                           @if(Auth::user()->role_id == 3)
                              <th class="text-center">Дата и время</th>
                              <th class="text-center">Клиент</th>
                              <th class="text-center">Телефон</th>
                              <th class="text-center">Email</th>
                              <th class="text-center">Детали</th>
                              <th class="text-center">Статус</th>
                              <th class="text-center">Заключение</th>
                           @endif
                        </tr>
                     </thead>

                     <tbody>
                        @foreach ($consultations as $value)
                           @if($value->status_id == 4)
                              <tr class="@if(Carbon::parse($value->received_datetime)->addMinutes(4320) < Carbon::parse($value->closing_datetime)) alert alert-danger @endif">
                                 <td data-label="Дата и время">
                                    {{substr($value->created_at, 0, -3)}}
                                 </td>
                                 <td  data-label="Клиент">
                                    {{$value->client_name}}
                                 </td>
                                 <td  data-label="Телефон">
                                    {{$value->client_phone}}
                                 </td>
                                 <td  data-label="Email">
                                    {{$value->client_email}}
                                 </td>
                                 <td  data-label="Детали">
                                    <a href="{{route('application_detail', $value->id)}}" class="btn btn-primary detail" data-id="{{$value->id}}" data-toggle="modal" data-target="#ApplicationDetailModal">Открыть</a>
                                 </td>
                                 <td  data-label="Статус">
                                    @if(Carbon::parse($value->received_datetime)->addMinutes(4320) < Carbon::parse($value->closing_datetime))
                                       {{'Просрочена'}}
                                    @else
                                       {{$value->status['name']}}
                                    @endif
                                 </td>
                                 <td  data-label="Заключение">
                                    @if($value->status_id != 4)
                                       <a href="{{route('application_conclusion_get', $value->id)}}" class="btn btn-primary conclusion" data-id="{{$value->id}}" data-toggle="modal" data-target="#ApplicationConclusionModal">
                                          @if($value->conclusion != null)
                                             Открыть
                                          @else
                                             Создать
                                          @endif
                                       </a>

                                       <hr>

                                       <form action="{{route('application_update', $value->id)}}" method="post">
                                          {{csrf_field()}}
                                          <button type="submit" class="btn btn-primary p-1">Завершить</button>
                                       </form>

                                    @else
                                       <a href="{{route('application_conclusion_get', $value->id)}}" class="btn btn-primary conclusion" data-id="{{$value->id}}" data-toggle="modal" data-target="#ApplicationConclusionGetModal">
                                          Открыть
                                       </a>
                                    @endif
                                 </td>

                              </tr>
                           @endif
                        @endforeach
                     </tbody>
                  </table>

               </div>
            @endif
         @endif
      @endif

   </div>
   @include('inner_page.applications.modal')

@endsection
