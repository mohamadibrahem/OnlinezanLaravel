<div class="modal fade" id="consultationFileModal" tabindex="-1" role="dialog" aria-labelledby="consultationFileModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         
         <div class="modal-header">
            <h5 class="modal-title" id="consultationFileModalLabel">
               @if(Auth::user()->role_id == 3)
                  Файлы клиента
               @else
                  Прикрепленные файлы
               @endif
            </h5>
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
