@extends('admin.layouts.main')
@section('content')
  @section('title') {{"Расшифровка снимков"}} @endsection

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
                @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 5)
                  <th class="text-center">Файл</th>
                @endif
                @if(Auth::user()->role_id == 1)
                  <th class="text-center">Изменить</th>
                @endif
              </tr>
            </thead>
            <tbody>
              @foreach($interpretations as $item)
                <tr>
                  <td class="pt-3-half"><h5>{{$item->id}}</h5></td>
                  <td class="pt-3-half" contenteditable="true">
                    {{$item->doctor['user']['lastname']}} {{$item->doctor['user']['firstname']}}
                  </td>
                  <td class="pt-3-half" contenteditable="true">
                    {{$item->patient['user']['lastname']}} {{$item->patient['user']['firstname']}}
                  </td>
                  <td>
                    @if($item->status == 0)
                      {{'Новый'}}
                    @elseif($item->status == 1)
                      {{'В обработке'}}
                    @elseif($item->status == 2)
                      {{'Расшифрован'}}
                    @endif
                  </td>
                  @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 5)
                    <td>
                      @if($item->status == 0)
                        <form action="{{route('interpretation_accepted', $item->id)}}" method="post" enctype="multipart/form-data">
                          {{csrf_field()}}
                          <button type="submit" class="btn btn-primary btn-rounded btn-sm my-0">Принять</button>
                        </form>

                      @elseif($item->status == 1)
                        <form action="{{route('interpretation_answer', $item->id)}}" method="post" enctype="multipart/form-data">
                          {{csrf_field()}}
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="inputGroupFileAddon01">Загрузить</span>
                            </div>
                            <div class="custom-file">
                              <input type="file" class="custom-file-input" id="inputGroupFile01" name="interpretation_file"
                              aria-describedby="inputGroupFileAddon01">
                              <label class="custom-file-label" for="inputGroupFile01">Отправить расшифрованный файл пациенту</label>
                            </div>
                          </div>
                          <br>
                          <button type="submit" class="btn btn-primary btn-rounded btn-sm my-0">Отправить</button>
                        </form>
                        <br>
                      @elseif($item->status == 2)
                        {{'Файл расшифровки отправлен пациенту'}}
                      @endif

                    </td>
                  @endif

                  @if(Auth::user()->role_id == 1)
                    <td>
                      <span class="table-remove">
                        <button type="button" class="btn btn-danger btn-rounded btn-sm my-0">Удалить</button>
                      </span>
                    </td>
                  @endif
                </tr>

              @endforeach
              <!-- This is our clonable table line -->
            </tbody>
          </table>

          {{ $interpretations->links() }}

        </div>
      </div>
    </div>
    <!-- Editable table -->

  @endsection
