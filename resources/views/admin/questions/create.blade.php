@extends('admin.layouts.main')
@section('content')
   @section('title') {{"Часто задавемые вопросы"}} @endsection

      <!-- Editable table -->
      <div class="card">
         <h3 class="card-header text-center font-weight-bold text-uppercase py-4">Часто задавемые вопросы</h3>
         <div class="card-body">
            <form action="{{route('admin_question_store')}}" method="post">
               {{csrf_field()}}
               <div class="form-group col-md-6">
                  <label for="title">Вопрос</label>
                  <input type="text" class="form-control" id="title" name="title">
               </div>
               <div class="form-group col-md-6">
                  <label for="description">Ответ</label>
                  <textarea class="form-control" id="description" name="text"> </textarea>
               </div>


               <div class="col-md-6">
                  <label>Отрасль<span class="required"> *</span></label>
                  <select class="form-control custom-select" name="service">
                     @foreach ($specializations as $item)
                        <option value="{{ $item->id }}"> {{$item->name}} </option>
                     @endforeach
                  </select>
               </div>
               <br>
               <div class="form-group col-md-6">
                  <button type="submit" class="btn btn-primary">Добавить</button>
               </div>
            </form>
         </div>
      </div>
      <!-- Editable table -->

   @endsection
