<div class="modal fade" id="applicationConsultationModal1" tabindex="-1" role="dialog"
aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
   <div class="modal-content">

      <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLongTitle">Оставить заявку</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
         </button>
      </div>

      <div class="modal-body" id="hide_form">

         <p>Стоимость консультации: 5000 тг.</p>
         <hr>
         <div class="messages"></div>

         <form action="{{route('applications.store')}}" class="my-form" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            <p>Ф.И.О:</p>
            <input class="form-control full-name" type="text" name="client_name">
            <div class="form-contact">
               <div class="half">
                  <p>e-mail:</p>
                  <input class="form-control e-mail-input" type="email" name="client_email">
               </div>
               <div class="half">
                  <p>тел:</p>
                  <input class="form-control number-input" type="number" name="client_phone">
               </div>

            </div>
            <div class="form-contact">
               <div class="half">
                  <p>Ваш тип: (Юр/Физ)</p>
                  <select class="form-control fiz-iur" id="exampleFormControlSelect1" name="user_type">
                     <option>Юридическое лицо</option>
                     <option>Физическое лицо</option>

                  </select>
               </div>
               <div class="half">
                  <p>Тема запроса</p>
                  <select class="form-control w-problem" id="exampleFormControlSelect2" name="service">
                     <option>Жилищные правоотношения</option>
                     <option>Земельные отношения</option>
                     <option>Брачно-семейные отношения</option>
                     <option>Трудовые отношения</option>
                     <option>Административные отношения</option>
                     <option>Предпринимателям</option>
                     <option>Корпоративное право</option>
                     <option>Налоговые правоотношения</option>
                     <option>Страхование</option>
                     <option>Банковские услуги</option>
                  </select>
               </div>
            </div>
            <p>Опишите проблему:</p>
            <textarea class="form-control" name="comment" id="" rows="5"></textarea>

            <input type="file" name="application_file[]" class="dl-file" multiple>
            
            <input type="submit" value="отправить" class="my-btn-form">

         </form>
      </div>
   </div>
</div>
</div>
