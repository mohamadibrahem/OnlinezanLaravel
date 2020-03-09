@extends('layouts.app')

@section('content')
   @section('title', 'Контакты')

   <div class="content-contact">
      <div class="container ">
         <div class="row">
            <div class="col-md-9 col-12">

               @if(session()->has('message'))
                  <div class="alert alert-success">
                     {{ session()->get('message') }}
                  </div>
               @endif

               <div class="errors">
                  @if ($errors->any())
                     <div class="alert alert-danger">
                        <ul>
                           @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                           @endforeach
                        </ul>
                     </div>
                  @endif
               </div>

               <form id="contact-form" action="{{route('contact_mail')}}" method="post">
                  {{csrf_field()}}
                  <div class="form-row">
                     <div class="form-group col-md-6">
                        <input type="name" class="form-control" id="nameinput" placeholder="Ваше имя" name="name">
                     </div>
                     <div class="form-group col-md-6">
                        <input type="mailinput" class="form-control" id="mailinput" placeholder="Ваша почта" name="email">
                     </div>
                  </div>
                  <div class="form-group">
                     <input type="text" class="form-control" id="themeinput" placeholder="Тема письма" name="subject">
                  </div>
                  <div class="form-group">
                     <textarea type="text" id="message" name="message" rows="5" class="form-control md-textarea"
                     placeholder="Ваше сообщение"></textarea>
                  </div>
                  <button class="send-btn" type="submit">Отправить</button>
               </form>
            </div>
            <div class="col-md-3 col-12 contacts">
               <ul class="list-unstyled text-center">
                  <li><i class="fa fa-map-marker fa-2x"></i>
                     <p class="text-center">Республика Казахстан <br>
                        г. Нур-Султан ул. Айнакол 54/а</p>
                     </li>

                     <li><i class="fa fa-phone mt-4 fa-2x"></i><br>
                        <a href="tel:+7 (777) 777 77 77" class="tc-black text-center">
                           +7 (777) 777 77 77
                        </a><br>
                        <a href="tel:+7 (777) 777 77 77" class="tc-black text-center">
                           +7 (777) 777 77 77
                        </a>
                     </li>

                     <li><i class="fa fa-envelope mt-5 fa-2x"></i>
                        <a href="mailto:info@onlinezan.kz" class="tc-black">
                           <p class="text-center">info@onlinezan.kz</p>
                        </a>
                     </li>
                  </ul>
               </div>
            </div>
         </div>
      </div>

   @endsection
