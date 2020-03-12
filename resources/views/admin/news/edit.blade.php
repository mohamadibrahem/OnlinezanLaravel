@extends('admin.layouts.main')
@section('content')
   @section('title') {{"Редактировать новость"}} @endsection

      <!-- Editable table -->
      <div class="card">
         <h3 class="card-header text-center font-weight-bold text-uppercase py-4">Редактировать новость</h3>
            <div class="card-body d-flex justify-content-center" style="min-height: 360px;">
               <form class="col-md-6 d-flex flex-column justify-content-between" action="/admin/news/edit/{{ $news->id }}" method="post">
               @csrf
                  <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                     <label for="name" class="col control-label">Заголовок</label>
                     <div class="col">
                        <input id="title" type="title" class="form-control" name="title" value="{{ $news->title }}" placeholder="Редактировать вид деятельности" autofocus>
                        @if ($errors->has('title'))
                           <span class="help-block">
                              <strong>{{ $errors->first('title') }}</strong>
                           </span>
                        @endif
                     </div>
                  </div>

                  <div class="form-group{{ $errors->has('text') ? ' has-error' : '' }}">
                     <label for="text" class="col control-label">Текст</label>
                     <div class="col">
                        <textarea id="text" class="form-control" name="text" id="" cols="30" rows="10" placeholder="Описание" autofocus>{{ $news->text }}</textarea>
                        @if ($errors->has('text'))
                           <span class="help-block">
                              <strong>{{ $errors->first('text') }}</strong>
                           </span>
                        @endif
                     </div>
                  </div>

                  <button class="btn btn-primary btn-rounded btn-sm my-0">Редактировать</button>
               </form>
            </div>
      </div>
<!-- End card -->

@endsection