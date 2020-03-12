<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Admin 1430.kz</title>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
  <!-- Bootstrap core CSS -->
  <link href="/admin/css/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="/admin/css/mdb.min.css" rel="stylesheet">
  <!-- Your custom styles (optional) -->
  <link href="/admin/css/style.min.css" rel="stylesheet">
  <link href="/admin/css/custom.css" rel="stylesheet">

  <style>

  .map-container{
    overflow:hidden;
    padding-bottom:56.25%;
    position:relative;
    height:0;
  }
  .map-container iframe{
    left:0;
    top:0;
    height:100%;
    width:100%;
    position:absolute;
  }
  </style>
</head>

<body class="grey lighten-3">

  <!--Main Navigation-->
  <header>
    <!-- Navbar -->
    <nav class="navbar fixed-top navbar-expand-lg navbar-light white scrolling-navbar">
      <div class="container-fluid">

        <!-- Brand -->
        {{-- <a class="navbar-brand waves-effect" href="https://mdbootstrap.com/docs/jquery/" target="_blank">
          <strong class="blue-text">MDB</strong>
        </a> --}}

        <!-- Collapse -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Links -->
      <div class="collapse navbar-collapse" id="navbarSupportedContent">

        <!-- Left -->
        <ul class="navbar-nav mr-auto">
          {{-- <li class="nav-item active">
            <a class="nav-link waves-effect" href="#">Home
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link waves-effect" href="https://mdbootstrap.com/docs/jquery/" target="_blank">About
              MDB</a>
            </li>
            <li class="nav-item">
              <a class="nav-link waves-effect" href="https://mdbootstrap.com/docs/jquery/getting-started/download/"
              target="_blank">Free
              download</a>
            </li>
            <li class="nav-item">
              <a class="nav-link waves-effect" href="https://mdbootstrap.com/education/bootstrap/" target="_blank">Free
                tutorials</a>
              </li> --}}
            </ul>

            <!-- Right -->
            <ul class="navbar-nav nav-flex-icons">
              {{-- <li class="nav-item">
                <a href="https://www.facebook.com/mdbootstrap" class="nav-link waves-effect" target="_blank">
                  <i class="fab fa-facebook-f"></i>
                </a>
              </li>
              <li class="nav-item">
                <a href="https://twitter.com/MDBootstrap" class="nav-link waves-effect" target="_blank">
                  <i class="fab fa-twitter"></i>
                </a>
              </li>
              <li class="nav-item">
                <a href="https://github.com/mdbootstrap/bootstrap-material-design" class="nav-link border border-light rounded waves-effect"
                target="_blank">
                <i class="fab fa-github mr-2"></i>MDB GitHub
              </a>
            </li> --}}

            <li class="nav-item">
              <a href="/logout" class="nav-link waves-effect">Выйти</a>
            </li>
          </ul>

        </div>

      </div>
    </nav>
      <div class="d-flex justify-content-center">
        @if (session('messages'))
            <div style="position: absolute;z-index: 999999;" class="alert alert-danger">
                {{ session('messages') }}
            </div>
        @endif  
      </div>

  </header>

  <!-- Navbar -->

  <!-- Sidebar -->
  <div class="sidebar-fixed position-fixed">
    <a class="logo-wrapper waves-effect" href="/" style="font-size:38px;padding:10px;">
      Юрист
    </a>
    <div class="list-group list-group-flush">

      {{-- @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
        <a href="/admin/dashboard" class="list-group-item waves-effect @if(request()->path() == 'admin/dashboard') {{'active'}} @endif">
          <i class="fas fa-chart-pie mr-3"></i>Dashboard
        </a>
      @endif --}}

      @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
        <a href="/admin/lawyers" class="list-group-item waves-effect @if(request()->path() == 'admin/lawyers') {{'active'}} @endif">
          <i class="fas fa-chart-pie mr-3"></i>Юристы
        </a>
      @endif

      @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
        <a href="/admin/clients" class="list-group-item waves-effect @if(request()->path() == 'admin/clients') {{'active'}} @endif">
          <i class="fas fa-chart-pie mr-3"></i>Клиенты
        </a>
      @endif

      @if(Auth::user()->role_id == 1)
        <a href="/admin/users" class="list-group-item waves-effect @if(request()->path() == 'admin/users') {{'active'}} @endif">
          <i class="fas fa-chart-pie mr-3"></i>Пользователи
        </a>
      @endif

      @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
        <a href="/admin/consultations/urgent" class="list-group-item waves-effect @if(request()->path() == 'admin/consultations/urgent') {{'active'}} @endif">
          <i class="fas fa-chart-pie mr-3"></i>Срочная консультация
        </a>
      @endif

      @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
        <a href="/admin/consultations/online" class="list-group-item waves-effect @if(request()->path() == 'admin/consultations/online') {{'active'}} @endif">
          <i class="fas fa-chart-pie mr-3"></i>Онлайн консультация
        </a>
      @endif

      @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
        <a href="/admin/consultations/application" class="list-group-item waves-effect @if(request()->path() == 'admin/consultations/application') {{'active'}} @endif">
          <i class="fas fa-chart-pie mr-3"></i>Заявки на консультацию
        </a>
      @endif


      @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
        <a href="/admin/questions" class="list-group-item waves-effect @if(request()->path() == 'admin/questions') {{'active'}} @endif">
          <i class="fas fa-chart-pie mr-3"></i>Часто задаваемые вопросы
        </a>
      @endif

      @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
        <a href="/admin/news" class="list-group-item waves-effect @if(request()->path() == 'admin/news') {{'active'}} @endif">
          <i class="fas fa-chart-pie mr-3"></i>Новости
        </a>
      @endif

      @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
        <a href="/admin/contracts" class="list-group-item waves-effect @if(request()->path() == 'admin/contracts') {{'active'}} @endif">
          <i class="fas fa-chart-pie mr-3"></i>Договоры
        </a>
      @endif

      @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
        <a href="/admin/contacts" class="list-group-item waves-effect @if(request()->path() == 'admin/contacts') {{'active'}} @endif">
          <i class="fas fa-chart-pie mr-3"></i>Обратная связь
        </a>
      @endif

      @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
        <a href="/admin/service_control" class="list-group-item waves-effect @if(request()->path() == 'admin/service_control') {{'active'}} @endif">
          <i class="fas fa-chart-pie mr-3"></i>Контроль качества услуг
        </a>
      @endif

      @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
        <a href="/admin/services" class="list-group-item waves-effect @if(request()->path() == 'admin/services') {{'active'}} @endif">
          <i class="fas fa-chart-pie mr-3"></i>Отрасль
        </a>
      @endif
      {{-- @if(Auth::user()->role_id == 1)
        <a href="/admin/payments" class="list-group-item waves-effect @if(request()->path() == 'admin/payments') {{'active'}} @endif">
          <i class="fas fa-chart-pie mr-3"></i>История платежей
        </a>
      @endif --}}

      <br>

      {{-- @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
        <a href="/admin/reports" class="list-group-item list-group-item-action waves-effect @if(request()->path() == 'admin/reports') {{'active'}} @endif">
          <i class="fas fa-chart-pie mr-3"></i>Отчеты
        </a>
      @endif --}}



      @if(Auth::user()->role_id == 1)
        <a href="/admin/lawyers_specializations" class="list-group-item list-group-item-action waves-effect @if(request()->path() == 'admin/specializations') {{'active'}} @endif">
          Специализирующаяся отрасль права
        </a>
      @endif

      {{-- @if(Auth::user()->role_id == 1)
        <a href="/admin/cities" class="list-group-item list-group-item-action waves-effect @if(request()->path() == 'admin/cities') {{'active'}} @endif">
          <i class="fas fa-chart-pie mr-3"></i>Города
        </a>
      @endif --}}
    </div>

  </div>
  <!-- Sidebar -->



  <main class="pt-5 mx-lg-5">
    <div class="container-fluid mt-5">

      <!-- Heading -->
      <div class="card mb-4 wow fadeIn">

        <!--Card content-->
        <div class="card-body d-sm-flex justify-content-between">

          <h4 class="mb-2 mb-sm-0 pt-1">
            <a href="/admin/dashboard">@yield('title')</a>
            <span> - {{request()->path()}}</span>
            <span></span>
          </h4>

          {{-- <form class="d-flex justify-content-center">
            <!-- Default input -->
            <input type="search" placeholder="Type your query" aria-label="Search" class="form-control">
            <button class="btn btn-primary btn-sm my-0 p" type="submit">
              <i class="fas fa-search"></i>
            </button>

          </form> --}}

        </div>

      </div>


      @yield('content')

    </main>


    <!--Footer-->
    <footer class="page-footer text-center font-small primary-color-dark darken-2 mt-4 wow fadeIn">

      <!--Call to action-->

      <!--/.Call to action-->

      <hr class="my-4">

      <!-- Social icons -->
      <div class="pb-4">
        <a href="https://www.facebook.com/mdbootstrap" target="_blank">
          <i class="fab fa-facebook-f mr-3"></i>
        </a>

        <a href="https://twitter.com/MDBootstrap" target="_blank">
          <i class="fab fa-twitter mr-3"></i>
        </a>

        <a href="https://www.youtube.com/watch?v=7MUISDJ5ZZ4" target="_blank">
          <i class="fab fa-youtube mr-3"></i>
        </a>

        <a href="https://plus.google.com/u/0/b/107863090883699620484" target="_blank">
          <i class="fab fa-google-plus mr-3"></i>
        </a>

        <a href="https://dribbble.com/mdbootstrap" target="_blank">
          <i class="fab fa-dribbble mr-3"></i>
        </a>

        <a href="https://pinterest.com/mdbootstrap" target="_blank">
          <i class="fab fa-pinterest mr-3"></i>
        </a>

        <a href="https://github.com/mdbootstrap/bootstrap-material-design" target="_blank">
          <i class="fab fa-github mr-3"></i>
        </a>

        <a href="http://codepen.io/mdbootstrap/" target="_blank">
          <i class="fab fa-codepen mr-3"></i>
        </a>
      </div>
      <!-- Social icons -->

      <!--Copyright-->
      <div class="footer-copyright py-3">
        © 2019 Copyright:
        <a href="https://mdbootstrap.com/education/bootstrap/" target="_blank"> MDBootstrap.com </a>
      </div>
      <!--/.Copyright-->




    </footer>
    <!--/.Footer-->

    <!-- SCRIPTS -->
    <!-- JQuery -->
    <script type="text/javascript" src="/admin/js/jquery-3.4.1.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="/admin/js/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="/admin/js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="/admin/js/mdb.min.js"></script>
    <script type="text/javascript" src="/admin/js/admin.js"></script>
    <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
     <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    {!! Toastr::message() !!}
    <!-- Initializations -->
    <script type="text/javascript">
    // Animations initialization
    new WOW().init();

    </script>

    <!-- Charts -->
    <script>
    // Line
    var ctx = document.getElementById("myChart").getContext('2d');
    var myChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
        datasets: [{
          label: '# of Votes',
          data: [12, 19, 3, 5, 2, 3],
          backgroundColor: [
            'rgba(255, 99, 132, 0.2)',
            'rgba(54, 162, 235, 0.2)',
            'rgba(255, 206, 86, 0.2)',
            'rgba(75, 192, 192, 0.2)',
            'rgba(153, 102, 255, 0.2)',
            'rgba(255, 159, 64, 0.2)'
          ],
          borderColor: [
            'rgba(255,99,132,1)',
            'rgba(54, 162, 235, 1)',
            'rgba(255, 206, 86, 1)',
            'rgba(75, 192, 192, 1)',
            'rgba(153, 102, 255, 1)',
            'rgba(255, 159, 64, 1)'
          ],
          borderWidth: 1
        }]
      },
      options: {
        scales: {
          yAxes: [{
            ticks: {
              beginAtZero: true
            }
          }]
        }
      }
    });

    //pie
    var ctxP = document.getElementById("pieChart").getContext('2d');
    var myPieChart = new Chart(ctxP, {
      type: 'pie',
      data: {
        labels: ["Red", "Green", "Yellow", "Grey", "Dark Grey"],
        datasets: [{
          data: [300, 50, 100, 40, 120],
          backgroundColor: ["#F7464A", "#46BFBD", "#FDB45C", "#949FB1", "#4D5360"],
          hoverBackgroundColor: ["#FF5A5E", "#5AD3D1", "#FFC870", "#A8B3C5", "#616774"]
        }]
      },
      options: {
        responsive: true,
        legend: false
      }
    });


    //line
    var ctxL = document.getElementById("lineChart").getContext('2d');
    var myLineChart = new Chart(ctxL, {
      type: 'line',
      data: {
        labels: ["January", "February", "March", "April", "May", "June", "July"],
        datasets: [{
          label: "My First dataset",
          backgroundColor: [
            'rgba(105, 0, 132, .2)',
          ],
          borderColor: [
            'rgba(200, 99, 132, .7)',
          ],
          borderWidth: 2,
          data: [65, 59, 80, 81, 56, 55, 40]
        },
        {
          label: "My Second dataset",
          backgroundColor: [
            'rgba(0, 137, 132, .2)',
          ],
          borderColor: [
            'rgba(0, 10, 130, .7)',
          ],
          data: [28, 48, 40, 19, 86, 27, 90]
        }
      ]
    },
    options: {
      responsive: true
    }
  });


  //radar
  var ctxR = document.getElementById("radarChart").getContext('2d');
  var myRadarChart = new Chart(ctxR, {
    type: 'radar',
    data: {
      labels: ["Eating", "Drinking", "Sleeping", "Designing", "Coding", "Cycling", "Running"],
      datasets: [{
        label: "My First dataset",
        data: [65, 59, 90, 81, 56, 55, 40],
        backgroundColor: [
          'rgba(105, 0, 132, .2)',
        ],
        borderColor: [
          'rgba(200, 99, 132, .7)',
        ],
        borderWidth: 2
      }, {
        label: "My Second dataset",
        data: [28, 48, 40, 19, 96, 27, 100],
        backgroundColor: [
          'rgba(0, 250, 220, .2)',
        ],
        borderColor: [
          'rgba(0, 213, 132, .7)',
        ],
        borderWidth: 2
      }]
    },
    options: {
      responsive: true
    }
  });

  //doughnut
  var ctxD = document.getElementById("doughnutChart").getContext('2d');
  var myLineChart = new Chart(ctxD, {
    type: 'doughnut',
    data: {
      labels: ["Red", "Green", "Yellow", "Grey", "Dark Grey"],
      datasets: [{
        data: [300, 50, 100, 40, 120],
        backgroundColor: ["#F7464A", "#46BFBD", "#FDB45C", "#949FB1", "#4D5360"],
        hoverBackgroundColor: ["#FF5A5E", "#5AD3D1", "#FFC870", "#A8B3C5", "#616774"]
      }]
    },
    options: {
      responsive: true
    }
  });

