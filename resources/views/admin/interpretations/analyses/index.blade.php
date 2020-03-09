@extends('admin.layouts.main')
@section('content')
  @section('title') {{"Расшифровка анализов"}} @endsection

    <!-- Editable table -->
    <div class="card">
      <h3 class="card-header text-center font-weight-bold text-uppercase py-4">Список расшифровок</h3>
      <div class="card-body">
        <div id="table" class="table-editable">
          <span class="table-add float-right mb-3 mr-2">
            <a href="#!" class="text-success">  <i class="fas fa-plus fa-2x" aria-hidden="true"></i></a>
          </span>
          <table class="table table-bordered table-responsive-md table-striped text-center">
            <thead>
              <tr>
                <th class="text-center">ID Заказа</th>
                <th class="text-center">Врач</th>
                <th class="text-center">Пациент</th>
                <th class="text-center">Статус</th>
                @if(Auth::user()->role_id == 1)
                  <th class="text-center">Изменить</th>
                @endif
              </tr>
            </thead>
            <tbody>

              <!-- This is our clonable table line -->
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <!-- Editable table -->
  @endsection
