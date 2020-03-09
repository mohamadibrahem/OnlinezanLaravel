<div class="client_name"><b>Клиент:</b> <span class="value">{{$consultations->client['user']['lastname']}} {{$consultations->client['user']['firstname']}}</span> </div>
<br>
<form action="/urgent_consultations/conclusion_post/{{$consultations->id}}" method="post">
   {{csrf_field()}}
   <input type="hidden" name="consultation" id="application_id">
   <div class="row">
      <div class="col">
         <b>Заключение:</b>
         <textarea name="conclusion" class="form-control" id="conclusion" @if($consultations->status == 'success') readonly @endif>{{$consultations->conclusion}}</textarea>
         </div>
      </div>
      <br>
      {{-- <textarea name="npa" class="form-control" id="npa"></textarea> --}}



      <div class="row add-more-inputs">
         <div class="col ">
            <b>ссылки на используемые НПА</b>
            <div id="field">

               @php
               if(json_decode($consultations->npa) != null){
                  $total = count(json_decode($consultations->npa))-1;
               }
               @endphp
               @if(json_decode($consultations->npa) == null)
                  <div id="field0" name="field0">
                     <div class="form-group">
                        <input id="npa" name="npa[]" type="text" placeholder="Ссылка" class="form-control input-md" @if($consultations->status == 'success') readonly @endif>
                           <br>
                        </div>
                     </div>
                  @else
                     @foreach (json_decode($consultations->npa) as $key => $value)
                        @if($value != '')
                           @if($consultations->status != 'success')
                              <div id="field{{$key}}" name="field{{$key}}">
                                 <div class="form-group">
                                    <input id="npa" name="npa[]" type="text" placeholder="Ссылка" class="form-control input-md" value="{{$value}}" @if($consultations->status == 'success') readonly @endif>
                                       <br>
                                    </div>
                                 </div>
                                 <button id="remove{{$key}}" class="btn btn-danger remove-me" type="button">Удалить</button>
                                 <br>
                                 <br>
                              @else
                                 <input id="npa" name="npa[]" type="text" placeholder="Ссылка" class="form-control input-md" value="{{$value}}" @if($consultations->status == 'success') readonly @endif>
                                    <br>
                                 @endif
                              @endif
                           @endforeach
                        @endif

                     </div>
                     @if($consultations->status != 'success')
                        <div class="form-group text-right">
                           <button type="button" id="add-more" name="add-more" class="btn btn-primary">Добавить еще</button>
                        </div>
                     @endif



                  </div>
               </div>




               <br>
               @if($consultations->status != 'success')
                  <button type="button" class="btn btn-primary save">Сохранить</button>
               @endif
            </form>
