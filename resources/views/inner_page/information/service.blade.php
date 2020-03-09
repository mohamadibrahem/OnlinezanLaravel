@extends('layouts.app')

@section('content')
   @section('title', 'Контроль качества услуг')

   <div class="content-information">
      <div class="container">
         <h3>Приветствуем Вас, уважаемый пользователь!</h3>
         <hr style="width: 15%; background: #042c7b;">
         <p class="text-center">
            <strong>Данный раздел предназначен для повышения качества представляемых услуг посредством электронной площадки «Онлайн-Юрист».</strong>
         </p>
         <p>
            Мы заинтересованы в том, чтобы любая информация, касательно деятельности онлайн-площадки доходила до нас, и мы будем рады получить от Вас как отзывы, так и предложения, по улучшению качества представляемых услуг.
         </p>
         <p>
            Здесь Вы можете написать нам свое мнение, касательно полученной услуги от юриста, а также дать соответствующую оценку и комментарии, для повышения популярности юриста, либо принятия мер по улучшению качества услуг.
         </p>
         <div class="row">
            <div class="col-md-6 col-12">
               <h3 class="text-center">Как это работает?</h3>
               <p>Для этого необходимо написать нам свой отзыв по полученной услуге и указать контактную информацию.</p>
               <p>Наши менеджеры свяжутся с Вами в ближайшее время для уточнения Вашего обращения и принятия соответствующих мер.</p>
               <p>В случае, если услуга не была оказана должным образом, администратор онлайн-площадки вправе принять решение о возврате денежных средств за оказанную услугу, с вычетом услуг сервиса.</p>
               <p>Мы намерены интегрировать в портале профессиональных юристов, знающих свое дело и готовых зарабатывать на этом, в связи с чем высоко ценим получение Вами качественных услуг!</p>
            </div>
            <div class="col-md-6 col-12">
               <div class="borders-form">
                  <h5 class="text-center">Оставьте отзыв <br>об оказанной услуге</h5>
                 
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

                  <form class="form-control-jurist" action="{{route('service_control_mail')}}" method="post">
                     {{csrf_field()}}
                     <input type="text" placeholder="Ф.И.О" class="form-control" name="name"><br>
                     <input type="number" placeholder="Телефон" class="form-control" name="phone"><br>
                     <textarea name="message" class="form-control" rows="" placeholder="&nbsp;&nbsp;Ваш отзыв или комментарий"></textarea>
                     <button type="submit" class="btn btn-primary">Отправить</button>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
   

      @endsection
