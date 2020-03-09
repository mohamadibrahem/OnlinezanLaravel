@extends('admin.layouts.main')
@section('content')
   @section('title') {{"Редактировать специализирующуюся отрасль"}} @endsection

      <!-- Editable table -->
      <div class="card">
         <h3 class="card-header text-center font-weight-bold text-uppercase py-4">Редактировать специализирующуюся отрасль</h3>
            <div class="card-body d-flex justify-content-center" style="min-height: 360px;">
               <form class="col-md-6 d-flex flex-column justify-content-between" action="/admin/lawyers_specializations/update/{{$id->id}}">
               @csrf
                  <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                     <label for="name" class="col control-label">Имя</label>
                     <div class="col">
                        <input id="name" type="text" class="form-control" name="name" value="{{ $id->name }}" placeholder="Редактировать вид деятельности" autofocus>
                        @if ($errors->has('name'))
                           <span class="help-block">
                              <strong>{{ $errors->first('name') }}</strong>
                           </span>
                        @endif
                     </div>
                  </div>

                  <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                     <label for="description" class="col control-label">Описание</label>
                     <div class="col">
                        <textarea id="description" class="form-control" name="description" id="" cols="30" rows="10" placeholder="Описание" autofocus>{{ $id->description }}</textarea>
                        @if ($errors->has('description'))
                           <span class="help-block">
                              <strong>{{ $errors->first('description') }}</strong>
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