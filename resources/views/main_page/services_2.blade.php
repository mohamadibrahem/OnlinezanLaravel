
<div class="row margin-bottom">
   <div class="col-md-12">
      <h1 class="text-center">ДЛЯ ЮРИДИЧЕСКИХ ЛИЦ</h1>
      <hr style="background-color: blue; width: 10%;">
   </div>
</div>
<div class="row">
   @foreach ($services as $key => $service)
      @if($service->type == 'legal' || $service->type == 'individual/legal')
         <div class="col-md-4 col-12 margin-bottom">
            <div class="card">
               <p><img src={{asset("/img")."/services/service-".$service->id.".png"}} alt=""></p>
               <a href="/services/{{$service->id}}">
                  <h4>{{$service->name}}</h4>
               </a>
            </div>
         </div>
      @endif
   @endforeach
</div>

{{-- <div class="row margin-top">
   @foreach ($services as $key => $service)
      @if($service->id == 9 || $service->id == 24 || $service->id == 7)
         <div class="col-md-4 col-12">
            <div class="card">
               <p><img src={{asset("/img")."/services/service-".$service->id.".png"}} alt=""></p>
               <a href="/services/{{$service->id}}">
                  <h4>{{$service->name}}</h4>
               </a>
            </div>
         </div>
      @endif
   @endforeach
</div> --}}
