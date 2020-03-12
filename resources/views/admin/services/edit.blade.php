@extends('admin.layouts.main')
@section('content')
   @section('title')
      {{"Отрасль"}}
   @endsection
   <div class="row">
      <div class="col">

         @trixassets
         <form class="border border-light p-5" action="{{route('admin_service_store', $service->id)}}" method="post" >
            {{csrf_field()}}
            <textarea id="service_description" class="hidden">{{$service->description}}</textarea>
            <div class="form-group">
               <label>Название</label>
               <input class="form-control" value="{{$service->name}}" name="title">
            </div>
            <br>
            <hr>
            <br>
            <div class="form-group">
               <label>Описание</label>
               {!!$service->trix('description')!!}
            </div>
            <button type="submit" class="btn btn-primary">Сохранить</button>
         </form>
      </div>
   </div>

   {{-- @trix($service, 'description') --}}

   {{-- {!! $service->trix('description') !!} --}}

   {{-- {!! app('laravel-trix')->make($service, 'description') !!} --}}

@endsection
