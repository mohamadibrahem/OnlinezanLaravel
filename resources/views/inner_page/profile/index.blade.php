@extends('layouts.app')

@section('content')
   @section('title', 'Профиль')

   <div class="content-profile">

      <div class="container emp-profile">

         <div class="errors">
            @if ($errors->any())
               <div class="alert alert-danger">
                  <ul>
                     @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                     @endforeach
                  </ul>
               </div>
            @endif
         </div>

         {{-- @if(session()->has('message_success'))
         <div class="alert alert-success">
         {{ session()->get('message_success') }}
      </div>
   @endif --}}
   @if(Auth::user()->role_id == 3)
      @if($data['lawyer']['video'] != null)
         <form method="post" action="{{route('delete_video')}}" class="hidden" id="delete_video">
            {{csrf_field()}}
            <button type="submit">Удалить</button>
         </form>
      @endif
   @endif
   <form method="post" action="{{route('profile_update')}}" enctype="multipart/form-data">
      {{csrf_field()}}
      <div class="row">
         <div class="col-md-4">
            <div class="profile-img text-center">
               <img src="{{asset('/uploads').'/'.Auth::user()->profile_photo}}" alt="" height="200px;"/>
               <div class="input-group">
                  <div class="custom-file">
                     <input type="file" class="custom-file-input" id="photo" name="photo">
                     <label class="custom-file-label" for="photo" data-browse="Загрузить" style="text-align:left">Фото профиля</label>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-md-6">
            <div class="profile-head">
               <h5>
                  {{Auth::user()->firstname}} {{Auth::user()->lastname}}
               </h5>
               <h6>
                  {{-- <b>Специализация:</b> {{$data['specialization_name']}} --}}
               </h6>
               {{-- <p class="proile-rating">RANKINGS : <span>8/10</span></p> --}}
               <ul class="nav nav-tabs" id="myTab" role="tablist">
                  <li class="nav-item">
                     <a class="nav-link active" id="link_tab_1" data-toggle="tab" href="#tab_1" role="tab" aria-controls="tab_1" aria-selected="true">Общая информация</a>
                  </li>
                  @if(Auth::user()->role_id == 3)
                     <li class="nav-item">
                        <a class="nav-link" id="link_tab_2" data-toggle="tab" href="#tab_2" role="tab" aria-controls="tab_2" aria-selected="false">Опыт работы</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" id="link_tab_4" data-toggle="tab" href="#tab_4" role="tab" aria-controls="tab_4" aria-selected="false">Образование</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" id="link_tab_3" data-toggle="tab" href="#tab_3" role="tab" aria-controls="tab_3" aria-selected="false">Услуги</a>
                     </li>

                     <li class="nav-item">
                        <a class="nav-link" id="link_tab_5" data-toggle="tab" href="#tab_5" role="tab" aria-controls="tab_5" aria-selected="false">Мои файлы</a>
                     </li>

                  @endif
               </ul>
            </div>
         </div>
         <div class="col-md-2 mt-4">
            <button type="submit" class="btn btn-primary profile-edit-btn">Сохранить</button>
         </div>
      </div>

      <br>

      <div class="row">

         <div class="col-md-12">
            <div class="tab-content">

               <br>

               <div class="tab-pane fade show active" id="tab_1" role="tabpanel" aria-labelledby="tab_1">
                  <div class="row">
                     <div class="col-md-2">
                        <label><b>Ф.И.О.</b></label>
                     </div>
                     <div class="col-md-10">

                        <div class="row">
                           <div class="form-group col-md-4">
                              <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Фамилия" value="{{Auth::user()->lastname}}">
                           </div>
                           <div class="form-group col-md-4">
                              <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Ержан" value="{{Auth::user()->firstname}}">
                           </div>
                           <div class="form-group col-md-4">
                              <input type="text" class="form-control" id="middlename" name="middlename" placeholder="Отчество" value="{{Auth::user()->middlename}}">
                           </div>
                        </div>

                     </div>
                  </div>

                  <div class="row">
                     <div class="col-md-2">
                        <label><b>Email</b></label>
                     </div>

                     <div class="col-md-10">
                        <div class="row">
                           <div class="form-group col-md-4">
                              <input type="email" class="form-control" id="email" name="email" placeholder="email" value="{{Auth::user()->email}}">
                           </div>
                        </div>
                     </div>
                  </div>

                  <div class="row">
                     <div class="col-md-2">
                        <label><b>Телефон</b></label>
                     </div>
                     <div class="col-md-10">
                        <div class="row">
                           <div class="form-group col-md-4">
                              <input type="text" class="form-control" id="phone" name="phone" placeholder="Телефон" value="{{Auth::user()->phone}}">
                           </div>
                        </div>
                     </div>
                  </div>

                  @if(Auth::user()->role_id == 4)
                     <hr>
                     <div class="form-group row">
                        <label class="col-lg-3 col-form-label form-control-label">Срок хранение файлов</label>
                        <div class="col-lg-9">
                           <div class="custom-control custom-radio">
                              <input type="radio" class="custom-control-input" name="date_storage" id="date1" value="1" @if(Auth::user()->client['date_storage'] == '1') checked @endif>
                                 <label class="custom-control-label" for="date1">1 день</label>
                              </div>
                              <div class="custom-control custom-radio">
                                 <input type="radio" class="custom-control-input" name="date_storage" id="date2" value="30" @if(Auth::user()->client['date_storage'] == '30') checked @endif>
                                    <label class="custom-control-label" for="date2">1 месяц</label>
                                 </div>
                                 <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" name="date_storage" id="date3" value="365" @if(Auth::user()->client['date_storage'] == '365') checked @endif>
                                       <label class="custom-control-label" for="date3">1 год</label>
                                    </div>
                                 </div>
                              </div>
                              <hr>
                           @endif

                           @if(Auth::user()->role_id == 3)
                              <div class="row">
                                 <div class="col-md-2">
                                    <label><b>Город</b></label>
                                 </div>
                                 <div class="col-md-10">
                                    <div class="row">
                                       <select name="city" class="browser-default selectpicker col-md-4">
                                          @foreach ($data['cities'] as $key => $value)
                                             <option value="{{$value->id}}" @if($value->id == $data['lawyer']['city_id'])
                                                {{'selected'}}
                                             @endif >{{$value->name}}</option>
                                          @endforeach
                                       </select>
                                    </div>
                                 </div>
                              </div>
                           @endif
                           <br>
                           @if(Auth::user()->role_id == 3)
                              <div class="row">
                                 <div class="col-md-2">
                                    <label><b>Отрасль</b></label>
                                 </div>
                                 <div class="col-md-10">
                                    <div class="row">
                                       <select name="specialization[]" class="browser-default selectpicker col-md-4" title="Не выбрано" multiple>
                                          @foreach ($data['specializations'] as $key => $value)
                                             <option value="{{$value->id}}"
                                                @if(json_decode($data['lawyer']->specialization_id) != null)
                                                   @foreach (json_decode($data['lawyer']['specialization_id']) as $specialization)
                                                      @if($value->id == $specialization)
                                                         {{'selected'}}
                                                      @endif
                                                   @endforeach
                                                @endif
                                                >{{$value->name}}</option>
                                             @endforeach
                                          </select>
                                       </div>
                                    </div>
                                 </div>
                              @endif

                              <br>

                              @if(Auth::user()->role_id == 3)
                                 <div class="row">
                                    <div class="col-md-2">
                                       <label><b>Специализирующаяся отрасль права</b></label>
                                    </div>
                                    <div class="col-md-10">
                                       <div class="row">
                                          <select name="specialization2[]" class="browser-default selectpicker col-md-4" title="Не выбрано" multiple>
                                             @foreach ($data['categories'] as $key => $value)
                                                <option value="{{$value->id}}"
                                                   @if(json_decode($data['lawyer']->category_id) != null)
                                                      @foreach (json_decode($data['lawyer']['category_id']) as $category)
                                                         @if($value->id == $category)
                                                            {{'selected'}}
                                                         @endif
                                                      @endforeach
                                                   @endif
                                                   >{{$value->name}}</option>
                                                @endforeach
                                             </select>
                                          </div>
                                       </div>
                                    </div>
                                 @endif
                                 @if(Auth::user()->role_id == 3)
                                    <hr>
                                    <div class="row">
                                       <div class="col-md-2"></div>
                                       <div class="col-md-4">
                                          <div class="input-group">
                                             <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="video" name="video">
                                                <label class="custom-file-label" for="video" data-browse="Загрузить" style="text-align:left">Видеоанкета</label>
                                             </div>
                                          </div>
                                          <br>
                                          @if($data['lawyer']['video'] != null)
                                             <video src="{{URL::asset('/uploads') .'/profile_video'.'/'. $data['lawyer']['video']}}" controls="controls" playsinline="" style="width:100%"></video>
                                             <button class="btn btn-danger" form="delete_video" value="Submit">Удалить</button>
                                          @endif
                                       </div>
                                    </div>
                                    <br>

                                 @endif



                                 {{-- <br>
                                 @if(Auth::user()->role_id == 3)
                                 <div class="row">
                                 <div class="col-md-2">
                                 <label><b>Биография</b></label>
                              </div>
                              <div class="col-md-10">
                              <div class="row">
                              <textarea name="biography" class="form-control col-md-8" style="margin-left:15px">{{$data['lawyer']['biography']}}</textarea>
                           </div>
                        </div>
                     </div>
                  @endif --}}

               </div>



               @if(Auth::user()->role_id == 3)
                  <div class="tab-pane fade" id="tab_2" role="tabpanel" aria-labelledby="tab_2">
                     @foreach ($data['experiences'] as $key => $value)
                        <div class="row">
                           <div class="col-md-12">

                              <div class="row">
                                 <span class="pt-1">{{$key+1}})</span>
                                 <div class="col-md-6">
                                    <label><b>Наименование компании:</b></label>
                                    <span>{{$value['name']}}</span>
                                 </div>
                              </div>


                              <div class="row">
                                 <span class="pt-1">{{$key+1}})</span>
                                 <div class="col-md-6">
                                    <label><b>Должность:</b></label>
                                    <span>{{$value['position']}}</span>
                                 </div>
                              </div>


                              <div class="row">
                                 <span class="pt-1">&nbsp;&nbsp;&nbsp;</span>
                                 <div class="col-md-6">
                                    <label><b>Описание деятельности:</b></label>
                                    <span>{{$value['description']}}</span>
                                 </div>

                                 <a class="btn btn-danger btn-rounded btn-sm my-0" href="/experience/delete/{{$value->id}}"><i class="fas fa-times"></i></a>
                                 <a class="btn btn-success btn-rounded btn-sm my-0" href="/experience/edit/{{$value->id}}">Редактировать</a>

                              </div>
                           </div>
                        </div>
                        <hr>
                     @endforeach

                     <button type="button" class="btn btn-right btn-success" data-toggle="modal" data-target="#experienceModal">
                        <span>+</span> Добавить
                     </button>
                  </div>
               @endif

               @if(Auth::user()->role_id == 3)
                  <div class="tab-pane fade" id="tab_4" role="tabpanel" aria-labelledby="tab_4">
                     @foreach ($data['education'] as $key => $value)
                        <div class="row">
                           <div class="col-md-12">
                              <div class="row">
                                 <span class="pt-1">{{$key+1}})</span>
                                 &nbsp;
                                 &nbsp;
                                 <div class="row">
                                    <div class=" col-md-12">
                                       <label><b>Наименование ВУЗа:</b></label>
                                       <span>{{$value['name']}}</span>
                                    </div>

                                    <div class=" col-md-12">
                                       <label><b>Степень:</b></label>
                                       <span>{{$value['degree']}}</span>
                                    </div>

                                    <div class=" col-md-12">
                                       <label><b>Специальность:</b></label>
                                       <span>{{$value['special']}}</span>
                                    </div>
                                 </div>


                                 <a class="btn btn-danger btn-rounded btn-sm my-0" href="/education/delete/{{$value->id}}"><i class="fas fa-times"></i></a>
                                 <a class="btn btn-success btn-rounded btn-sm my-0" href="/education/edit/{{$value->id}}">Редактировать</a>

                              </div>
                           </div>
                        </div>
                        <hr>
                     @endforeach

                     <button type="button" class="btn btn-right btn-success" data-toggle="modal" data-target="#educationModal">
                        <span>+</span> Добавить
                     </button>
                  </div>
               @endif

               @if(Auth::user()->role_id == 3)
                  <div class="tab-pane fade" id="tab_3" role="tabpanel" aria-labelledby="tab_3">
                     <div class="row">
                        <div class="col-md-6">
                           <div class="row">
                              @php
                              $check1 = 0;
                              $check2 = 0;
                              $check3 = 0;
                              $check4 = 0;
                              if(json_decode($data['lawyer']['service_types']) != null){
                                 foreach (json_decode($data['lawyer']['service_types']) as $key => $value) {
                                    if($value == "1"){
                                       $check1 = 1;
                                    }
                                    if($value == "2"){
                                       $check2 = 2;
                                    }
                                    if($value == "3"){
                                       $check3 = 3;
                                    }
                                    if($value == "4"){
                                       $check4 = 4;
                                    }
                                 }
                              }
                              @endphp
                              <div class="col">
                                 <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="onlineConsultationCheck" @if($check1 == 1) {{"checked"}} @endif value="1" name="service_type[]">
                                       <label class="custom-control-label" for="onlineConsultationCheck">Онлайн консультацию @if($check1 == 1) {{"(Активна)"}} @endif</label>
                                       </div>
                                       <div class="row mt-2">
                                          <span class="col-md-4 pt-1">Стоимость: </span>
                                          <input class="form-control col-md-2" name="online_price" value="{{$data['lawyer']['online_consultation_price']}}" >

                                          <span class="col pt-1">тг</span>
                                       </div>
                                    </div>
                                 </div>

                                 <hr>

                                 <div class="row">
                                    <div class="col">
                                       <div class="custom-control custom-checkbox">
                                          <input type="checkbox" class="custom-control-input" id="urgentConsultationCheck" @if($check2 == 2) {{"checked"}} @endif value="2" name="service_type[]">
                                             <label class="custom-control-label" for="urgentConsultationCheck">Срочная консультацию @if($check2 == 2) {{"(Активна)"}} @endif </label>
                                             </div>
                                             <div class="row mt-2">
                                                <span class="col-md-4 pt-1">Стоимость: </span>
                                                <input class="form-control col-md-2" name="urgent_price" value="{{$data['lawyer']['urgent_consultation_price']}}">
                                                <span class="col pt-1">тг</span>
                                             </div>
                                          </div>
                                       </div>
                                    </div>



                                    <hr>
                                    <div class="col-md-6">
                                       <div class="row">
                                          <div class="col">
                                             <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="outsourceCheck" @if($check3 == 3) {{"checked"}} @endif value="3" name="service_type[]">
                                                   <label class="custom-control-label" for="outsourceCheck">Аутсорсинг @if($check3 == 3) {{"(Активна)"}} @endif</label>
                                                   </div>
                                                </div>
                                             </div>

                                             <hr>

                                             <div class="row">
                                                <div class="col">
                                                   <div class="custom-control custom-checkbox">
                                                      <input type="checkbox" class="custom-control-input" id="courtCheck" @if($check4 == 4) {{"checked"}} @endif value="4" name="service_type[]">
                                                         <label class="custom-control-label" for="courtCheck">Представительство в суде @if($check4 == 4) {{"(Активна)"}} @endif</label>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       @endif


                                       @if(Auth::user()->role_id == 3)
                                          <div class="tab-pane fade" id="tab_5" role="tabpanel" aria-labelledby="tab_5">
                                             <div class="row">
                                                <div class="col">
                                                   <ul>
                                                      @foreach ($data['files'] as $key => $value)
                                                         <li><a href="{{asset('uploads').'/lawyer_docs'.'/'.$value->filename}}" target="blank">{{$value->original_name}}</a></li>
                                                      @endforeach
                                                   </ul>
                                                </div>
                                             </div>
                                          </div>
                                       @endif

                                    </div>
                                 </div>
                              </div>

                           </form>
                        </div>


                     </div>

                     @include('inner_page.profile.modal')
                  @endsection
