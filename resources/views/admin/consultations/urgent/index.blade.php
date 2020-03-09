@extends('admin.layouts.main')
@section('content')
   @section('title') {{"Срочная консультация"}} @endsection

      <!-- Editable table -->
      <div class="card">
         <h3 class="card-header text-center font-weight-bold text-uppercase py-4">Список срочной консультации</h3>
         <div class="card-body">
            <div id="table" class="table-editable">
               {{-- <span class="table-add float-right mb-3 mr-2">
               <a href="#!" class="text-success">  <i class="fas fa-plus fa-2x" aria-hidden="true"></i></a>
            </span> --}}
            <table class="table table-bordered table-responsive-md table-striped text-center">
               <thead>
                  <tr>
                     <th class="text-center">ID</th>
                     <th class="text-center">Дата</th>
                     <th class="text-center">Юрист</th>
                     <th class="text-center">Клиент</th>
                     <th class="text-center">Описание проблемы</th>
                     <th class="text-center">Заключение</th>
                     <th class="text-center">Статус</th>
                     {{-- @if(Auth::user()->role_id == 1)
                     <th class="text-center">Изменить</th>
                  @endif --}}
               </tr>
            </thead>
            <tbody>
               @foreach($consultations as $item)
                  <tr>
                     <td class="pt-3-half">{{$item->id}}</td>
                     <td class="pt-3-half">
                        Дата заявки: {{$item->created_at}}
                        <br>
                        Дата начало: {{$item->received_datetime}}
                        <br>
                        Дата завершения: {{$item->closing_datetime}}
                     </td>
                     <td class="pt-3-half">
                        @If(!empty($item->lawyer))
                        <b>Имя:</b>
                           {{$item->lawyer['user']['lastname']}} {{$item->lawyer['user']['firstname']}}
                        <br>
                        <b>Тел:</b> {{$item->lawyer['user']['phone']}}
                        <br>
                        <b>Email:</b> {{$item->lawyer['user']['email']}}
                     @else
                        <b>Не существует</b>
                     @endif

                     </td>
                     <td class="pt-3-half">
                        <b>Имя:</b> {{$item->client['user']['lastname']}} {{$item->client['user']['firstname']}}
                        <br>
                        <b>Тел:</b> {{$item->client['user']['phone']}}
                        <br>
                        <b>Email:</b> {{$item->client['user']['email']}}
                     </td>
                     <td class="pt-3-half">{{$item->description}}</td>

                     <td class="pt-3-half">
                        @if($item->conclusion != '')
                           <a class="btn btn-primary p-2" href="{{route('admin_urgent_conclusion', $item->id)}}">Открыть</a>
                        @endif
                     </td>

                     <td class="pt-3-half">@if($item->status == 'new') В обработке @elseif($item->status == 'cancelled') Отменен @elseif($item->status == 'success') Исполнено @else В исполнении @endif</td>


                        {{-- @if(Auth::user()->role_id == 1)
                        <td>
                        <span class="table-remove">
                        <button type="button" class="btn btn-primary btn-rounded btn-sm my-0">Изменить</button>
                     </span>
                  </td>
               @endif --}}

            </tr>
         @endforeach
         <!-- This is our clonable table line -->
      </tbody>
   </table>
   {{ $consultations->links() }}
</div>
</div>
</div>
<!-- Editable table -->

@endsection
