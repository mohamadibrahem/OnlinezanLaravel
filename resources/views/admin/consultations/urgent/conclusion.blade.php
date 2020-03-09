@extends('admin.layouts.main')
@section('content')
   @section('title') {{"Заключение"}} @endsection

      <div class="client_name"><b>Клиент:</b> <span class="value">{{$consultations->client['user']['lastname']}} {{$consultations->client['user']['firstname']}}</span> </div>
      <div class="client_name"><b>Юрист:</b> <span class="value">{{$consultations->lawyer['user']['lastname']}} {{$consultations->lawyer['user']['firstname']}}</span> </div>

      <br>
      <div class="row">
         <div class="col">
            <b>Описание проблемы:</b>
            <textarea name="conclusion" class="form-control" id="conclusion">{{$consultations->description}}</textarea>
         </div>
      </div>

      <br>
      <div class="row">
         <div class="col">
            <b>Заключение:</b>
            <textarea name="conclusion" class="form-control" id="conclusion">{{$consultations->conclusion}}</textarea>
         </div>
      </div>
      <br>
      {{-- <textarea name="npa" class="form-control" id="npa"></textarea> --}}



      <div class="row add-more-inputs">
         <div class="col ">
            <b>ссылки на используемые НПА</b>
            <br>
            <div id="field">
               @if(json_decode($consultations->npa) != null)
                  <br>
                  @foreach (json_decode($consultations->npa) as $key => $value)
                     @if($value != '')
                        <div id="field{{$key}}" name="field{{$key}}">
                           <div class="form-group">
                              <input id="npa" name="npa[]" type="text" placeholder="Ссылка" class="form-control input-md" value="{{$value}}">
                           </div>
                        </div>
                     @endif
                  @endforeach
               @else
                  Пусто
               @endif
            </div>

         </div>
      </div>




      <br>

   @endsection
