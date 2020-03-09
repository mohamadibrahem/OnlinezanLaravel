@extends('admin.layouts.main')
@section('content')
   @section('title') {{"Заявки на консультацию"}} @endsection

      <!-- Editable table -->
      <div class="card">
         <h3 class="card-header text-center font-weight-bold text-uppercase py-4">Описание проблемы заявки №{{$consultation->id}}</h3>
         <div class="card-body">
            <textarea name="name" rows="20" cols="20" class="form-control">{{$consultation->comment}}</textarea>
         </div>
      </div>
      <!-- Editable table -->

   @endsection
