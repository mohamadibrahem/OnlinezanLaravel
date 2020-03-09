@extends('layouts.app')

@section('content')
   @section('title', 'Опыт работы')

   <div class="content-experience mt-5 mb-5">
      <div class="container ">
         @if(session()->has('messages'))
             <div class="alert alert-success">
                 {{ session()->get('messages') }}
             </div>
         @endif

         <form action="{{route('experience_update', $experience->id)}}" method="post">
            {{csrf_field()}}
           <div class="form-group">
             <label for="title">Наименование компании</label>
             <input type="text" class="form-control" id="title" name="name" value="{{$experience->name}}">
           </div>
           <div class="form-group">
            <label for="position">Должность</label>
            <input class="form-control" id="position" name="position" value="{{$experience->position}}">
          </div>
           <div class="form-group">
             <label for="description">Описание должности</label>
             <textarea class="form-control" id="description" name="description" >{{$experience->description}}</textarea>
           </div>

           <button type="submit" class="btn btn-primary">Сохранить</button>
         </form>

      </div>
   </div>

@endsection
