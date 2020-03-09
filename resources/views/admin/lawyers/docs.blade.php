@extends('admin.layouts.main')
@section('content')
   @section('title')
      {{$lawyer->user['lastname']}} {{$lawyer->user['firstname']}}
   @endsection

   <div class="card">
      <h3 class="card-header text-center font-weight-bold text-uppercase py-4">Документы</h3>
      <div class="card-body">
         @if(count($errors))
            <br>
            <div class="form-group">
               <div class="alert alert-danger">
                  <ul>
                     @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                     @endforeach
                  </ul>
               </div>
            </div>
            <br>
         @endif

         <ul>
            @foreach ($files as $key => $value)
               <li><a href="{{asset('uploads').'/lawyer_docs'.'/'.$value->filename}}">{{$value->original_name}}</a></li>
            @endforeach
         </ul>

      </div>
   </div>

@endsection
