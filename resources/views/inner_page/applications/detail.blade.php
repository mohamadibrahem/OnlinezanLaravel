
<div id="consultation_detail">

      @if($consultation->file != null)
         <div class="block files">
            <span class="title">Прикрипленные файлы</span>
            <br>
            <br>
            <div class="content">
               <ul>
                  @foreach (json_decode($consultation->file) as $key => $file)
                     <li><a href="{{asset('/uploads/application_files').'/'. $file}}" target="_blank">{{$file}}</a></li>
                  @endforeach
               </ul>
            </div>
         </div>
      @endif

      <div class="block user_type">
         {{$consultation->user_type}}
      </div>
      <hr>
      <div class="block user_type">
         <span class="title">Отрасль:</span>
         {{$consultation->service}}
      </div>
      <hr>
      <div class="block comment">
         <span class="title">Описание проблемы:</span>
         <div>
            @if($consultation->comment != null)
               {{$consultation->comment}}
            @else
               <i>Не заполнено</i>
            @endif
         </div>
      </div>

</div>
