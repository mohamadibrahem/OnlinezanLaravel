@extends('admin.layouts.main')
@section('content')
  @section('title') {{"Квалификация"}} @endsection

    <!-- Editable table -->
    <div class="card">
      <h3 class="card-header text-center font-weight-bold text-uppercase py-4">Список квалификации</h3>
      <div class="card-body">
        <div id="table" class="table-editable">
          <table class="table table-bordered table-responsive-md table-striped text-center">
            <thead>
              <tr>
                <th class="text-center">ID</th>
                <th class="text-center">Название</th>
                <th class="text-center">Изменить</th>
              </tr>
            </thead>
            <tbody>
              @foreach($qualifications as $item)
                <tr>
                  <td class="pt-3-half" contenteditable="true">{{$item->id}}</td>
                  <td class="pt-3-half" contenteditable="true">{{$item->name}}</td>
                  <td>
                    <span class="table-remove">
                    <button type="button" class="btn btn-primary btn-rounded btn-sm my-0">Изменить</button>
                  </span>
                  </td>
                </tr>
              @endforeach
              <!-- This is our clonable table line -->
            </tbody>
          </table>
          {{ $qualifications->links() }}
        </div>
      </div>
    </div>
    <!-- Editable table -->

  @endsection
