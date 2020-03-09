@extends('admin.layouts.main')
@section('content')
   @section('title')
      {{"Юристы"}}
   @endsection

   <!-- Editable table -->
   {{-- <form action="">
   <div class="form-row">
   <div class="col col-md-3">
   <select class="browser-default custom-select selectpicker" name="doctorname" id="doctorname" data-live-search="true">
   <option selected value="0">Ф.И.О</option>
   @foreach ($lawyers as $key => $value)
   <option value="{{$value->id}}">{{$value->user['lastname']}} {{$value->user['firstname']}} {{$value->user['middlename']}}</option>
@endforeach
</select>
</div>
<div class="col col-md-1">
<button class="btn btn-primary btn-sm my-0 p waves-effect waves-light" type="submit">Применить</button>
</div>
<div class="col col-md-1">
<a href="/admin/doctors" class="btn btn-primary btn-sm my-0 p waves-effect waves-light" type="submit">Сбросить</a>
</div>

</div>
</form> --}}
<div class="card">
   <h3 class="card-header text-center font-weight-bold text-uppercase py-4">Список юристов</h3>
   <div class="card-body">
      <div id="table" class="table-editable">
         <span class="table-add float-right mb-3 mr-2">
            <a href="/admin/lawyers/create_page" class="text-success">  <i class="fas fa-plus fa-2x" aria-hidden="true"></i> &nbsp; Добавить юриста</a>
         </span>
         <table class="table table-bordered table-responsive-md table-striped text-center">
            <thead>
               <tr>
                  <th class="text-center">ID</th>
                  <th class="text-center">Дата создания</th>
                  <th class="text-center">ФИО</th>
                  <th class="text-center">Телефон</th>
                  <th class="text-center">Email</th>
                  <th class="text-center">Город</th>
                  <th class="text-center">Документы</th>
                  <th class="text-center">Статус</th>
                  {{-- <th class="text-center">Sort</th> --}}
                  {{-- @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                  <th class="text-center">Статус</th>
               @endif --}}
               @if(Auth::user()->role_id == 1)
                  <th class="text-center">Изменить</th>
               @endif
               @if(Auth::user()->role_id == 1)
                  <th class="text-center">Удалить</th>
               @endif
            </tr>
         </thead>
         <tbody>
            @foreach($lawyers as $lawyer)
               <tr>
                  <td class="pt-3-half" contenteditable="true">{{$lawyer->id}}</td>
                  <td class="pt-3-half" contenteditable="true"><b>Дата:</b> {{substr($lawyer->created_at,0,10)}} <br> <b>Время:</b> {{substr($lawyer->created_at,10,-3)}}</td>
                  <td class="pt-3-half" contenteditable="true">{{$lawyer->user['lastname']}} {{$lawyer->user['firstname']}} {{$lawyer->user['middlename']}}</td>
                  <td class="pt-3-half" contenteditable="true">{{$lawyer->user['phone']}}</td>
                  <td class="pt-3-half" contenteditable="true">{{$lawyer->user['email']}}</td>
                  <td class="pt-3-half" contenteditable="true">{{$lawyer->city['name']}}</td>
                  <td class="pt-3-half" ><a type="button" class="btn btn-primary btn-rounded btn-sm my-0" href="{{route('lawyer_docs', $lawyer->id)}}">Посмотреть</a></td>
                  {{-- <td class="pt-3-half">
                  <span class="table-up">
                  <a href="#!" class="indigo-text"><i class="fas fa-long-arrow-alt-up" aria-hidden="true"></i></a>
               </span>
               <span class="table-down">
               <a href="#!" class="indigo-text"><i class="fas fa-long-arrow-alt-down" aria-hidden="true"></i></a>
            </span>
         </td> --}}
         {{-- <td>

         <hr>
         <span class="table-remove">

         @if($doctor->status == 0)
         <form action="{{route('doctor_accepted', $doctor->id)}}" method="post">
         {{ csrf_field() }}
         <button type="submit" class="btn btn-primary btn-rounded btn-sm my-0">Одобрить</button>
      </form>
   @else
   Одобрен
   <hr>
   @if(Auth::user()->role_id == 1)
   <form action="{{route('doctor_blocked', $doctor->id)}}" method="post">
   {{ csrf_field() }}
   <button type="submit" class="btn btn-primary btn-rounded btn-sm my-0">Заблокировать</button>
</form>
@endif
@endif
</span>
</td> --}}

@if(Auth::user()->role_id == 1)
   <td>
      @if($lawyer->status == 'not_accepted')
         {{'Не одобрен'}}
         <hr>
         <form action="{{route('lawyer_accepted', $lawyer->id)}}" method="post">
            {{ csrf_field() }}
            <button type="submit" class="btn btn-primary btn-rounded btn-sm my-0">Одобрить</button>
         </form>
      @elseif($lawyer->status == 'accepted')
         {{'Одобрен'}}
         <hr>
         <form action="{{route('lawyer_not_accepted', $lawyer->id)}}" method="post">
            {{ csrf_field() }}
            <button type="submit" class="btn btn-primary btn-rounded btn-sm my-0">Заблокировать</button>
         </form>
      @endif
   </td>
@endif

@if(Auth::user()->role_id == 1)
   <td>
      <span class="table-remove">
         <a type="button" class="btn btn-primary btn-rounded btn-sm my-0" href="{{route('lawyer_edit', $lawyer->id)}}">Изменить</a>
      </span>
   </td>
@endif

@if(Auth::user()->role_id == 1)
   <td>
      <span class="table-remove">
         <a class="btn btn-danger btn-rounded btn-sm my-0" href="/admin/lawyer/delete/{{$lawyer->id}}"><Remove>Удалить</Remove></a>
      </span>
   </td>
@endif

</tr>
@endforeach
</tbody>
</table>
{{ $lawyers->links() }}
</div>
</div>
</div>
<!-- Editable table -->

@endsection
