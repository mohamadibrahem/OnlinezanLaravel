@extends('layouts.app')

@section('content')
   @section('title', 'Онлайн консультация')

   <div class="content-online_consultations mt-5 mb-5">
      <div class="container">
         <h2>Предстоящие консультации</h2>
         <p></p>
         @if(count($coming_consultations) != 0)
            <table class="table table-bordered">

               <thead>
                  <tr>
                     @if(Auth::user()->role_id == 3)
                        <th>Клиент</th>
                     @endif
                     @if(Auth::user()->role_id == 4)
                        <th>Юрист</th>
                     @endif
                     <th>Дата и время</th>
                     <th>Продолжительность</th>
                     <th>Прикрепленные файлы</th>
                     <th>Описание проблемы</th>
                     <th>Видеозвонок</th>
                     <th>Отмена</th>
                  </tr>
               </thead>

               <tbody>
                  @foreach ($coming_consultations as $value)

                     <tr>
                        @if(Auth::user()->role_id == 3)
                           <td data-label="Клиент">{{$value->client['user']['lastname']}} {{$value->client['user']['firstname']}}</td>
                        @endif
                        @if(Auth::user()->role_id == 4)
                           <td data-label="Юрист" >{{$value->lawyer['user']['lastname']}} {{$value->lawyer['user']['firstname']}}</td>
                        @endif
                        <td data-label="Дата и время">{{$value->datetime}}</td>
                        <td data-label="Продолжительность">{{$value->time}} мин.</td>
                        <td data-label="Файлы"><a class="btn btn-primary detail" href="{{route('consultation_detail', $value->id)}}" data-toggle="modal" data-target="#consultationFileModal">Открыть</a></td>
                        <td data-label="Описание">{{$value->comment}}</td>
                        <td data-label="Видео звонок"><a class=" pt-2 pb-2 pr-3 pl-3" href="{{'chat/'.$value->conversation_id}}"><i class="fas fa-video"></i></a></td>
                        <td data-label="Отмена">
                           @if($now_datetime < $value->datetime)
                              <form method="POST" action="{{route('online_consultation_delete', $value->id)}}" class="delete_consultation">
                                 {{ csrf_field() }}
                                 <button class="border-0 pt-2 pb-2 pr-3 pl-3" type="submit"><i class="fas fa-times"></i></button>
                              </form>
                           @else
                              <button class="btn btn-dark disabled pt-2 pb-2 pr-3 pl-3" type="button" ><i class="fas fa-times" ></i></button>
                           @endif
                        </td>
                     </tr>
                  @endforeach
               </tbody>
            </table>
         @else
            Нет запланированных консультации
         @endif
      </div>

      <br>
      <hr>
      <br>

      <div class="container">
         <h2>Предыдущие консультации</h2>
         <p></p>
         @if(count($completed_consultations) != 0)
         <table class="table table-bordered">
            <thead>
               <tr>
                  @if(Auth::user()->role_id == 3)
                     <th>Клиент</th>
                  @endif
                  @if(Auth::user()->role_id == 4)
                     <th>Юрист</th>
                  @endif
                  <th>Дата и время</th>
                  <th>Продолжительность</th>
                  <th>Описание проблемы</th>
               </tr>
            </thead>

            <tbody>
               @foreach ($completed_consultations as $value)

                  <tr>
                     @if(Auth::user()->role_id == 3)
                        <td data-label="Клиент">{{$value->client['user']['lastname']}} {{$value->client['user']['firstname']}}</td>
                     @endif
                     @if(Auth::user()->role_id == 4)
                        <td data-label="Юрист" >{{$value->lawyer['user']['lastname']}} {{$value->lawyer['user']['firstname']}}</td>
                     @endif
                     <td data-label="Дата и время">{{$value->datetime}}</td>
                     <td data-label="Продолжительность">{{$value->time}} мин.</td>
                     <td data-label="Описание">{{$value->comment}}</td>
                  </tr>
               @endforeach
            </tbody>
         </table>
      @else
         Пусто
      @endif
      </div>

   </div>

   @include('inner_page.online_consultations.modal')

@endsection
