@extends('admin.layouts.main')
@section('content')
   @section('title') {{"Заявки на консультацию"}} @endsection

      <!-- Editable table -->
      <div class="card">
         <h3 class="card-header text-center font-weight-bold text-uppercase py-4">Назначить юриста</h3>
         <div class="card-body">
            <form action="{{route('application_lawyer_store', $consultation->id)}}" method="post">
               {{csrf_field()}}

               <button type="submit" class="btn btn-primary">Сохранить</button>
               <br>
               <br>
               <table class="table table-bordered table-responsive-md table-striped text-center">
                  <thead>
                     <tr>
                        <th class="text-center">Выбрать</th>
                        <th class="text-center">ФИО</th>
                        <th class="text-center">Телефон</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">Отрасль</th>
                        <th class="text-center">Специализирующаяся отрасль права</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach($lawyers as $item)
                        <tr>
                           <td class="pt-3-half">
                              <div class="custom-control custom-radio">
                                 <input type="radio" class="custom-control-input" id="lawyer{{$item->id}}" name="lawyer" value="{{$item->id}}" @if($consultation->lawyer_id == $item->id) checked @endif>
                                 <label class="custom-control-label" for="lawyer{{$item->id}}"></label>
                              </div>
                           </td>
                           <td class="pt-3-half">{{$item->user['lastname']}} {{$item->user['firstname']}} {{$item->user['middlename']}}</td>
                           <td class="pt-3-half">{{$item->user['phone']}}</td>
                           <td class="pt-3-half">{{$item->user['email']}}</td>
                           <td class="pt-3-half">
                              @php
                              $specialization_arr = [];
                              foreach ($specializations as $key => $specialization){
                                 if(json_decode($item->specialization_id) != null){
                                    foreach (json_decode($item->specialization_id) as $key => $spec){
                                       if($specialization->id == $spec){
                                          $specialization_arr[] = $specialization->name;
                                       }
                                    }
                                 }
                              }
                              @endphp

                              {{rtrim(implode(', ', $specialization_arr), ',')}}
                           </td>

                           <td class="pt-3-half">
                              @php
                              $specialization_arr2 = [];
                              foreach ($specializations2 as $key => $specialization2){
                                 if(json_decode($item->category_id) != null){
                                    foreach (json_decode($item->category_id) as $key => $spec){
                                       if($specialization2->id == $spec){
                                          $specialization_arr2[] = $specialization2->name;
                                       }
                                    }
                                 }
                              }
                              @endphp

                              {{rtrim(implode(', ', $specialization_arr2), ',')}}
                           </td>
                        </tr>

                     @endforeach
                  </tbody>
               </table>

            </form>

            {{ $lawyers->links() }}

         </div>
      </div>
      <!-- Editable table -->

   @endsection
