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

         <form action="{{route('education_update', $education->id)}}" method="post">
            {{csrf_field()}}
           <div class="form-group">
             <label for="title">Наименование ВУЗа</label>
             <input type="text" class="form-control" id="title" name="name" value="{{$education->name}}">
           </div>
           <div class="form-group">
             <label for="degree">Степень</label>
             <input type="text" class="form-control" id="degree" name="degree" value="{{$education->degree}}">
           </div>
           <div class="form-group">
            <label for="special">Специальность</label>
            <input type="text" class="form-control" id="special" name="special" value="{{$education->special}}">
           </div>


           <button type="submit" class="btn btn-primary">Сохранить</button>
         </form>

      </div>
   </div>

@endsection
