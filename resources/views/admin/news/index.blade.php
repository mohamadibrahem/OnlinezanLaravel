@extends('admin.layouts.main')
@section('content')
  @section('title') {{"Новости"}} @endsection

    <!-- Editable table -->
    <div class="card">
      <h3 class="card-header text-center font-weight-bold text-uppercase py-4">Список новостей</h3>
      <div class="card-body">
        <div id="table" class="table-editable">
          <span class="table-add float-right mb-3 mr-2">
             <a href="/admin/news/create_page" class="text-success">  <i class="fas fa-plus fa-2x" aria-hidden="true"></i> &nbsp; Добавить новости</a>
          </span>
          <table class="table table-bordered table-responsive-md table-striped text-center">
            <thead>
              <tr>
                <th class="text-center">ID</th>
                <th class="text-center">Заголовок</th>
                <th class="text-center">Текст</th>
                <th class="text-center">Дата создания</th>
                @if(Auth::user()->role_id == 1)
                  <th class="text-center">Изменить</th>
                @endif
              </tr>
            </thead>
            <tbody>
              @foreach($news as $item)
                <tr>
                  <td class="pt-3-half">{{$item->id}}</td>
                  <td class="pt-3-half">{{$item->title}}</td>
                  <td class="pt-3-half"> @if($item->text != null){!!substr($item->text, 0, 200)!!} @else Пусто @endif </td>
                  <td class="pt-3-half">{{$item->created_at}}</td>
                  @if(Auth::user()->role_id == 1)
                    <td>
                       <a class="btn btn-primary btn-rounded btn-sm my-0" href="/admin/news/edit/page/{{$item->id}}"><Remove>Изменить</Remove></a><br><br>                      
                       <a class="btn btn-danger btn-rounded btn-sm my-0" href="/admin/news/delete/{{$item->id}}"><Remove>Удалить</Remove></a>
                    </td>
                  @endif
                </tr>
              @endforeach
              <!-- This is our clonable table line -->
            </tbody>
          </table>
          {{ $news->links() }}
        </div>
      </div>
    </div>
    <!-- Editable table -->

  @endsection
