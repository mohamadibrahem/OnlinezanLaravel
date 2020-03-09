@extends('admin.layouts.main')
@section('content')
  @section('title') {{"Контроль качества"}} @endsection

    <!-- Editable table -->
    <div class="card">
      <h3 class="card-header text-center font-weight-bold text-uppercase py-4">Список заявок</h3>
      <div class="card-body">
        <div id="table" class="table-editable">
          <table class="table table-bordered table-responsive-md table-striped text-center">
            <thead>
              <tr>
                <th class="text-center">ID</th>
                <th class="text-center">Имя</th>
                <th class="text-center">Телефон</th>
                <th class="text-center">Сообщения</th>
                <th class="text-center">Дата заявки</th>
              </tr>
            </thead>
            <tbody>
              @foreach($contacts as $item)
                <tr>
                  <td class="pt-3-half">{{$item->id}}</td>
                  <td class="pt-3-half">{{$item->name}}</td>
                  <td class="pt-3-half">{{$item->phone}}</td>
                  <td class="pt-3-half">{{$item->comment}}</td>
                  <td class="pt-3-half">{{$item->created_at}}</td>
                </tr>
              @endforeach
              <!-- This is our clonable table line -->
            </tbody>
          </table>
          {{ $contacts->links() }}
        </div>
      </div>
    </div>
    <!-- Editable table -->

  @endsection
