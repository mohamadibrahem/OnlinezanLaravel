@extends('layouts.app')

@section('content')
   @section('title', 'Образование')

   <div class="content-education mt-5 mb-5">
      <div class="container ">
         @if(session()->has('messages'))
             <div class="alert alert-success">
                 {{ session()->get('messages') }}
             </div>
         @endif

         <form action="{{route('education.store')}}" method="post">
            {{csrf_field()}}
           <div class="form-group">
             <label for="title">Название</label>
             <input type="text" class="form-control" id="title" name="name">
           </div>

           <button type="submit" class="btn btn-primary">Сохранить</button>
         </form>

      </div>
   </div>

@endsection
