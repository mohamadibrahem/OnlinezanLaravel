@extends('admin.layouts.main')
@section('content')
  @section('title') {{"Учреждения"}} @endsection

    <!-- Editable table -->
    <div class="card">
      <h3 class="card-header text-center font-weight-bold text-uppercase py-4">Список учреждении</h3>
      <div class="card-body">
        <div id="table" class="table-editable">
          <span class="table-add float-right mb-3 mr-2">
            <a href="{{route('institution_create')}}" class="text-success">  <i class="fas fa-plus fa-2x" aria-hidden="true"></i></a>
          </span>
        </form>
          <table class="table table-bordered table-responsive-md table-striped text-center">
            <thead>
              <tr>
                <th class="text-center">ID</th>
                <th class="text-center">Название</th>
                <th class="text-center">Адрес</th>
                <th class="text-center">Город</th>
                <th class="text-center">Изменить</th>
              </tr>
            </thead>
            <tbody>
              @foreach($institutions as $item)
                <tr>
                  <td class="pt-3-half" contenteditable="true">{{$item->id}}</td>
                  <td class="pt-3-half" contenteditable="true">{{$item->name}}</td>
                  <td class="pt-3-half" contenteditable="true">{{$item->address}}</td>
                  <td class="pt-3-half" contenteditable="true">{{$item->city}}</td>
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
          {{ $institutions->links() }}
        </div>
      </div>
    </div>
    <!-- Editable table -->

  @endsection
