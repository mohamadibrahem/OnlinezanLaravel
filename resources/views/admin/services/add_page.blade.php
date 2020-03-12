@extends('layouts.app')

@section('content')
   @section('title', 'Отрасль')

   <div class="content-news mt-5 mb-5">
      <div class="container ">
         @if(session()->has('messages'))
            <div class="alert alert-success">
               {{ session()->get('messages') }}
            </div>
         @endif
         @trixassets
         <form action="/admin/services/create/" method="post">
            {{csrf_field()}}
            <div class="form-group">
               <label for="name">Заголовок</label>
               <input type="text" class="form-control" id="name" name="name">
            </div>
            <div class="form-group">
               <label for="text">Текст</label>
               @trix(\App\Service::class, 'description')
            </div>
            <button type="submit" class="btn btn-primary">Добавить</button>
         </form>

      </div>
   </div>

@endsection
