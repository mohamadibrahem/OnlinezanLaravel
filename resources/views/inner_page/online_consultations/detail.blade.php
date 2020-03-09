
<div id="consultation_detail">

   @if($data['consultation']['status'] == 'accepted')
      <div class="block files">
         <span class="title">Документы</span>
         <br>
         <br>
         <div class="content">
            @foreach($data['files'] as $file)
               <div class="file item" style="margin-bottom:20px">
                  <a href="{{URL::asset('/').'uploads/consultation_files/'.$file->filename}}" id="{{$file->id}}" target="_blank">{{$file->filename}}</a>
                  <div class="buttons-w">
                     <a class="btn btn-primary btn-sm" href="{{URL::asset('/').'uploads/consultation_files/'.$file->filename}}" id="{{$file->id}}" target="_blank">Открыть</a>
                     @if(Auth::user()->role_id == 4)
                        <form action="{{route('consultation_file.destroy', $file->id)}}" method="post">
                           {{csrf_field()}}
                           {{method_field('DELETE')}}
                           <button class="btn btn-danger btn-sm" type="submit" style="margin:0;padding: 6px;margin-left: 10px;">Удалить</button>
                        </form>
                     @endif
                  </div>
               </div>
            @endforeach
            @if(Auth::user()->role_id == 4)
               <form method="post" action="{{ route('consultation_file') }}" enctype="multipart/form-data" class="file_form">
                  {{csrf_field()}}
                  <input type="hidden" value="{{$data['consultation']['id']}}" name="consultation_id">
                  <div class="files">
                     <div class="form-group custom-file-upload">
                        <div class="input-group">
                           <div class="input-group-prepend">
                              <span class="input-group-text" id="inputGroupFileAddon01">Загрузить</span>
                           </div>
                           <div class="custom-file">
                              <input type="file" class="custom-file-input" multiple name="consultation_file[]" id="consultation_file"
                              aria-describedby="inputGroupFileAddon01">
                              <label class="custom-file-label" for="consultation_file">Выберите файл</label>
                           </div>
                        </div>
                     </div>
                  </div>
                  <button type="submit">Загрузить</button>
               </form>
            @endif
         </div>
      </div>
   @endif

</div>
