@extends('layouts.app')

@section('content')
   @section('title', 'Мои клиенты')

   <div class="content-online_consultations mt-5 mb-5">
      <div class="container">
         <table class="table table-bordered">

            <thead>
               <tr>
                  <th>Клиент</th>
                  <th>Email</th>
                  <th>Телефон</th>
               </tr>
            </thead>

            <tbody>
               @foreach ($clients as $key => $value)
                  <tr>
                  <td  data-label="Клиент">{{$value->user['lastname']}} {{$value->user['firstname']}}</td>
                  <td  data-label="Email">{{$value->user['email']}}</td>
                  <td  data-label="Телефон">{{$value->user['phone']}}</td>
                  <tr>
               @endforeach
            </tbody>

         </table>
      </div>
   </div>

@endsection
