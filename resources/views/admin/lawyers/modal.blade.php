

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
         <form action="{{route('admin_experience_store')}}" method="post">
           {{csrf_field()}}
           <input type="hidden" name="lawyer_id" value="{{$data['lawyer']['id']}}">
           <div class="form-group col-md-6">
              <label for="title">Название</label>
              <input type="text" class="form-control" id="title" name="name">
           </div>
           <div class="form-group col-md-6">
              <label for="description">Описание</label>
              <textarea class="form-control" id="description" name="description"> </textarea>
           </div>
           <div class="form-group col-md-6">
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


        <form action="{{route('admin_education_store')}}" method="post">
           {{csrf_field()}}
           <input type="hidden" name="lawyer_id" value="{{$data['lawyer']['id']}}">
          <div class="form-group">
           <label for="title">Название</label>
           <input type="text" class="form-control" id="title" name="name">
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
