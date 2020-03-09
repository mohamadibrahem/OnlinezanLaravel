

<div id="five" class="page">
   <div class="container padding-top">
      <div class="row">
         <div class="col-md-4 col-xs-12 tc-white ">
            <h4 class="text-center">Контактные данные:</h4>
            <br>
            <ul class="contact-list">
               <li>
                  <div class="flex-box">
                     <p><i class="fa fa-street-view " style="font-size:30px"></i></p>
                     <p>Республика Казахстан <br> г. Нур-Султан ул. Айнакол 54/а</p>
                  </div>
               </li>
               <li>
                  <div class="flex-box">


                     <p><i class="fa fa-phone-square " style="font-size:30px"></i></p>
                     <p><a class="tc-white" href="tel:+77777777777">+7 (777) 777 77 77</a><br>
                        <a class="tc-white" href="tel:+77777777777">+7 (777) 777 77 77</a></p>
                     </div>
                  </li>
                  <li>
                     <div class="flex-box">


                        <p><i class="fa fa-envelope-o" style="font-size:28px"></i></p>
                        <p class="mail-padding"><a class="tc-white"
                           href="mailto:info@astplus.kz">info@astplus.kz</a></p>
                        </div>
                     </li>
                  </ul>




               </div>
               <div class="col-md-4 col-xs-12 tc-white ">
                  <h4 class="text-center">Наши сервисы:</h4>
                  <br>
                  <h6 class="text-center">ДЛЯ ФИЗИЧЕСКИХ ЛИЦ</h6>
                  <hr style="width: 10%; background:#fff">
                  <ul>
                     @foreach ($services as $key => $value)
                        @if($value->type == 'individual' || $value->type == 'individual/legal')
                           <li><a href={{route('services.show', $value->id)}}>{{$value->name}}</a></li>
                        @endif
                     @endforeach
                  </ul>
                  <h6 class="text-center">ДЛЯ ЮРИДИЧЕСКИХ ЛИЦ</h6>
                  <hr style="width: 10%; background:#fff">
                  <ul>
                     @foreach ($services as $key => $value)
                        @if($value->type == 'legal' || $value->type == 'individual/legal')
                           <li><a href={{route('services.show', $value->id)}}>{{$value->name}}</a></li>
                        @endif
                     @endforeach
                  </ul>
               </div>
               <div class="col-md-4 col-xs-12 tc-white">
                  <h4 class="text-center ">Карта сайта:</h4>

                  <br>
                  <ul>
                     <li><a href="">Главная</a></li>
                     <li><a href="">Юристы</a></li>
                     <li><a href="">Информация для юристов</a></li>
                     <li><a href="">Комплексные услуги</a></li>
                     <li><a href="">Контроль качества услуг</a></li>
                     <li><a href="">Контакты</a></li>
                     <li><a href="">Система оплаты</a></li>
                  </ul>
               </div>

            </div>
         </div>

         <div class="container footer-info">
            <hr style="background-color: #ffff;">
            <div class="">
               <p class="tc-white" style="font-size: 12px;"> <a href="" class="tc-white">Политика
                  кофидециальности</a> | <a href="" class="tc-white">Условия пользования</a> | Все права
                  защищены 2019 © </p>
               </div>
               <div class="">
                  <a class="tc-white" href="#"><i class="fa fa-instagram " aria-hidden="true"></i></a>
                  <a class="tc-white" href="#"><i class="fa fa-facebook-official " aria-hidden="true"></i></a>
               </div>
            </div>


         </div>
