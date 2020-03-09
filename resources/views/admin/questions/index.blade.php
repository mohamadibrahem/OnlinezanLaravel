@extends('admin.layouts.main')
@section('content')
   @section('title') {{"Часто задавемые вопросы"}} @endsection

      <!-- Editable table -->
      <div class="card">
         <h3 class="card-header text-center font-weight-bold text-uppercase py-4">Часто задавемые вопросы</h3>
         <div class="card-body">
            <div id="table" class="table-editable">
               <span class="table-add float-right mb-3 mr-2">
                  <a href="/admin/questions/create_page" class="text-success">  <i class="fas fa-plus fa-2x" aria-hidden="true"></i> Добавить</a>
               </span>
               <table class="table table-bordered table-responsive-md table-striped text-center">
                  <thead>
                     <tr>
                        <th class="text-center">ID</th>
                        <th class="text-center">Вопрос</th>
                        <th class="text-center">Ответ</th>
                        <th class="text-center">Редактировать</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach($questions as $value)
                        <tr>
                           <td class="pt-3-half">{{$value->id}}</td>
                           <td class="pt-3-half">{{$value->title}}</td>
                           <td class="pt-3-half">{{substr($value->text, 0, 100).'...'}}</td>
                           <td class="pt-3-half">
                              {{-- <a href="#">Изменить</a> --}}
                              {{-- <hr> --}}
                              <a class="btn btn-danger btn-rounded btn-sm my-0" href="/admin/question/delete/{{$value->id}}"><Remove>Удалить</Remove></a>
                           </td>
                        </tr>
                     @endforeach
                     <!-- This is our clonable table line -->
                  </tbody>
               </table>
               {{ $questions->links() }}
            </div>
         </div>
      </div>
      <!-- Editable table -->

   @endsection
