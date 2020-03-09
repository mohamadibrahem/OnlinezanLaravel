@extends('admin.layouts.main')
@section('content')
  @section('title') {{"Клиенты"}} @endsection

    <!-- Editable table -->
    <div class="card">
      <h3 class="card-header text-center font-weight-bold text-uppercase py-4">Список клиентов</h3>
      <div class="card-body">
        <div id="table" class="table-editable">
          {{-- <span class="table-add float-right mb-3 mr-2">
            <a href="#!" class="text-success">  <i class="fas fa-plus fa-2x" aria-hidden="true"></i></a>
          </span> --}}
          <table class="table table-bordered table-responsive-md table-striped text-center">
            <thead>
              <tr>
                <th class="text-center">ID</th>
                <th class="text-center">ФИО</th>
                <th class="text-center">Телефон</th>
                <th class="text-center">Email</th>
                {{-- <th class="text-center">Статус</th> --}}
                {{-- @if(Auth::user()->role_id == 1)
                  <th class="text-center">Изменить</th>
                @endif --}}
              </tr>
            </thead>
            <tbody>
              @foreach($clients as $client)
                <tr>
                  <td class="pt-3-half" contenteditable="true">{{$client->id}}</td>
                  <td class="pt-3-half" contenteditable="true">{{$client->user['lastname']}} {{$client->user['firstname']}} {{$client->user['middlename']}}</td>
                  <td class="pt-3-half" contenteditable="true">{{$client->user['phone']}}</td>
                  <td class="pt-3-half" contenteditable="true">{{$client->user['email']}}</td>
                  {{-- <td class="pt-3-half" contenteditable="true">
                    @if($client->user['status'] == 2)
                      Не активный
                    @else
                      Активный
                    @endif
                  </td> --}}
{{--
                  @if(Auth::user()->role_id == 1)
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
        </div>
      </div>
    </div>
    <!-- Editable table -->

  @endsection
