@if(Request::is('/'))
   @include('layouts.header_front')
@else
   @include('layouts.header_not_front')
@endif
