@extends('layouts.app')

@section('content')
   @section('title', 'Поиск')

   <div class="content-search">

      <div class="container bootstrap snippet search_block">
         <div class="row">
            <div class="col-lg-12">
               <div class="ibox float-e-margins">
                  <br>
                  <br>
                  <div class="ibox-content">
                     <h2>
                        Количество результатов: {{$search_counter}}
                     </h2>
                     <div class="search-form">
                        <form action="{{route('search_get')}}" method="GET" >
                           {{ csrf_field() }}
                           <div class="input-group">
                              <input type="text" placeholder="Поиск" name="search" class="form-control input-lg">
                              <div class="input-group-btn">
                                 <button class="btn btn-primary" type="submit">
                                    Найти
                                 </button>
                              </div>
                           </div>
                        </form>
                     </div>

                     <br>
                     <br>

                     @foreach ($search as $key => $value)

                        <div class="search-result">
                           <h5><a href="/{{$value['type']}}/{{$value['id']}}">{{$value['title']}}</a></h5>
                           <p>
                              {{$value['text']}}
                           </p>
                        </div>
                        <div class="hr-line-dashed"></div>
                     @endforeach

                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>

@endsection
