<div class="my_modal modal fade" id="endAppointment">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title">Вы действительно хотите завершить консультацию?</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <div class="row">
               <div class="col text-center">
                  <form method="POST" action="{{route('online_consultation_update', $consultation['id'])}}" id="end_appointment">
                     {{ csrf_field() }}
                     <button class="button yes btn btn-danger" type="button">Завершить</button>
                  </form>
               </div>
               <div class="col text-center">
                  <button class="button no btn btn-primary" type="button">Продолжить</button>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
