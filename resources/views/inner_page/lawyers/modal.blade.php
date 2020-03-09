<div class="modal fade" id="urgentConsultationModal" tabindex="-1" role="dialog" aria-labelledby="urgentConsultationModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="urgentConsultationModalLabel">Срочная консультация</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <div class="messages"></div>
            <form action="{{route('save_urgent')}}" method="post">
               {{csrf_field()}}
               <div class="specialist name">
                  <span class="label">Юрист:</span>
                  <span class="value"></span>
               </div>

               <div class="specialist price">
                  <span class="label">Стоимость консультации:</span>
                  <span class="amount"></span> тг
               </div>

               <br>

               <div class="description">
                  <span class="label">Описание проблемы:</span>
                  <br>
                  <textarea name="description" class="form-control" style="min-height:100px"></textarea>
               </div>

               <input type="hidden" name="urgent_lawyer_id" id="urgent_lawyer_id">
               <br>

               <div>
                  Консультацию по телефону и письменный ответ на письменную заявку. Минимальный срок ответа 2 часа.
               </div>
               <hr>

               <button type="submit" class="btn btn-primary submit" >Заказать</button>
            </form>

         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
         </div>
      </div>
   </div>
</div>


<div class="modal fade" id="onlineConsultationModal" tabindex="-1" role="dialog" aria-labelledby="onlineConsultationModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="onlineConsultationModalLabel">Онлайн консультация</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <div class="messages"></div>
            <form action="{{route('save_online')}}" method="post" enctype="multipart/form-data">
               {{csrf_field()}}

               <input type="hidden" id="lawyer_id" name="lawyer_id" value="{{$data['lawyer']['id']}}" readonly>
               <input type="hidden" id="datetime" name="datetime" readonly>
               <input type="hidden" id="payment_id" name="payment_id" value="" readonly>

               <div class="form-fields">
                  <span>Продолжительность одной консультации:&nbsp;</span>
                  <span><b>{{$data['lawyer']['consultation_time']}} мин.</b></span>
               </div>

               <hr>

               <div class="form-fields calendar_field">
                  <div class="select_date">
                     <label>Выберите дату</label>
                     <input id="date_modal" type='text' class="datepicker-here" name="date"/>
                  </div>
                  <div class="select_time mt-2 ml-2">
                     <label>Выберите время</label>
                     <div id="times_list">
                        <input id="time_modal" type='text'  name="time" class="hidden"/>
                     </div>
                  </div>
               </div>
               <div class="form-fields row">
                  <div class="col">
                     <span>Описание проблемы:&nbsp;</span>
                     <textarea class="form-control" name="comment"></textarea>
                  </div>
               </div>
               <br>
               <div class="custom-file">
                  <input type="file" class="custom-file-input" id="consultation_file" name="consultation_file[]" multiple>
                  <label class="custom-file-label" for="consultation_file" data-browse="Загрузить" style="text-align:left">Прикрепить файл</label>
               </div>
               <br>
               <br>

               <button type="button" class="btn btn-primary submit" id="order">Записаться</button>
            </form>

         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
         </div>
      </div>
   </div>
</div>



<div class="modal fade" id="videoanketa" tabindex="-1" role="dialog" aria-labelledby="videoanketaLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="videoanketaLabel">Видеоанкета</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         @if($data['lawyer']['video'] != null)
           <video src="{{URL::asset('/uploads') .'/profile_video'.'/'. $data['lawyer']['video']}}" controls="controls" playsinline="" style="width:100%"></video>
        @endif
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
      </div>
    </div>
  </div>
</div>
