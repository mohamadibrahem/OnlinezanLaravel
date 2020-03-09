$(document).ready(function(){

   var next = $('#field>div').length-1;
   $("#add-more").click(function(e){
      e.preventDefault();
      console.log('clickc');
      var addto = "#field" + next;
      var addRemove = "#field" + (next);
      next = next + 1;
      var newIn = ' <div id="field'+ next +'" name="field'+ next +'"><div class="form-group"><br><input id="npa" name="npa[]" type="text" placeholder="" class="form-control input-md"><br></div></div>';
      var newInput = $(newIn);
      var removeBtn = '<button id="remove' + (next - 1) + '" class="btn btn-danger remove-me">Удалить</button></div></div>';
      var removeButton = $(removeBtn);
      $(addto).after(newInput);
      $(addRemove).after(removeButton);
      $("#field" + next).attr('data-source',$(addto).attr('data-source'));
      $("#count").val(next);

      $('.remove-me').click(function(e){
         e.preventDefault();
         var fieldNum = this.id.charAt(this.id.length-1);
         var fieldID = "#field" + fieldNum;
         $(this).remove();
         $(fieldID).remove();
      });
   });

   $('.remove-me').click(function(e){
      e.preventDefault();
      var fieldNum = this.id.charAt(this.id.length-1);
      var fieldID = "#field" + fieldNum;
      $(this).remove();
      $(fieldID).remove();
   });

});
