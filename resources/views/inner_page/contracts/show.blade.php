@extends('layouts.app')

@section('content')
   @section('title', 'Договор')

   <div class="content-news pt-4 pb-4">
      <div class="container ">

         <div class="items">
            <div class="row item">
               <div class="group-left">
                  <div class="title">
                     <h4>{{$contract->title}}</h4>
                  </div>
               </div>

               <div class="group-right">
                  <div class="text">
                     <p>{{$contract->text}}</p>
                  </div>
                  <div class="price">Цена: @if($contract->price != null) <b>{{$contract->price}}</b>  @else 0 @endif тг</div>
                     <br>
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ContractDownload">
                     Скачать полную версию
                  </button>

               </div>
            </div>

         </div>


      </div>
   </div>

   @include('inner_page.contracts.modal')
@endsection
