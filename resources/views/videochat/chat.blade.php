@extends('layouts.app')

@section('content')
   @section('title', 'Онлайн консультация')

   <div class="container">
      <div class="col-12">
         <div id="app">
            <input value="{{json_decode($conversation)->conversationId}}" type="hidden" id="chat_id">

            <div id="clock">
               <span class="title"></span>
               {{-- <div id="countdown"></div> --}}
               <h2><span class="day">{day}дней</span> {hour:00}:{min:00}:{sec:00}</h2>
            </div>

            <br>

            <div id="videochat_component">

               <chat-room :conversation="{{ $conversation }}" :current-user="{{ auth()->user() }}"></chat-room>

            </div>




            @if(Auth::check())
               <div class="hidden">
                  <textarea id="offerValue"></textarea>
                  <textarea id="offerValueSdp"></textarea>
                  <textarea id="answerValue"></textarea>
                  <textarea id="answerValueSdp"></textarea>
               </div>
            @endif

         </div>

         @include('videochat.modal')

         {{-- <form method="POST" action="{{route('appointment_reports.store')}}" id="appointment_report" class="hidden">
         {{ csrf_field() }}
         <input name="appointment_id" value="{{$appointment_data->id}}">
         <input name="doctor_id" value="{{$appointment_data->doctor_id}}">
         <input name="patient_id" value="{{$appointment_data->patient_id}}">
         @if(Auth::user()->id == $appointment_data->patient['user']['id'])
         <input name="patient_status" value="0" id="patient_status">
      @endif
      @if(Auth::user()->id == $appointment_data->doctor['user']['id'])
      <input name="doctor_status" value="1" id="doctor_status">
   @endif
   <input name="system_status" value="0" id="system_status">
   <button class="button" type="button">Сохранить</button>
</form> --}}


</div>
</div>
@endsection
