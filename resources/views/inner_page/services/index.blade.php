@extends('layouts.app')

@section('content')
   @section('title', 'Услуги')

   <div class="content-services">
      <div class="container">
         <div class="inform">
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
               labore et dolore magna aliqua. In metus vulputate eu scelerisque felis. Sodales neque
               sodales ut etiam sit. Sit amet luctus venenatis lectus. Massa placerat duis ultricies lacus
               sed turpis. Tincidunt id aliquet risus feugiat in ante metus. Pulvinar neque laoreet
               suspendisse interdum consectetur libero id faucibus nisl. Eget sit amet tellus cras. Dui
               faucibus in ornare quam viverra orci sagittis eu volutpat. Mi bibendum neque egestas congue
               quisque egestas diam in arcu. Sit amet nisl suscipit adipiscing bibendum est. Tempor id eu
               nisl nunc mi ipsum faucibus. Egestas purus viverra accumsan in nisl nisi.</p>
            </div>
            <ul class="nav nav-tabs " id="myTab" role="tablist">
               <li class="nav-item">
                  <a class="nav-link left active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                  aria-controls="home" aria-selected="true">ДЛЯ ФИЗИЧЕСКИХ ЛИЦ</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link right" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                  aria-controls="profile" aria-selected="false">ДЛЯ ЮРИДИЧЕСКИХ ЛИЦ</a>
               </li>

            </ul>
            <div class="tab-content" id="myTabContent">
               <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                  <div class="row">
                     <div class="col-md-4 col-12">
                        <div class="card">
                           <p><img src="img/img-11.png" alt=""></p>
                           <a href="#">
                              <h4>Жилищные правоотношения</h4>
                           </a>

                        </div>
                     </div>
                     <div class="col-md-4 col-12">
                        <div class="card">
                           <p><img src="img/img-12.png" alt=""></p>
                           <a href="#">
                              <h4>Земельные отношения</h4>
                           </a>

                        </div>
                     </div>
                     <div class="col-md-4 col-12">
                        <div class="card">
                           <p><img src="img/img-13.png" style="width:48px;" alt=""></p>
                           <a href="#">
                              <h4>Брачно-семейные отношения</h4>
                           </a>

                        </div>
                     </div>
                  </div>
                  <div class="row margin-top">
                     <div class="col-md-4 col-12">
                        <div class="card">
                           <p><img src="img/img-14.png" alt=""></p>
                           <a href="#">
                              <h4>Трудовые отношения</h4>
                           </a>

                        </div>
                     </div>
                     <div class="col-md-4 col-12">
                        <div class="card">
                           <p><img src="img/img-15.png" style="width:20px;" alt=""></p>
                           <a href="#">
                              <h4>Административные отношения</h4>
                           </a>

                        </div>
                     </div>
                     <div class="col-md-4 col-12">
                        <div class="card">
                           <p><img src="img/img-16.png" style="width:33px;" alt=""></p>
                           <a href="#">
                              <h4>Банковские услуги</h4>
                           </a>

                        </div>
                     </div>
                  </div>
               </div>
               <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                  <div class="row">
                     <div class="col-md-4 col-12">
                        <div class="card">
                           <p><img src="img/img-11.png" alt=""></p>
                           <a href="#">
                              <h4>Предпринимателям</h4>
                           </a>

                        </div>
                     </div>
                     <div class="col-md-4 col-12">
                        <div class="card">
                           <p><img src="img/img-12.png" alt=""></p>
                           <a href="#">
                              <h4>Банковские услуги</h4>
                           </a>

                        </div>
                     </div>
                     <div class="col-md-4 col-12">
                        <div class="card">
                           <p><img src="img/img-13.png" style="width:48px;" alt=""></p>
                           <a href="#">
                              <h4>Страхование</h4>
                           </a>

                        </div>
                     </div>
                  </div>
                  <div class="row margin-top">
                     <div class="col-md-4 col-12">
                        <div class="card">
                           <p><img src="img/img-14.png" alt=""></p>
                           <a href="#">
                              <h4>Корпоративное право</h4>
                           </a>

                        </div>
                     </div>
                     <div class="col-md-4 col-12">
                        <div class="card">
                           <p><img src="img/img-15.png" style="width:20px;" alt=""></p>
                           <a href="#">
                              <h4>Налоговые правоотношения</h4>
                           </a>

                        </div>
                     </div>
                     <div class="col-md-4 col-12">
                        <div class="card">
                           <p><img src="img/img-16.png" style="width:33px;" alt=""></p>
                           <a href="#">
                              <h4>Административные отношения</h4>
                           </a>

                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>

   @endsection
