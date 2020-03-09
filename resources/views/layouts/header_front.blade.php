<div class="header">
   <nav class="navbar navbar-expand-md navbar-dark bg-dark navbar-offcanvas">
      <div class="container-fluid">

         <a class="navbar-brand" href="#" ><img src="{{asset('img/logo.png')}}" alt=""></a>
         <a class="my-btn" data-toggle="modal" data-target="#applicationConsultationModal1">Заявка на консультацию</a>
         <button class="navbar-toggler navbar-toggler-right navbar-icon" type="button" data-toggle="collapse"
         data-target="#navbar-mobile" aria-controls="navbar-mobile" aria-expanded="false"
         aria-label="Toggle navigation">
         <span class="icon-bar bar1"></span>
         <span class="icon-bar bar2"></span>
         <span class="icon-bar bar3"></span>
      </button>

      <div class="navbar-collapse collapse ml-auto" id="navbar-mobile">

         <ul class="navbar-nav ml-auto">
            @if(Auth::check())
               <li class="nav-image">
                  <div class="image">
                     <img src={{asset('/uploads') .'/'. Auth::user()->profile_photo}} alt="">
                  </div>
                  <p>{{Auth::user()->lastname}} {{Auth::user()->firstname}}</p>
               </li>
            @endif

            <li class="nav-item dropdown" id="profile_link">
               <a href=@if(!Auth::check()) {{'/login'}} @else @if(Auth::user()->role_id == 1) {{'/admin/profile/'}}
               @else {{'#'}}@endif @endif
                  class="nav-link inline @if(Auth::check()) dropdown-toggle @endif" @if(Auth::check()) id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" @endif>
                     @if(!Auth::check()) {{'Войти'}} @else {{'Личный кабинет'}}  @endif
                     </a>&nbsp;&nbsp;/&nbsp;&nbsp;
                     <a href=@if(!Auth::check()) {{'/register'}} @else {{ url('/logout') }}  @endif class="nav-link inline">@if(!Auth::check()) {{'Регистрация'}} @else {{'Выйти'}}  @endif</a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                           @if(Auth::check())
                              <a href=@if(Auth::user()->role_id == 1) {{"/admin/profile"}} @else {{"/profile"}} @endif class="dropdown-item">@if(Auth::user()->role_id == 1) {{'Админ'}} @else {{'Профиль'}} @endif</a>
                                 @if(Auth::user()->role_id == 3)
                                    <a href={{"/applications"}} class="dropdown-item notification">Заявки на консультацию
                                       @if($count_application_consultation != 0)
                                          <span class="notification_new"><span>{{$count_application_consultation}}</span></span>
                                       @endif
                                    </a>
                                 @endif

                                 @if(Auth::user()->role_id == 3)
                                    @if(json_decode(Auth::user()->lawyer['service_types']) != null)
                                       @foreach (json_decode(Auth::user()->lawyer['service_types']) as $key => $value)
                                          @if($value == "2")
                                             <a href={{"/urgent_consultations"}} class="dropdown-item">Срочная консультация</a>
                                          @endif
                                       @endforeach
                                    @endif
                                 @endif

                                 @if(Auth::user()->role_id == 3)
                                    @if(json_decode(Auth::user()->lawyer['service_types']) != null)
                                       @foreach (json_decode(Auth::user()->lawyer['service_types']) as $key => $value)
                                          @if($value == "1")
                                             <a href={{"/online_consultations"}} class="dropdown-item">Онлайн консультация</a>
                                          @endif
                                       @endforeach
                                    @endif
                                 @endif

                                 @if(Auth::user()->role_id == 4)
                                    <a href={{"/urgent_consultations"}} class="dropdown-item">Срочная консультация</a>
                                 @endif

                                 @if(Auth::user()->role_id == 4)
                                    <a href={{"/online_consultations"}} class="dropdown-item">Онлайн консультация</a>
                                 @endif

                                 @if(Auth::user()->role_id == 3)
                                    @if(json_decode(Auth::user()->lawyer['service_types']) != null)
                                       @foreach (json_decode(Auth::user()->lawyer['service_types']) as $key => $value)
                                          @if($value == "1")
                                             <a href={{"/schedules"}} class="dropdown-item">График консультация</a>
                                          @endif
                                       @endforeach
                                    @endif
                                    <a href={{"/my_clients"}} class="dropdown-item">Мои клиенты</a>
                                 @endif
                                 @if(Auth::user()->role_id == 3 || Auth::user()->role_id == 4)
                                    <a href={{"/payments"}} class="dropdown-item">Мои платежи</a>
                                    <a href={{"/test"}} class="dropdown-item">Проверка связи</a>
                                 @endif
                              @endif
                           </div>
                        </li>
                        <li class="nav-item">
                           <a href="/" class="nav-link">Главная</a>
                        </li>
                        <li class="nav-item">
                           <a href={{'/lawyers'}} class="nav-link">Юристы</a>
                        </li>
                        <li class="nav-item sub-item-list">
                           <a href="#homeSubmenu" class="mg-1" data-toggle="collapse" aria-expanded="false">Услуги
                              <img src="img/back.png" alt=""></a>
                              <ul class="collapse list-unstyled" id="homeSubmenu">
                                 <li>
                                    <a href="#homeSubmenu1" data-toggle="collapse" aria-expanded="false">Для юридических лиц
                                       <img src="img/back.png" alt=""><img src="img/back.png" alt="">
                                    </a>
                                 </li>
                                 <ul class="collapse list-unstyled" id="homeSubmenu1">
                                    @foreach ($services as $key => $value)
                                       @if($value->type == 'legal' || $value->type == 'individual/legal')
                                          <a class="dropdown-item" href="/services/{{$value->id}}">{{$value->name}}</a>
                                       @endif
                                    @endforeach
                                 </ul>
                                 <li>
                                    <a href="#homeSubmenu2" data-toggle="collapse" aria-expanded="false">Для физических лиц
                                       <img src="img/back.png" alt=""><img src="img/back.png" alt="">
                                    </a>
                                 </li>
                                 <ul class="collapse list-unstyled" id="homeSubmenu2">
                                    @foreach ($services as $key => $value)
                                       @if($value->type == 'individual' || $value->type == 'individual/legal')
                                          <a class="dropdown-item" href="/services/{{$value->id}}">{{$value->name}}</a>
                                       @endif
                                    @endforeach
                                 </ul>

                              </ul>
                           </li>
                           <li class="nav-item sub-item-list">
                              <a href="#homeSubmenu3" data-toggle="collapse" aria-expanded="false">Общая информация
                                 <img src="img/back.png" alt=""></a>
                              </li>
                              <ul class="collapse list-unstyled" id="homeSubmenu3">
                                 <a class="dropdown-item" href={{'/information/for_lawyers'}}>Для юристов </a>
                                 <a class="dropdown-item" href="{{'/information/for_clients'}}">Для клиентов </a>
                                 <a class="dropdown-item" href="{{'/information/service'}}">Контроль качества услуг </a>
                              </ul>

                              <li class="nav-item">
                                 <a href={{'/contracts'}} class="nav-link">Договоры</a>
                              </li>

                              <li class="nav-item">
                                 <a href={{'/news'}} class="nav-link">Новости</a>
                              </li>

                              <li class="nav-item">
                                 <a href={{'/contact'}} class="nav-link">Контакты</a>
                              </li>

                              <br>

                              <br>

                              <li class="nav-item ">
                                 <a href="#!" class="nav-link inline"><i class="fa fa-instagram fa-2x"></i></a><a
                                 href="#!" class="nav-link inline"><i class="fa fa-facebook-official fa-2x"></i></a>
                              </li>
                           </ul>

                        </div>
                     </div>
                  </nav>
               </div>
