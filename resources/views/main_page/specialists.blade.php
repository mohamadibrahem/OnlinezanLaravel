<div class="container padding-top">
   <div class="row margin-bottom">
      <div class="col-md-12">
         <h1 class="text-center tc-white">НАШИ СПЕЦИАЛИСТЫ</h1>
         <hr style="background-color: #fff; width: 10%;">
         <p class="text-center tc-white">
            Наши юристы предлагают клиентам широкий спектр интегрированных
            глобальных возможностей, в том числе некоторые из наиболее активных в мире процессов слияний
            и поглощений, недвижимости, финансовых услуг, судебных разбирательств и практики
            корпоративного риска.
         </p>
      </div>
   </div>
   <div class="row">
      @foreach ($lawyers as $key => $lawyer)
         <figure class="snip1256">
            <img src="{{asset('/uploads').'/'.$lawyer->user['profile_photo']}}" alt="sample42" />
            <figcaption>
               <h4>{{$lawyer->user['lastname']}} {{$lawyer->user['firstname']}}</h4>
               <p>
                  {{substr($lawyer->biography, 0 , 60) . '...'}}
               </p>
               <a href="/lawyers/{{$lawyer->id}}" class="read-more">Подробнее</a>
            </figcaption>
         </figure>
      @endforeach
   </div>
</div>
