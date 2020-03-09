@extends('layouts.app')

@section('content')
   @section('title', 'График')

   <div class="content-schedules mt-5 mb-5">
      <div class="container ">

         <div class="receptions">
            <div class="col-12">
               <h1 class="text-center">Расписание онлайн консультации</h1>
               <hr style="width: 10%; background-color: rgb(58, 117, 184);">

               <div class="create_schedule">
                  <div class="consult_buttons row">
                     <div class="consult_duration_time">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#consult_duration_time">Установить продолжительность консультации</button>
                     </div>

                     &nbsp;&nbsp;&nbsp;&nbsp;

                     <div class="create_schedule_b">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#create_schedule_modal">График консультации</button>
                     </div>
                  </div>

                  <br>
                  <div class="calendar">
                  <div class="block_schedule">
                  <input id="schedule_date" class="date" name="datepick" required>
                  <input id="durationInputValue" type='number' class="hidden" value="{{$data['time']}}"/>
               </div>
            </div>


         </div>



         <div class="my_modal modal fade" id="consult_duration_time" tabindex="-1" role="dialog"  aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
               <div class="modal-content">
                  <div class="modal-header">
                     <h4 class="modal-title w-100" id="myModalLabel">Выберите время</h4>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                     </button>
                  </div>
                  <div class="modal-body">
                     <div class="warning">Изменение времени консультации повлечет очистку графика приема.</div>
                     <br>
                     <form action="{{route('online_time')}}" method="post">
                        {{csrf_field()}}
                        <div class="custom-control custom-radio">
                           <input type="radio" class="custom-control-input" id="duration7" name="duration_time" value="5" @if($data['time'] == 5) {{'checked'}} @endif>
                              <label class="custom-control-label" for="duration7">Каждые 5 минут</label>
                           </div>
                           <hr>
                           <div class="custom-control custom-radio">
                              <input type="radio" class="custom-control-input" id="duration1" name="duration_time" value="10" @if($data['time'] == 10) {{'checked'}} @endif>
                                 <label class="custom-control-label" for="duration1">Каждые 10 минут</label>
                              </div>
                              <hr>
                              <div class="custom-control custom-radio">
                                 <input type="radio" class="custom-control-input" id="duration2" name="duration_time" value="15" @if($data['time'] == 15) {{'checked'}} @endif>
                                    <label class="custom-control-label" for="duration2">Каждые 15 минут</label>
                                 </div>
                                 <hr>
                                 <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" id="duration3" name="duration_time" value="20" @if($data['time'] == 20) {{'checked'}} @endif>
                                       <label class="custom-control-label" for="duration3">Каждые 20 минут</label>
                                    </div>
                                    <hr>
                                    <div class="custom-control custom-radio">
                                       <input type="radio" class="custom-control-input" id="duration4" name="duration_time" value="30" @if($data['time'] == 30) {{'checked'}} @endif>
                                          <label class="custom-control-label" for="duration4">Каждые 30 минут</label>
                                       </div>
                                       <hr>
                                       <div class="custom-control custom-radio">
                                          <input type="radio" class="custom-control-input" id="duration5" name="duration_time" value="40" @if($data['time'] == 40) {{'checked'}} @endif>
                                             <label class="custom-control-label" for="duration5">Каждые 40 минут</label>
                                          </div>
                                          <hr>
                                          <div class="custom-control custom-radio">
                                             <input type="radio" class="custom-control-input" id="duration6" name="duration_time" value="50" @if($data['time'] == 50) {{'checked'}} @endif>
                                                <label class="custom-control-label" for="duration6">Каждые 50 минут</label>
                                             </div>
                                             <br>
                                             <button type="submit" class="btn btn-secondary btn-sm">Сохранить</button>
                                          </form>
                                       </div>

                                    </div>
                                 </div>
                              </div>




                              <div class="my_modal modal fade" id="create_schedule_modal" tabindex="-1" role="dialog"  aria-hidden="true">
                                 <!-- Change class .modal-sm to change the size of the modal -->
                                 <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                       <div class="modal-header">
                                          <h4 class="modal-title w-100" id="myModalLabel">График консультации</h4>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                             <span aria-hidden="true">&times;</span>
                                          </button>
                                       </div>

                                       <div class="modal-body">
                                          <form method="post" action="{{route("saveSchedule")}}" id="save_schedule">
                                             {{csrf_field()}}
                                             <input type="hidden" value="{{$data['lawyer']['id']}}" name="lawyer_id" id="lawyer_id">
                                             <div class="form-fields">
                                                <div class="select_date">
                                                   <label>Выберите дату</label>
                                                   <input id="date_modal" type='text' class="datepicker-here" name="date_schedule"/>
                                                </div>
                                                <div class="select_time">
                                                   <label>Выберите время</label>
                                                   <input id="time" type='text' class="hidden" name="time_schedule"/>
                                                   <div id="times_list">
                                                      @foreach ($data['range'] as $time)
                                                         <div class="time">{{$time}}</div>
                                                      @endforeach
                                                   </div>
                                                </div>
                                                <div class="selected_times"></div>

                                             </div>

                                             <br>
                                             <button type="submit" class="btn btn-secondary btn-sm">Сохранить</button>
                                          </form>
                                       </div>

                                    </div>
                                 </div>
                              </div>


                        </div>
                     </div>
                  </div>
               </div>

            @endsection
