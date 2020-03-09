@extends('admin.layouts.main')
@section('content')
   @section('title') {{"Онлайн консультация"}} @endsection

      <!-- Editable table -->
      <div class="card">
         <h3 class="card-header text-center font-weight-bold text-uppercase py-4">Список онлайн консультации</h3>
         <div class="card-body">
            <div id="table" class="table-editable">

               <table class="table table-bordered table-responsive-md table-striped text-center">
                  <thead>
                     <tr>
                        <th class="text-center">ID</th>
                        <th class="text-center">Дата создания</th>
                        <th class="text-center">Юрист</th>
                        <th class="text-center">Клиент</th>
                        <th class="text-center">Дата и время консультации</th>
                        <th class="text-center">Продолжительность</th>
                        <th class="text-center">Цена</th>
                        {{-- <th class="text-center">Статус</th> --}}
                        {{-- @if(Auth::user()->role_id == 1)
                        <th class="text-center">Изменить</th>
                     @endif --}}
                  </tr>
               </thead>
               <tbody>
                  @foreach($appointments as $item)
                     <tr>
                        <td class="pt-3-half" contenteditable="true">{{$item->id}}</td>
                        <td class="pt-3-half" contenteditable="true">{{$item->created_at}}</td>
                        <td class="pt-3-half" contenteditable="true">
                           @If(!empty($item->lawyer))
                              {{$item->lawyer['user']['lastname']}} {{$item->lawyer['user']['firstname']}}
                           @else
                              <b>Не существует</b>
                           @endif
                        </td>
                        <td class="pt-3-half" contenteditable="true">{{$item->client['user']['lastname']}} {{$item->client['user']['firstname']}}</td>
                        <td class="pt-3-half" contenteditable="true">{{substr($item->datetime, 0, 10)}} || {{substr($item->datetime, 11, -3)}}</td>
                        <td class="pt-3-half" contenteditable="true">{{$item->time}} мин.</td>
                        <td class="pt-3-half" contenteditable="true">{{$item->price}}</td>
                        {{-- <td class="pt-3-half" contenteditable="true">
                        @if($now_time > $item->datetime && $item->status == 0)
                        <span class="alert alert-danger">{{'Не проведен'}}</span>
                     @elseif($now_time > $item->datetime && $item->status == 1)
                     <span class="alert alert-success">{{'Проведен'}}</span>
                  @elseif($item->status == 2)
                  <span class="alert alert-secondary">{{'Отменен'}}</span>
               @elseif($now_time < $item->datetime && $item->status == 0)
               <span class="alert alert-primary">{{'Запланирован'}}</span>
            @endif
         </td> --}}
         {{-- @if(Auth::user()->role_id == 1)
         <td>
         <span class="table-remove">
         <button type="button" class="btn btn-primary btn-rounded btn-sm my-0">Изменить</button>
         <a type="button" class="btn btn-success btn-rounded btn-sm my-0">Подробнее</a>
      </span>
   </td>
@endif --}}
</tr>
@endforeach
<!-- This is our clonable table line -->
</tbody>
</table>
{{ $appointments->links() }}
</div>
</div>
</div>
<!-- Editable table -->

@endsection
