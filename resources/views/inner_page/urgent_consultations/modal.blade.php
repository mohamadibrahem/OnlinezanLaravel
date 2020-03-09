<div class="modal fade" id="urgentModal" tabindex="-1" role="dialog" aria-labelledby="urgentModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="urgentModalLabel">Описание проблемы</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            ...
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
         </div>
      </div>
   </div>
</div>


<div class="modal fade" id="urgentConclusionModal" tabindex="-1" role="dialog" aria-labelledby="urgentConclusionModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="urgentConclusionModalLabel">Заключение</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            @if(Auth::user()->role_id == 3)
            <form>
               {{csrf_field()}}
               <input type="hidden" name="consultation" id="urgent_id">
               <textarea name="conclusion" class="form-control" id="conclusion"></textarea>
               <br>
                  <button type="submit" class="btn btn-primary">Сохранить</button>
            </form>
         @else
            <textarea class="form-control" id="conclusion" readonly></textarea>
         @endif

         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
         </div>
      </div>
   </div>
</div>
