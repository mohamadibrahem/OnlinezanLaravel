<div class="headers">
   <div class="container-fluid">
      <div class="row">
         <div class="col-2 col-md-2 text-center-logo">
            <a href="/"> <img src="{{asset('img/logo1.png')}}" style="padding: 10px 0px;" alt=""></a>
         </div>
         <div class="col-10 col-md-10 ">
            <div class="info-contact-header">
               <ul>
                  <li class="locations"> <a href=""><i class="fa fa-map-marker"></i> Республика Казахстан <br>
                     г. Нур-Султан ул. Айнакол 54/а</a> </li>

                     <li class="contact-information" style="border-right: 1px solid rgba(0, 0, 0, 0.14);">
                        <a href=""><i class="fa fa-phone"></i> +7 (777) 777 77 77</a><br>
                        <a href=""><i class="fa fa-envelope-open"></i>info@onlinezan.kz</a>
                     </li>
<li class="search_button">
                        <a href="#" class="search-cta" data-toggle="modal" data-target=".search-modal"><span><i
                        class="fa fa-search "></i><i
                        class="fa fa-times "></i></span></a>
                        <div class="search_form">
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
                     </li>

                        <li class="consultaion">
                           <a data-toggle="modal" data-target="#applicationConsultationModal">
                              <div class="form-cons">
                                 ЗАЯВКА НА КОНСУЛЬТАЦИЮ
                              </div>
                           </a>
                        </li>
                     </ul>

                  </div>
               </div>
            </div>
         </div>
      </div>
      <nav class="navbar1 navbar-expand-md navbar-dark bg-light">

         <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample04"
         aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
         <span class="navbar-toggler-icon"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
            viewBox="0 0 300 300">
            <path id="top" fill="none" stroke="#979797" stroke-linecap="square" stroke-width="30"
            d="M9.99812655,150 L292.015957,150" />
            <path id="middle" fill="none" stroke="#979797" stroke-linecap="square" stroke-width="30"
            d="M9.99812655,150 L292.015957,150" />
            <path id="bottom" fill="none" stroke="#979797" stroke-linecap="square" stroke-width="30"
            d="M9.99812655,150 L292.015957,150" />
         </svg>
      </span>
   </button>

   <div class="collapse navbar-collapse" id="navbarsExample04">
      <ul class="navbar-nav mr-auto">
         <li class="nav-item">
            <a class="nav-link" href="/">Главная</a>
         </li>
         <li class="nav-item dropdown position-static" id="superMenu">
            <a class="nav-link dropdown-toggle" href="service.html" id="navbarDropdown" role="button"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Услуги
         </a>
         <div class="dropdown-menu dd-m service-menu-mob w-100  m-0 p-0 shadow-sm" aria-labelledby="navbarDropdown">
            <div class="container-fluid">
               <div class="row">
                  <div class="col-12 col-lg-6 py-2">
                     <h6 style="font-weight: 600;">Для физических лиц</h6>
                     <hr style="width: 15%; float: left; margin: 0px;background: navy;">
                     <ul class="fiz-lica" style="padding:0">
                        @foreach ($services as $key => $value)
                           @if($value->type == 'individual' || $value->type == 'individual/legal')
                              <a class="dropdown-item" href="/services/{{$value->id}}">{{$value->name}}</a>
                           @endif
                        @endforeach
                     </ul>
                  </div>
                  <div class="col-12 col-lg-6  py-2 ">
                     <h6 style="font-weight: 600;">Для юридических лиц</h6>
                     <hr style="width: 15%; float: left; margin: 0px;background: navy;">
                     <ul class="iyr-lica" style="padding:0">
                        @foreach ($services as $key => $value)
                           @if($value->type == 'legal' || $value->type == 'individual/legal')
                              <a class="dropdown-item" href="/services/{{$value->id}}">{{$value->name}}</a>
                           @endif
                        @endforeach
                     </ul>
                  </div>
               </div>
            </div>
         </div>
      </li>
      <li class="nav-item">
         <a class="nav-link" href={{'/lawyers'}}>Юристы</a>
      </li>

      <li class="nav-item dropdown">
         <a class="nav-link dropdown-toggle" href="" id="dropdown04" data-toggle="dropdown"
         aria-haspopup="true" aria-expanded="false">Общая информация </a>
         <div class="dropdown-menu" aria-labelledby="dropdown04">
            <a class="dropdown-item" href={{'/information/for_lawyers'}}>Для юристов </a>
            <a class="dropdown-item" href="{{'/information/for_clients'}}">Для клиентов </a>
            <a class="dropdown-item" href="{{'/information/service'}}">Контроль качества услуг </a>
         </div>
      </li>
      <li class="nav-item">
         <a href={{'/contracts'}} class="nav-link">Договоры</a>
      </li>

      <li class="nav-item">
         <a href={{'/news'}} class="nav-link">Новости</a>
      </li>
      <li class="nav-item">
         <a class="nav-link" href={{"/contact"}}>Контакты</a>
      </li>
   </ul>
   <ul class="social">

      <li class="in-reg @if(Auth::check()) dropdown @endif">
         <a href=@if(!Auth::check()) {{'/login'}} @else {{'/profile'}}  @endif id="dropdownMenuButton" class="@if(Auth::check()) dropdown-toggle @endif" @if(Auth::check()) data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" @endif >@if(!Auth::check()) {{'Войти'}} @else {{'Личный кабинет'}}  @endif</a>
            <span style="margin:0px 10px">|</span>
            <a href=@if(!Auth::check()) {{'/register'}} @else {{ url('/logout') }}  @endif >@if(!Auth::check()) {{'Регистрация'}} @else {{'Выйти'}} @endif </a>

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
                        @if(Auth::user()->role_id == 4)
                           <a href={{"/urgent_consultations"}} class="dropdown-item">Срочная консультация</a>
                        @endif

                        @if(Auth::user()->role_id == 4)
                           <a href={{"/online_consultations"}} class="dropdown-item">Онлайн консультация</a>
                        @endif

                        @if(Auth::user()->role_id == 3)
                           @if(json_decode(Auth::user()->lawyer['service_types']) != null)
                              @foreach (json_decode(Auth::user()->lawyer['service_types']) as $key => $value)
                                 @if($value == "2")
                                    <a href={{"/urgent_consultations"}} class="dropdown-item notification">Срочная консультация
                                       @if($count_urgent_consultation != 0)
                                          <span class="notification_new"><span>{{$count_urgent_consultation}}</span></span>
                                       @endif
                                    </a>
                                 @endif
                              @endforeach
                           @endif
                        @endif

                        @if(Auth::user()->role_id == 3)
                           @if(json_decode(Auth::user()->lawyer['service_types']) != null)
                              @foreach (json_decode(Auth::user()->lawyer['service_types']) as $key => $value)
                                 @if($value == "1")
                                    <a href={{"/online_consultations"}} class="dropdown-item notification">Онлайн консультация</a>
                                 @endif
                              @endforeach
                           @endif
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

               <li class="inst"><a href="#!" class="nav-link inline"><i class="fa fa-instagram"></i></a></li>
               <li class="faceb"><a href="#!" class="nav-link inline"><i class="fa fa-facebook-official"></i></a></li>

            </ul>
         </div>
      </nav>
      <div class="page-name">
         <div class="container">

            <h3 class="text-center">@yield('title')</h3>

         </div>
      </div>
      <div class="breadcrumbs">
         <div class="container-fluid">
            <a href="/">Главная</a>
            <span>|</span>
            <a href="">@yield('title')</a>
         </div>
      </div>