</script>

<!--Google Maps-->
<script src="https://maps.google.com/maps/api/js"></script>
<script>



// Regular map
function regular_map() {
  var var_location = new google.maps.LatLng(40.725118, -73.997699);

  var var_mapoptions = {
    center: var_location,
    zoom: 14
  };

  var var_map = new google.maps.Map(document.getElementById("map-container"),
  var_mapoptions);

  var var_marker = new google.maps.Marker({
    position: var_location,
    map: var_map,
    title: "New York"
  });
}

new Chart(document.getElementById("horizontalBar"), {
  "type": "horizontalBar",
  "data": {
    "labels": ["Red", "Orange", "Yellow", "Green", "Blue", "Purple", "Grey"],
    "datasets": [{
      "label": "My First Dataset",
      "data": [22, 33, 55, 12, 86, 23, 14],
      "fill": false,
      "backgroundColor": ["rgba(255, 99, 132, 0.2)", "rgba(255, 159, 64, 0.2)",
      "rgba(255, 205, 86, 0.2)", "rgba(75, 192, 192, 0.2)",
      "rgba(54, 162, 235, 0.2)",
      "rgba(153, 102, 255, 0.2)", "rgba(201, 203, 207, 0.2)"
    ],
    "borderColor": ["rgb(255, 99, 132)", "rgb(255, 159, 64)", "rgb(255, 205, 86)",
    "rgb(75, 192, 192)", "rgb(54, 162, 235)", "rgb(153, 102, 255)",
    "rgb(201, 203, 207)"
  ],
  "borderWidth": 1
}]
},
"options": {
  "scales": {
    "xAxes": [{
      "ticks": {
        "beginAtZero": true
      }
    }]
  }
}
});

</script>
</body>

</html>
