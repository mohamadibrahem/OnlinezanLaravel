@extends('layouts.app')

@section('content')
   @section('title', 'Договор')

   <div class="content-news mt-5 mb-5">
      <div class="container ">
         @if(session()->has('messages'))
            <div class="alert alert-success">
               {{ session()->get('messages') }}
            </div>
         @endif

         <form action="{{route('admin_contracts_store')}}" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="form-group">
               <label for="title">Заголовок</label>
               <input type="text" class="form-control" id="title" name="title">
            </div>
            <div class="form-group">
               <label for="text">Текст</label>
               <textarea class="form-control" id="text" name="text"> </textarea>
            </div>
            <div class="form-group">
               <label for="price">Цена</label>
               <input class="form-control col-md-2" id="price" name="price">
            </div>

            <div class="custom-file">
               <input type="file" class="custom-file-input" id="customFileLangHTML" name="file">
               <label class="custom-file-label" for="customFileLangHTML" data-browse="Выберите файл">Договор</label>
            </div>

            <hr>

            {{--<div class="form-group">
            <div class="input-group">
            <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroupFileAddon01">Прикрепить файл</span>
         </div>
         <div class="custom-file">
         <input type="file" class="custom-file-input" id="inputGroupFile01"
         aria-describedby="inputGroupFileAddon01">
         <label class="custom-file-label" for="inputGroupFile01">Выберите файл</label>
      </div>
   </div>
</div> --}}

<button type="submit" class="btn btn-primary">Сохранить</button>
</form>

</div>
</div>

@endsection
