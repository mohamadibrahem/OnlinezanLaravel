@extends('layouts.app')

@section('content')
   @section('title', 'Новости')

   <div class="content-news mt-5 mb-5">
      <div class="container ">
         @if(session()->has('messages'))
            <div class="alert alert-success">
               {{ session()->get('messages') }}
            </div>
         @endif
         @trixassets
         <form action="{{route('admin_news_store')}}" method="post">
            {{csrf_field()}}
            <div class="form-group">
               <label for="title">Заголовок</label>
               <input type="text" class="form-control" id="title" name="title">
            </div>
            <div class="form-group">
               <label for="text">Текст</label>
               @trix(\App\News::class, 'text')
            </div>
            <button type="submit" class="btn btn-primary">Сохранить</button>
         </form>

      </div>
   </div>

@endsection
