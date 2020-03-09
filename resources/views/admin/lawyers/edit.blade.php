@extends('admin.layouts.main')
@section('content')
   @section('title')
      {{"Юрист"}}
   @endsection

   <form class="text-center border border-light p-5" action="{{route('lawyer_update', $data['lawyer']['id'])}}" method="post" enctype="multipart/form-data">
      {{csrf_field()}}
      <div class="row">
         <div class="col-md-4">
            <div class="profile-img text-center">
               <img src="{{asset('/uploads').'/'.$data['lawyer']['user']['profile_photo']}}" alt="" height="200px;"/>
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
                  {{$data['lawyer']['user']['firstname']}} {{$data['lawyer']['user']['lastname']}}
               </h5>
               <h6>
                  {{-- <b>Специализация:</b> {{$data['specialization_name']}} --}}
               </h6>
               {{-- <p class="proile-rating">RANKINGS : <span>8/10</span></p> --}}
               <ul class="nav nav-tabs" id="myTab" role="tablist">
                  <li class="nav-item">
                     <a class="nav-link active" id="link_tab_1" data-toggle="tab" href="#tab_1" role="tab" aria-controls="tab_1" aria-selected="true">Общая информация</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" id="link_tab_2" data-toggle="tab" href="#tab_2" role="tab" aria-controls="tab_2" aria-selected="false">Опыт работы</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" id="link_tab_4" data-toggle="tab" href="#tab_4" role="tab" aria-controls="tab_4" aria-selected="false">Образование</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" id="link_tab_3" data-toggle="tab" href="#tab_3" role="tab" aria-controls="tab_3" aria-selected="false">Услуги</a>
                  </li>
               </ul>
            </div>
         </div>
         <div class="col-md-2">
            <button type="submit" class="btn btn-primary profile-edit-btn">Сохранить</button>
         </div>
      </div>

      <br>

      <div class="row">

         <div class="col-md-12">
            <div class="tab-content tab_1">

               <br>

               <div class="tab-pane fade show active" id="tab_1" role="tabpanel" aria-labelledby="tab_1">
                  <div class="row">
                     <div class="col-md-2">
                        <label><b>Ф.И.О.</b></label>
                     </div>
                     <div class="col-md-10">

                        <div class="row">
                           <div class="form-group col-md-4">
                              <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Фамилия" value="{{$data['lawyer']['user']['lastname']}}">
                           </div>
                           <div class="form-group col-md-4">
                              <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Ержан" value="{{$data['lawyer']['user']['firstname']}}">
                           </div>
                           <div class="form-group col-md-4">
                              <input type="text" class="form-control" id="middlename" name="middlename" placeholder="Отчество" value="{{$data['lawyer']['user']['middlename']}}">
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
                              <input type="email" class="form-control" id="email" name="email" placeholder="email" value="{{$data['lawyer']['user']['email']}}">
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
                              <input type="text" class="form-control" id="phone" name="phone" placeholder="Телефон" value="{{$data['lawyer']['user']['phone']}}">
                           </div>
                        </div>
                     </div>
                  </div>

                  <div class="row">
                     <div class="col-md-2">
                        <label><b>Город</b></label>
                     </div>
                     <div class="col-md-10">
                        <div class="row">
                           <select name="city" class="browser-default selectpicker col-md-4 form-control">
                              @foreach ($data['cities'] as $key => $value)
                                 <option value="{{$value->id}}" @if($value->id == $data['lawyer']['city_id'])
                                    {{'selected'}}
                                 @endif >{{$value->name}}</option>
                              @endforeach
                           </select>
                        </div>
                     </div>
                  </div>
                  <br>
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
                     <br>
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
                                             @foreach (json_decode($data['lawyer']['category_id']) as $specialization)
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

                     <br>
                     {{-- <div class="row">
                        <div class="col-md-2">
                           <label><b>Биография</b></label>
                        </div>
                        <div class="col-md-10">
                           <div class="row">
                              <textarea name="biography" class="form-control">{{$data['lawyer']['biography']}}</textarea>
                           </div>
                        </div>
                     </div> --}}

                  </div>




                  <div class="tab-pane fade" id="tab_2" role="tabpanel" aria-labelledby="tab_2">
                     @if(session()->has('messages'))
                        <div class="alert alert-success">
                           {{ session()->get('messages') }}
                        </div>
                     @endif
                     @foreach ($data['experiences'] as $key => $value)
                        <div class="row">
                           <div class="col-md-10">

                              <div class="row">
                                 <span class="pt-1">{{$key+1}})</span>

                                 <div class="form-group col-md-6">
                                    <input class="form-control" id="description" placeholder="Название" value="{{$value['name']}}">
                                 </div>
                              </div>

                              <div class="row">
                                 <span class="pt-1">&nbsp;&nbsp;&nbsp;</span>
                                 <div class="form-group col-md-6">
                                    <textarea class="form-control" id="position" placeholder="Должность">{{$value['position']}}</textarea>
                                 </div>
                              </div>

                              <div class="row">
                                 <span class="pt-1">&nbsp;&nbsp;&nbsp;</span>
                                 <div class="form-group col-md-6">
                                    <textarea class="form-control" id="description" placeholder="Описание">{{$value['description']}}</textarea>
                                 </div>
                              </div>

                           </div>
                           <div class="col-md-2">
                              <a class="btn btn-danger btn-rounded btn-sm my-0" href="/experience/delete/{{$value->id}}"><Remove>Удалить</Remove></a>
                           </div>
                        </div>
                        <hr>
                     @endforeach


                     <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#experienceModal">
                        Добавить
                     </button>
                  </div>

                  <div class="tab-pane fade" id="tab_4" role="tabpanel" aria-labelledby="tab_4">
                     @foreach ($data['education'] as $key => $value)
                        <div class="row">
                           <div class="col-md-10">
                              <div class="row">
                                 <span class="pt-1">{{$key+1}})</span>
                                 <div class="form-group col-md-12">
                                    <input class="form-control" id="description" placeholder="Наименование ВУЗа" value="{{$value['name']}}">
                                 </div>
                                 <div class="form-group col-md-12">
                                    <input class="form-control" id="degree" placeholder="Степень" value="{{$value['degree']}}">
                                 </div>
                                 <div class="form-group col-md-12">
                                    <input class="form-control" id="special" placeholder="Специальность" value="{{$value['special']}}">
                                 </div>
                              </div>

                           </div>
                           <div class="col-md-2">
                              <a class="btn btn-danger btn-rounded btn-sm my-0" href="/admin/education/delete/{{$value->id}}"><Remove>Удалить</Remove></a>
                           </div>
                        </div>
                        <hr>
                     @endforeach

                     <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#educationModal">
                        Добавить
                     </button>
                  </div>

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

                                       </div>
                                    </div>
                                 </div>
                                 <br>

                              </form>

                              @include('admin.lawyers.modal')
                           @endsection
