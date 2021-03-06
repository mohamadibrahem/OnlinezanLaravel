@extends('layouts.app')

@section('content')
   @section('title', 'Информация для юристов')

   <div class="content-information">
      <div class="container">
         <h3>Приветствуем Вас, уважаемый пользователь!</h3>
         <hr style="width: 15%; background: #042c7b;">
         <p class="text-center">
            <strong>Добро пожаловать на сайт электронной площадки «Онлайн-Юрист»</strong>
         </p>
         <p>
            Онлайн-Юрист  – это электронная площадка для интеграции и взаимодействия профессиональных юристов Казахстана с гражданами и юридическими лицами для получения последними квалифицированной юридической консультации и дальнейшего сопровождения по всем вопросам правового характера.
         </p>
         <p>
            Наша цель: Создание единой площадки для профессиональных юристов для обмена опытом и развития потенциала.
         </p>
         <p>Наша миссия:</p>
         <ul>
            <li>Получение каждым квалифицированной юридической помощи вне зависимости от его социального статуса и финансового положения.</li>
            <li>Оптимизация времени и расходов юристов на поиск потенциальных клиентов.</li>
            <li>Получение клиентами юридической помощи от необходимого юриста вне зависимости от их  местонахождения.</li>
            <li>Доступность взаимодействия юристов с клиентами в любом городе Казахстана.</li>
            <li>Повышение юридической грамотности населения путем действенных механизмов и практик. </li>
         </ul>
         <p>В связи с этим, Онлайн-Юрист предлагает юристам Казахстана возможность интегрировать на одной площадке, для предоставления населению юридических услуг, сокращая при этом административные расходы и время на поиск потенциальных клиентов.</p>
         <br>
         <h3 class="text-center">Как это работает?</h3>
         <p class="text-center"> <strong> Для этого необходимо всего 3 шага.</strong></p>
         <hr style="width: 15%; background-color: #042c7b;">
         <div class="row steps">
            <div class="col-md-4 col-12 firsts">
               <h1>1</h1>
               <p>Регистрируетесь на сайте</p>
            </div>
            <div class="col-md-4 col-12 seconds">
               <h1>2</h1>
               <p>Заполняете анкетные данные</p>
            </div>
            <div class="col-md-4 col-12 threes">
               <h1>3</h1>
               <p>Подписываете агентское соглашение</p>
            </div>
         </div>
         <p>После регистрации и проверки администратором полноты информации, информация о юристе публикуется на сайте, как в общем списке, так и в разделе отдельных отраслей, по которой он специализируется</p>
      </div>
   </div>
   

      @endsection
