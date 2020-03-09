<!DOCTYPE html>
<html lang="ru">
<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">

   <!-- CSRF Token -->
   <meta name="csrf-token" content="{{ csrf_token() }}">

   <title>{{ config('app.name', 'Zanger') }}</title>

   <!-- Styles -->

   <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" />
   <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
   <link href="{{ asset('css/bootstrap-formhelpers.min.css') }}" rel="stylesheet">
   <link rel="stylesheet" href="{{URL::asset('css/bootstrap_select.min.css')}}">
   <link href="{{ asset('css/style.css') }}" rel="stylesheet">
   <link href="{{ asset('css/fontawesome.min.css') }}" rel="stylesheet">
   <link href="{{ asset('css/app.css') }}" rel="stylesheet">
   


</head>
<body>
   @include('layouts.header')

   @if(Request::is('/'))
      <div id="scroll">
         @yield('main_page')
         @include('layouts.footer_front')
      </div>
   @else
      @include('inner_page.index')
      @include('layouts.footer_not_front')
      <a class="my-btn" data-toggle="modal" data-target="#applicationConsultationModal" id="zayavka">Заявка на консультацию</a>
   @endif


   @include('layouts.modal_forms')


   <!-- Scripts -->

   <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
   <script type="text/javascript" src="{{ URL::asset('js/moment.min.js')}}"></script>

   <link href="{{ URL::asset('js/datetimepicker/jquery.datetimepicker.css')}}" rel="stylesheet" />
   <link href="{{ asset('css/calendar.css') }}" rel="stylesheet">
   <script type="text/javascript" src="{{ URL::asset('js/datetimepicker/jquery.datetimepicker.full.js')}}"></script>

   <script defer type="text/javascript" src="{{ URL::asset('js/jquery.countdown-timer.js')}}"></script>

   <script src="{{ asset('js/popper.min.js') }}"></script>
   <script src="{{ asset('js/bootstrap.min.js') }}"></script>
   <script src="{{ asset('js/bootstrap-formhelpers.min.js') }}"></script>
   <script type="text/javascript" src="{{ URL::asset('js/bootstrap-select.min.js')}}"></script>

   @if(Request::is('/'))
      <script src="{{ asset('js/js.js') }}"></script>
   @else
      <script src="{{ asset('js/other.js') }}"></script>
   @endif

   <script src="{{ asset('js/card.js') }}"></script>

   <script src="{{ asset('js/schedule_calendar.js') }}"></script>
   <script src="{{ asset('js/app.js') }}"></script>
   <script type="text/javascript" src="{{URL::asset('js/videocall.js')}}"></script>

   <script type="text/javascript" src="{{URL::asset('js/dynamic.js')}}"></script>

   <script src="{{request()->getSchemeAndHttpHost()}}:6001/socket.io/socket.io.js"></script>

   {{-- <script src="https://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
   <link rel="stylesheet" href="https://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">

   {!! Toastr::message() !!} --}}
   {{-- <script src="https://js.pusher.com/4.1/pusher.min.js"></script> --}}
{{--
   <script>

   var pusher = new Pusher('bae3b9d567d4c5ac0f3c', {
      cluster: 'eu',
      encrypted: true
   });

   var channel = pusher.subscribe('notify-channel');
   channel.bind('App\\Events\\NotificationViewed', function(data) {
      toastr.success(data.message, ' ',{
         timeOut: 50000,
      })
   });



</script> --}}

<script>
  $(document).ready(function() {
   $('#start').on('click', function() {
   $('#hide_form').hide(); 
   });


   $('#start').on('click', function() {
   $('#show_form').show(); 
   });











  });


</script>



</body>
</html>
