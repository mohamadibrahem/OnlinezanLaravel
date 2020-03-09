<div class="footer">
   <div class="container">
      <div class="row">
         <div class="col-md-3 mobile-gajet">
            <img src="img/logo.png"  alt="">
            <ul class="contact-list">
               <li>
                  <div class="mobile-gajet">

                     <p>Республика Казахстан <br> г. Нур-Султан ул. Айнакол 54/а</p>
                  </div>
               </li>
               <li>
                  <div class="mobile-gajet">

                     <p><a class="tc-white" href="tel:+77777777777">+7 (777) 777 77 77</a><br>
                        <a class="tc-white" href="tel:+77777777777">+7 (777) 777 77 77</a></p>
                     </div>
                  </li>
                  <li>
                     <div class="mobile-gajet">

                        <p><a class="tc-white"href="mailto:info@astplus.kz">info@astplus.kz</a></p>
                     </div>
                  </li>
               </ul>
            </div>
            <div class="col-md-6">
               <div class="row1">
                  <div class="col-md-6 col-12">
                     <hr style="background: #fff;">
                     <h6 class="mobile-gajet">ДЛЯ ФИЗИЧЕСКИХ ЛИЦ:</h6>
                     <hr style="background: #fff;">
                     <ul class="footer-ul-padding">
                        @foreach ($services as $key => $value)
                           @if($value->type == 'individual' || $value->type == 'individual/legal')
                              <li><a href={{route('services.show', $value->id)}}>{{$value->name}}</a></li>
                           @endif
                        @endforeach
                     </ul>
                  </div>
                  <div class="col-md-6 col-12">
                     <hr style="background: #fff;">
                     <h6 class="mobile-gajet">ДЛЯ ЮРИДИЧЕСКИХ ЛИЦ:</h6>
                     <hr style="background: #fff;">
                     <ul class="footer-ul-padding">
                        @foreach ($services as $key => $value)
                           @if($value->type == 'legal' || $value->type == 'individual/legal')
                              <li><a href={{route('services.show', $value->id)}}>{{$value->name}}</a></li>
                           @endif
                        @endforeach
                     </ul>
                  </div>
               </div>
            </div>
            <div class="col-md-3">
               <hr style="background: #fff;">
               <h6 class="mobile-gajet" style="text-transform: uppercase;">Карта сайта:</h6>
               <hr style="background: #fff;">
               <ul class="footer-ul-padding">
                  <li><a href="">Главная</a></li>
                  <li><a href="">Услуги</a></li>
                  <li><a href="">Юристы</a></li>
                  <li><a href="">Общая информация</a></li>

                  <li><a href="">Контакты</a></li>

               </ul>
            </div>
         </div>
         <hr style="background: #fff;">
         <div class="row">
            <div class="col-md-12">
               <span class="tc-white" style="font-size: 12px;">
                  <a href="" class="tc-white">Политика кофидециальности</a> | <a href="" class="tc-white">Условия пользования</a> | Все права защищены 2019 ©
               </span>
               <span style="float: right;">
                  <a class="tc-white" href="#"><i class="fa fa-instagram " aria-hidden="true"></i></a>
                  <a class="tc-white" href="#"><i class="fa fa-facebook-official " aria-hidden="true"></i></a>
               </span>
            </div>
         </div>
      </div>
   </div>
