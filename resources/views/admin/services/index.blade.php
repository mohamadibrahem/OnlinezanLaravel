@extends('admin.layouts.main')
@section('content')
   @section('title') {{"Отрасль"}} @endsection
      <div class="card">
         <h3 class="card-header text-center font-weight-bold text-uppercase py-4">Список</h3>
         <a href="{{route('admin_service_add_page')}}" class="btn btn-success btn-rounded btn-sm my-0">Добавить</a>         
         <div class="card-body">
            <div id="table" class="table-editable">
               <table class="table table-bordered table-responsive-md table-striped text-center">
                  <thead>
                     <tr>
                        <th class="text-center">ID</th>
                        <th class="text-center">Название</th>
                        <th class="text-center">Описание</th>
                        <th class="text-center">Редактировать</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach($services as $item)
                        <tr>
                           <td class="pt-3-half" contenteditable="true">{{$item->id}}</td>
                           <td class="pt-3-half" contenteditable="true">{{$item->name}}</td>
                           <td class="pt-3-half" contenteditable="true">{!! substr($item->description, 0, 200)!!} ...</td>
                           <td class="pt-3-half">
                                 <a class="btn btn-primary" href="{{route('admin_service_edit', $item->id)}}">Изменить</a><br><br>
                                 <a class="btn btn-danger" href="{{route('admin_service_delete', $item->id)}}">Удалить</a>                                 
                           </td>
                        </tr>
                     @endforeach
                  </tbody>
               </table>
            </div>
         </div>
      </div>

   @endsection
