@extends('admin.layouts.main')
@section('content')
  @section('title') {{"История платежей"}} @endsection

    <!-- Editable table -->
    <div class="card">
      <h3 class="card-header text-center font-weight-bold text-uppercase py-4">Список онлайн консультации</h3>
      <div class="card-body">
        <div id="table" class="table-editable">
          <span class="table-add float-right mb-3 mr-2">
            <a href="#!" class="text-success">  <i class="fas fa-plus fa-2x" aria-hidden="true"></i></a>
          </span>
          <table class="table table-bordered table-responsive-md table-striped text-center">
            <thead>
              <tr>
                <th class="text-center">ID</th>
                <th class="text-center">Дата создания</th>
                <th class="text-center">Номер транзакции</th>
                <th class="text-center">Цена</th>
                <th class="text-center">Выплата</th>
                <th class="text-center">Имя шлюза</th>
                <th class="text-center">Клиент</th>
                <th class="text-center">Врач</th>
                <th class="text-center">Ip адрес</th>

                <th class="text-center">Изменить</th>
              </tr>
            </thead>
            <tbody>
              @foreach($payments as $item)
                <tr>
                  <td class="pt-3-half">{{$item->id}}</td>
                  <td class="pt-3-half">{{$item->created_at}}</td>
                  <td class="pt-3-half">{{$item->TransactionId}}</td>
                  <td class="pt-3-half">{{$item->Amount}} тг.</td>
                  <td class="pt-3-half">{{$item->PayoutAmount}} тг.</td>
                  <td class="pt-3-half">{{$item->GatewayName}}</td>
                  <td class="pt-3-half">
                    {{$item->patient['user']['lastname']}} {{$item->patient['user']['firstname']}} {{$item->patient['user']['middlename']}}
                    <hr>
                    {{$item->Email}}
                  </td>
                  <td class="pt-3-half">{{$item->doctor['user']['lastname']}} {{$item->doctor['user']['firstname']}} {{$item->doctor['user']['middlename']}}</td>
                  <td class="pt-3-half">{{$item->IpAddress}}</td>
                  <td>
                    <span class="table-remove">
                      <button type="button" class="btn btn-danger btn-rounded btn-sm my-0">Удалить</button>
                    </span>
                  </td>
                </tr>
              @endforeach
              <!-- This is our clonable table line -->
            </tbody>
          </table>
          {{ $payments->links() }}
        </div>
      </div>
    </div>
    <!-- Editable table -->

  @endsection
