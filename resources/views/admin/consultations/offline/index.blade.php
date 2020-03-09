@php
use Carbon\Carbon;
@endphp
@extends('admin.layouts.main')
@section('content')
   @section('title') {{"Заявки на консультацию"}} @endsection

      <!-- Editable table -->
      <div class="card">
         <h3 class="card-header text-center font-weight-bold text-uppercase py-4">Список заявки на консультацию</h3>
         <div class="card-body">
            <div id="table" class="table-editable">
               {{-- <span class="table-add float-right mb-3 mr-2">
               <a href="#!" class="text-success">  <i class="fas fa-plus fa-2x" aria-hidden="true"></i></a>
            </span> --}}
            <table class="table table-bordered table-responsive-md table-striped text-center">
               <thead>
                  <tr>
                     <th class="text-center">ID</th>
                     <th class="text-center">Дата</th>
                     <th class="text-center">Клиент</th>
                     <th class="text-center">Телефон</th>
                     <th class="text-center">Email</th>
                     <th class="text-center">Услуга</th>
                     <th class="text-center">Описание проблемы</th>
                     <th class="text-center">Прикрипленный файл</th>
                     <th class="text-center">Исполнитель</th>
                     <th class="text-center">Статус</th>
                     <th class="text-center">Заключение</th>


                     {{-- <th class="text-center">Локация</th> --}}
                     {{-- <th class="text-center">Дата и время консультации</th> --}}
                     {{-- <th class="text-center">Продолжительность</th> --}}
                     {{-- <th class="text-center">Цена</th>
                     <th class="text-center">Статус</th> --}}
                     {{-- @if(Auth::user()->role_id == 1)
                     <th class="text-center">Изменить</th>
                  @endif --}}
               </tr>
            </thead>
            <tbody>
               @foreach($receptions as $item)
                  <tr class="@if($item->status_id == 4)alert alert-success @endif @if($item->status_id == 5)alert alert-danger @endif">
                     <td class="pt-3-half">{{$item->id}}</td>
                     <td class="pt-3-half">
                        Дата заявки: {{$item->created_at}}
                        <br>
                        Дата начало: {{$item->received_datetime}}
                        <br>
                        Дата завершения: {{$item->closing_datetime}}
                     </td>
                     <td class="pt-3-half">{{$item->client_name}}</td>
                     <td class="pt-3-half">{{$item->client_phone}}</td>
                     <td class="pt-3-half">{{$item->client_email}}</td>
                     <td class="pt-3-half">{{$item->service}} ({{$item->user_type}})</td>
                     <td class="pt-3-half"><a href="{{route('application_comment', $item->id)}}">Открыть</a></td>

                     <td class="link" >
                        @if($item->file != null)
                           @foreach (json_decode($item->file) as $file)
                              <a href="{{asset('/uploads/application_files').'/'. $file}}" target="_blank">{{$file}}</a>
                              <hr>
                           @endforeach
                        @endif
                     </td>
                     <td class="pt-3-half">
                        @if(!empty($item->lawyer))
                           @if($item->lawyer_id != '')
                              <b>{{$item->lawyer['user']['lastname']}} {{$item->lawyer['user']['firstname']}}</b>
                           @else
                              Не назначен
                           @endif
                        @endif

                        @if($item->status_id != 3)
                           <hr>
                           <a href="{{route('application_lawyer_edit', $item->id)}}" class="btn btn-primary p-1">
                              Назначить
                           </a>


                        @endif

                     </td>

                     <td class="pt-3-half">
                        @if(Carbon::parse($item->received_datetime)->addMinutes(4320) < Carbon::parse($item->closing_datetime))
                           <hr>
                           Просрочена
                        @else
                           {{$item->status['name']}}
                        @endif
                     </td>
                     <td class="pt-3-half">
                        @if($item->conclusion != '')
                           <a class="btn btn-primary p-2" href="{{route('admin_application_conclusion', $item->id)}}">Открыть</a>
                        @endif
                     </td>

                     {{-- <td class="pt-3-half" contenteditable="true">{{$item->location_name}}</td> --}}
                     {{-- <td class="pt-3-half" contenteditable="true">{{substr($item->datetime, 0, 10)}} || {{substr($item->datetime, 11, 15)}}</td> --}}
                     {{-- <td class="pt-3-half" contenteditable="true">{{$item->duration_time}} мин.</td> --}}
                     {{-- <td class="pt-3-half" contenteditable="true">{{$item->price}} тг</td> --}}
                     {{-- <td class="pt-3-half" contenteditable="true">
                     @if($now_time > $item->datetime && $item->status == 0)
                     <span class="alert alert-primary">{{'Запланирован'}}</span>
                  @elseif($now_time < $item->datetime && $item->status == 2)
                  <span class="alert alert-secondary">{{'Отменен'}}</span>
               @endif
            </td>
            @if(Auth::user()->role_id == 1)
            <td>
            <span class="table-remove">
            <button type="button" class="btn btn-primary btn-rounded btn-sm my-0">Изменить</button>
         </span>
      </td>
   @endif --}}
</tr>
@endforeach
<!-- This is our clonable table line -->
</tbody>
</table>
{{ $receptions->links() }}
</div>
</div>
</div>
<!-- Editable table -->

@endsection
