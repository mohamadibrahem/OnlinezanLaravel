@extends('admin.layouts.main')
@section('content')
   @section('title')
      {{"Юрист"}}
   @endsection

   <!-- Editable table -->
   <div class="card">
      <h3 class="card-header text-center font-weight-bold text-uppercase py-4">Добавить юриста</h3>
      <div class="card-body">
         <div id="table" class="table-editable">
            @if(count($errors))
               <br>
               <div class="form-group">
                  <div class="alert alert-danger">
                     <ul>
                        @foreach($errors->all() as $error)
                           <li>{{$error}}</li>
                        @endforeach
                     </ul>
                  </div>
               </div>
               <br>
            @endif
            <form class="text-center border border-light p-5" action="{{route('admin_lawyer_create')}}" method="POST">
               {{csrf_field()}}

               <ul class="nav nav-tabs">
                  <li class="nav-item">
                     <a class="nav-link active" data-toggle="tab" href="#tab1">Общая информация</a>
                  </li>
                  {{-- <li class="nav-item">
                     <a class="nav-link" data-toggle="tab" href="#tab2">Опыт работы</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" data-toggle="tab" href="#tab3">Образование</a>
                  </li> --}}
               </ul>

               <!-- Tab panes -->
               <div class="tab-content">
                  <div class="tab-pane active container" id="tab1">
                     <br>
                     <div class="form-row mb-4">
                        <div class="col">
                           <input type="text" class="form-control" placeholder="Имя" name="firstname" value="{{old('firstname')}}">
                        </div>
                        <div class="col">
                           <input type="text" class="form-control" placeholder="Фамилия" name="lastname" value="{{old('lastname')}}">
                        </div>
                        <div class="col">
                           <input type="text" class="form-control" placeholder="Отчество" name="middlename" value="{{old('middlename')}}">
                        </div>
                     </div>

                     <div class="form-row mb-4">
                        <div class="col">
                           <span class="form-control" style="display:flex;align-items:center">+7<input id="phone" type="text" placeholder="Телефон" name="phone" value="{{old('phone')}}" style="border:0;padding-left:5px;outline:none;width:100%;"></span>
                        </div>
                        <div class="col">
                           <input type="email" class="form-control mb-4" placeholder="E-mail" name="email" value="{{old('email')}}">
                        </div>
                        <div class="col">
                           <input type="password" class="form-control" placeholder="Пароль" aria-describedby="defaultRegisterFormPasswordHelpBlock" name="password" value="{{old('password')}}">
                        </div>
                        <div class="col">
                           <input type="password" class="form-control" placeholder="Подтверждение пароля" aria-describedby="defaultRegisterFormPasswordHelpBlock" name="password_confirmation" value="{{old('password_confirmation')}}">
                        </div>
                     </div>


                     <div class="form-row mb-4">
                        <div class="col">
                           <label>Выберите город</label>
                           <select class="browser-default custom-select mb-4" name="city">
                              @foreach ($cities as $value)
                                 @if($value->id == 1)
                                    <option value="{{$value->id}}">{{$value->name}}</option>
                                 @endif
                              @endforeach
                              @foreach ($cities as $value)
                                 @if($value->id != 1)
                                    <option value="{{$value->id}}">{{$value->name}}</option>
                                 @endif
                              @endforeach
                           </select>
                        </div>


                        <div class="col">
                           <label for="iin">Специализация<span class="required"> *</span></label>
                           <select class="form-control custom-select specialization_select2" name="specialization[]" multiple>
                              @foreach ($specializations as $item)
                                 <option value="{{ $item->id }}"> {{$item->name}} </option>
                              @endforeach
                           </select>
                        </div>


                     </div>



                  </div>
                  {{-- <div class="tab-pane container" id="tab2">...2</div>
                  <div class="tab-pane container" id="tab3">...3</div> --}}
               </div>

               <button class="btn btn-info my-4 btn-block col-md-4" type="submit">Добавить</button>

            </form>
         </div>
      </div>
   </div>

@endsection
