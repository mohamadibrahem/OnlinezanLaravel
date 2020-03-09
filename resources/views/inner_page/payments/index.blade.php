@extends('layouts.app')

@section('content')
   @section('title', 'Платежи')

   <div class="content-online_consultations mt-5 mb-5">
      <div class="container">
         <table class="table table-bordered">

            <thead>
               <tr>
                  <th>Номер транзакции</th>
                  <th>Дата и время консультации</th>
                  @if(Auth::user()->role_id == 3)
                     <th>Клиент</th>
                  @else
                     <th>Юрист</th>
                  @endif
                  @if(Auth::user()->role_id == 3)
                     <th>Сумма к выплате</th>
                  @else
                     <th>Сумма</th>
                  @endif
               </tr>
            </thead>

            <tbody>

            </tbody>
         </table>
      </div>
   </div>

@endsection
