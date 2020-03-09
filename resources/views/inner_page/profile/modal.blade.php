@if(Auth::check())
   @if(Auth::user()->role_id == 3)

      <div class="modal fade" id="experienceModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Опыт работы</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                  </button>
               </div>
               <div class="modal-body">
                  <form action="{{route('experience.store')}}" method="post">
                     {{csrf_field()}}
                     <input type="hidden" name="lawyer_id" value="{{$data['lawyer']['id']}}">
                     <div class="form-group">
                        <label for="title">Наименование компании</label>
                        <input type="text" class="form-control" id="title" name="name">
                     </div>
                     <div class="form-group">
                        <label for="position">Должность</label>
                        <textarea class="form-control" id="position" name="position"> </textarea>
                     </div>

                     <div class="form-group">
                        <label for="description">Описание деятельности</label>
                        <textarea class="form-control" id="description" name="description"> </textarea>
                     </div>
                     <div class="form-group">
                        <button type="submit" class="btn btn-primary">Добавить</button>
                     </div>
                  </form>

               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
               </div>
            </div>
         </div>
      </div>





      <div class="modal fade" id="educationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
         <div class="modal-dialog" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel2">Образование</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                  </button>
               </div>
               <div class="modal-body">


                  <form action="{{route('education.store')}}" method="post">
                     {{csrf_field()}}
                     <input type="hidden" name="lawyer_id" value="{{$data['lawyer']['id']}}">
                     <div class="form-group">
                        <label for="title">Наименование ВУЗа</label>
                        <input type="text" class="form-control" id="title" name="name">
                     </div>
                     <div class="form-group">
                        <label for="degree">Степень</label>
                        <input type="text" class="form-control" id="degree" name="degree">
                     </div>
                     <div class="form-group">
                        <label for="special">Специальность</label>
                        <input type="text" class="form-control" id="special" name="special">
                     </div>

                     <button type="submit" class="btn btn-primary">Сохранить</button>
                  </form>

               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
               </div>
            </div>
         </div>
      </div>

   @endif

@endif
