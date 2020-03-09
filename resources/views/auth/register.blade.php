@extends('layouts.app')

@section('content')

   @section('title', 'Регистрация')

   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <div class="panel panel-default">

               <div class="panel-body">
                  <form class="form-horizontal" method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                     {{ csrf_field() }}

                     <div class="form-row">
                        <div class="label" style="font-size: 28px;margin-top: 10px;margin-left: 20px;">Вы:</div>
                        <div class="switch_wrapper">
                           <div class="container">
                              <div class="radio-tile-group">

                                 <div class="input-container">
                                    <input id="client" class="radio-button" type="radio" name="user_type" value="client" @if(old('user_type') == 'client') checked @endif checked/>
                                    <div class="radio-tile">
                                       <label for="walk" class="radio-tile-label">Клиент</label>
                                    </div>
                                 </div>

                                 <div class="input-container">
                                    <input id="lawyer" class="radio-button" type="radio" name="user_type" value="lawyer" @if(old('user_type') == 'lawyer') checked @endif/>
                                    <div class="radio-tile">
                                       <label for="bike" class="radio-tile-label">Юрист</label>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>

                     <hr>

                     <div class="form-row" >
                        <div class="form-group{{ $errors->has('firstname') ? ' has-error' : '' }} col-md-4">
                           <label for="firstname" class="col control-label">Имя</label>
                           <div class="col">
                              <input id="firstname" type="text" class="form-control" name="firstname" value="{{ old('firstname') }}" autofocus>
                              @if ($errors->has('firstname'))
                                 <span class="help-block">
                                    <strong>{{ $errors->first('firstname') }}</strong>
                                 </span>
                              @endif
                           </div>
                        </div>

                        <div class="form-group{{ $errors->has('firstname') ? ' has-error' : '' }} col-md-4">
                           <label for="firstname" class="col control-label">Фамилия</label>
                           <div class="col">
                              <input id="lastname" type="text" class="form-control" name="lastname" value="{{ old('lastname') }}">
                              @if ($errors->has('lastname'))
                                 <span class="help-block">
                                    <strong>{{ $errors->first('lastname') }}</strong>
                                 </span>
                              @endif
                           </div>
                        </div>

                        <div class="form-group{{ $errors->has('middlename') ? ' has-error' : '' }} col-md-4">
                           <label for="middlename" class="col control-label">Отчество</label>
                           <div class="col">
                              <input id="middlename" type="text" class="form-control" name="middlename" value="{{ old('middlename') }}">
                              @if ($errors->has('middlename'))
                                 <span class="help-block">
                                    <strong>{{ $errors->first('middlename') }}</strong>
                                 </span>
                              @endif
                           </div>
                        </div>
                     </div>

                     <div class="form-row">
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} col-md-4">
                           <label for="email" class="col control-label">E-Mail</label>
                           <div class="col">
                              <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">
                              @if ($errors->has('email'))
                                 <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                 </span>
                              @endif
                           </div>
                        </div>

                        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }} col-md-4">
                           <label for="phone" class="col control-label">Телефон</label>
                           <div class="col">
                              <input id="phone" type="text" class="form-control bfh-phone" data-format="+7 (ddd) ddd-dddd" name="phone" value="{{ old('phone') }}">
                              @if ($errors->has('phone'))
                                 <span class="help-block">
                                    <strong>{{ $errors->first('phone') }}</strong>
                                 </span>
                              @endif
                           </div>
                        </div>

                        <div class="form-group{{ $errors->has('profile_photo') ? ' has-error' : '' }} col-md-4">
                           <label for="profile_photo" class="col control-label">Фото профиля</label>
                           <div class="col">
                              <div class="custom-file">
                                 <input type="file" class="custom-file-input" id="profile_photo" name="profile_photo">
                                 <label class="custom-file-label" for="profile_photo" data-browse="Обзор">Загрузить фото</label>
                              </div>
                           </div>
                        </div>
                     </div>

                     <br>

                     <div class="form-row">
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} col-md-4">
                           <label for="password" class="col control-label">Пароль</label>
                           <div class="col">
                              <input id="password" type="password" class="form-control" name="password" value="{{ old('password') }}">
                              @if ($errors->has('password'))
                                 <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                 </span>
                              @endif
                           </div>
                        </div>

                        <div class="form-group col-md-4">
                           <label for="password-confirm" class="col control-label">Подтверждение пароля</label>
                           <div class="col">
                              <input id="password-confirm" type="password" class="form-control" name="password_confirmation" value="{{ old('password_confirmation') }}">
                           </div>
                        </div>

                        <div class="form-group{{ $errors->has('lawyer_docs') ? ' has-error' : '3' }} col-md-4 hidden" id="lawyer_docs_group">
                           <label for="lawyer_docs" class="col control-label">Подтверждающие документы</label>
                           <div class="col">
                              <div class="custom-file">
                                 <input type="file" class="custom-file-input" id="lawyer_docs" name="lawyer_docs[]" multiple>
                                 <label class="custom-file-label" for="lawyer_docs" data-browse="Обзор">Загрузить</label>
                              </div>
                              @if ($errors->has('lawyer_docs'))
                                 <span class="help-block">
                                    <strong>{{ $errors->first('lawyer_docs') }}</strong>
                                 </span>
                              @endif
                           </div>
                        </div>
                     </div>

                     <div class="form-group">
                        <div class="col-md-12">
                           <div class="row">
                              <div class="col-md-3">
                                 <a class="link" data-toggle="modal" data-target="#agreementModal" style="color:#005aad;cursor:pointer"> Пользовательское соглашение</a>
                              </div>
                              <div class="col-md-3">
                                 <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="defaultUnchecked" required>
                                    <label class="custom-control-label" for="defaultUnchecked">Я принимаю условия</label>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <hr>
                        <div class="col-md-6 col-md-offset-4">
                           <button type="submit" class="btn btn-primary">
                              Регистрация
                           </button>
                        </div>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>

   @include('auth.modal')
@endsection
