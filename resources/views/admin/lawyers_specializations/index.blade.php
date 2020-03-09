@extends('admin.layouts.main')
@section('content')
   @section('title') {{"Вид деятельности"}} @endsection

      <!-- Editable table -->
      <div class="card">
         <h3 class="card-header text-center font-weight-bold text-uppercase py-4">Список видов деятельности</h3>
         <a href="/admin/lawyers_specializations/create/page" class="btn btn-success btn-rounded btn-sm my-0">Добавить</a>
         <div class="card-body">
            <div id="table" class="table-editable">

               <table class="table table-bordered table-responsive-md table-striped text-center">
                  <thead>
                     <tr>
                        <th class="text-center">ID</th>
                        <th class="text-center">Специализирующаяся отрасль права</th>
                        <th class="text-center">Описание</th>                        
                        <th class="text-center">Редактировать</th>
                        <th class="text-center">Удалить</th>
                  </tr>
               </thead>
               <tbody>
				@foreach($lawyersSpecializations as $data)
                     <tr>
                        <td class="pt-3-half" contenteditable="true">{{$data->id}}</td>
                        <td class="pt-3-half" contenteditable="true">{{$data->name}}</td>
                        <td class="pt-3-half" contenteditable="true">{{$data->description}}</td>                        
                        <td class="pt-3-half"><a href="/admin/lawyers_specializations/update_page/{{$data->id}}" class="btn btn-primary btn-rounded btn-sm my-0">Изменить</a></td>
                        <td class="pt-3-half"><a href="/admin/lawyers_specializations/delete/{{$data->id}}" class="btn btn-danger btn-rounded btn-sm my-0">Удалить</a>
                        	</td>
					 </tr>
				@endforeach
<!-- This is our clonable table line -->
</tbody>
</table>
{{ $lawyersSpecializations->links() }}
</div>
</div>
</div>
<!-- Editable table -->

@endsection
