@extends('admin.layouts.main')
@section('content')
  @section('title') {{"Учреждения"}} @endsection

    <div class="wrapper">
      <a href="/admin/institutions/" class="btn btn-primary">Назад</a>
      <br>
      <br>
      @if(count($errors))
        <br>
        <div class="form-group">
          <div class="alert alert-danger">
            <ul>
              @foreach($errors->all() as $error)
                <li>{{$error}}</li>
              @endforeach
            </ul>
          </div>
        </div>
        <br>
      @endif
      <form class="text-center border border-light p-5" action="{{route('institution_store')}}" method="post">
        {{csrf_field()}}

        <p class="h4 mb-4 col-md-8">Создать</p>
        <!-- Name -->
        <input type="text" class="form-control mb-4 col-md-8" placeholder="Название" name="name">

        <input type="text" class="form-control mb-4 col-md-8" placeholder="Адрес" name="address">

        <input type="text" class="form-control mb-4 col-md-8" placeholder="Город" name="city">

        <!-- Send button -->

        <button class="btn btn-info btn-block col-md-2" type="submit">Создать</button>
      </form>
    </div>

  @endsection
