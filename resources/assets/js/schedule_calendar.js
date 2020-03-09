
(function ($) {
   "use strict";
   $(window).on('load',function(){
      $.datetimepicker.setLocale('ru');
      if(window.location.pathname != '/schedules'){
         $.ajax({
            url: '/api/postSchedule',
            type:"POST",
            data:{
               'lawyer_id': $('#lawyer_id').val(),
            },

            success:function(response) {
               var schedules = [];
               var highlighted_dates = [];
               var schedule_id;
               $.each(response, function(i, data){
                  var schedule_date = moment(data.datetime);
                  var schedule_day = schedule_date.format('YYYY-MM-DD');
                  highlighted_dates.push(moment(schedule_day).format('YYYY/MM/DD'));
               });



               $('#date_modal').datetimepicker({
                  inline:true,
                  timepicker:false,
                  format:'Y-m-d',
                  dayOfWeekStart: 1,
                  minDate: moment(),
                  prevButton: false,
                  nextButton: false,
                  todayButton: false,
                  scrollMonth: false,
                  scrollTime: false,
                  scrollInput: false,
                  yearStart: new Date().getFullYear(),
                  yearEnd: new Date().getFullYear(),
                  monthStart: new Date().getMonth(),
                  monthEnd: new Date().getMonth() + 1,

                  onGenerate:function(current_time,$input){
                  },
                  highlightedDates: highlighted_dates,
                  onSelectDate:function(day){
                     var selected_day = new Date(day);
                     var selected_date = moment(new Date(day)).format('YYYY-MM-DD HH:mm');
                     selected_day = moment(selected_day).format('YYYY-MM-DD');
                     schedules = [];
                     $.each(response, function(i, data){
                        var schedule_date = moment(data.datetime);
                        var schedule_day =schedule_date.format('YYYY-MM-DD');
                        var schedule_time = schedule_date.format('HH:mm');

                        if(schedule_day == selected_day){
                           schedules.push(schedule_time);
                        }
                     });
                     if(schedules != ''){
                        $('#time_modal').datetimepicker({
                           inline:true,
                           timepicker:true,
                           datepicker:false,
                           format:'H:i',
                           allowTimes:schedules,
                           scrollInput : false,
                           onSelectTime:function(time){
                              var selected_time = moment(time).format('HH:mm');
                              $.each(response, function(i, data){
                                 var schedule_date = moment(data.datetime);
                                 var schedule_day =schedule_date.format('YYYY-MM-DD');
                                 var schedule_time = schedule_date.format('HH:mm');
                                 if(selected_day+' '+selected_time == schedule_day+' '+schedule_time){
                                    schedule_id = data.id;
                                 }
                              });

                              var time = $('#onlineConsultationModal #time_modal').val();
                              var date = $('#onlineConsultationModal #date_modal').val();
                              $('#datetime').val(date+ ' ' +time);
                              $('#consul_datetime').val(date+ ' ' +time);
                              $('#appointment_schedule_id').val(schedule_id);
                              $('#order_confirm').removeClass('hidden');
                              $('#to_pay').addClass('hidden');
                           }
                        });
                     }else{
                        $('#time_modal').datetimepicker({
                           timepicker:false,
                        });
                     }
                  },
               });
            },
            error:function(){
               console.log('error');
            }
         });
      }

      if(window.location.pathname == '/schedules'){
         $('#save_schedule>button').hide();

         $.ajax({
            url: '/api/postSchedule',
            type:"POST",
            data:{
               'lawyer_id': $('#lawyer_id').val(),
            },
            success:function(response) {
               var schedules = [];
               var highlighted_dates = [];
               $.each(response, function(i, data){
                  var schedule_date = moment(data.datetime);
                  var schedule_day = schedule_date.format('YYYY-MM-DD');
                  highlighted_dates.push(moment(schedule_day).format('YYYY/MM/DD'));
               });


               $('#schedule_date').datetimepicker({
                  inline:true,
                  timepicker:false,
                  format:'Y-m-d',
                  dayOfWeekStart: 1,
                  minDate: moment(),
                  prevButton: false,
                  nextButton: false,
                  todayButton: false,
                  scrollMonth: false,
                  scrollTime: false,
                  scrollInput: false,
                  yearStart: new Date().getFullYear(),
                  yearEnd: new Date().getFullYear(),
                  monthStart: new Date().getMonth(),
                  monthEnd: new Date().getMonth() + 1,
                  highlightedDates: highlighted_dates,
               });


               $('#date_modal').datetimepicker({
                  inline:true,
                  timepicker:false,
                  format:'Y-m-d',
                  dayOfWeekStart: 1,
                  minDate: moment(),
                  prevButton: false,
                  nextButton: false,
                  todayButton: false,
                  scrollMonth: false,
                  scrollTime: false,
                  scrollInput: false,
                  yearStart: new Date().getFullYear(),
                  yearEnd: new Date().getFullYear(),
                  monthStart: new Date().getMonth(),
                  monthEnd: new Date().getMonth() + 1,
                  highlightedDates: highlighted_dates,
                  onGenerate:function(current_time,$input){
                  },
                  onSelectDate:function(day){
                     var selected_day = new Date(day);
                     selected_day = moment(selected_day).format('YYYY-MM-DD');
                     schedules = [];
                     var times = '';

                     $.each(response, function(i, data){
                        var schedule_date = moment(data.datetime);
                        var schedule_day = schedule_date.format('YYYY-MM-DD');
                        var schedule_time = schedule_date.format('HH:mm');

                        if(schedule_day == selected_day){
                           schedules.push(schedule_time);
                        }
                     });
                     if(selected_day == moment(new Date()).format('YYYY-MM-DD')){
                        $('.select_time #times_list .time').each(function(){
                           if($(this).text() < moment(new Date()).format('HH:mm')){
                              $(this).hide();
                           }
                        });
                     }else{
                        $('.select_time #times_list .time').each(function(){
                           $(this).show();
                        });
                     }

                     $('#create_schedule_modal .time').removeClass('active');
                     var elements_not = '';
                     var elements = '';
                     $.each(schedules, function (i, time1) {
                        $('#create_schedule_modal #times_list .time').each(function(i, el){
                           var time2 = $(this).text();
                           if(time1 == time2){
                              var elements = $(el);
                              times += time2 + ',';
                           }else{
                              var elements_not = '';
                           }
                           $(elements).addClass('active');

                        });

                     });
                     var time_arr = [times.split(',')];
                     var times_schedule = time_arr[0].slice(0, -1);
                     $('#create_schedule_modal #time').val(times_schedule);
                  },
               });

               $('#create_schedule_modal #times_list .time').click(function(){
                  $('#save_schedule>button').show();
                  $(this).toggleClass('active');
                  var input = $(this).text();
                  var times = '';
                  $('#create_schedule_modal #times_list .time').each(function(){
                     if($(this).hasClass('active')){
                        var time = $(this).text();
                        times += time + ',';
                     }
                  });
                  var time_arr = [times.split(',')];
                  var times_schedule = time_arr[0].slice(0, -1);
                  $('#create_schedule_modal #time').val(times_schedule);
               });
            }

         });

      }


      $('#save_schedule').on('submit', function (e) {
         e.preventDefault();
         $('.schedule_desc').remove();
         var url = $(this).attr('action');
         if($('#date_modal').val() == ""){
            alert('Вы не выбрали дату');
         }else{
            $.ajax({
               type: 'POST',
               url: url,
               data: $('#save_schedule').serialize(),
               success: function (data) {
                  $('#save_schedule .error').remove();
                  $('#schedule_desc').remove();
                  setTimeout(function(){
                     $('#save_schedule').append('<span id="schedule_desc">График успешно создан!</span>');


                     $.ajax({
                        url: '/api/postSchedule',
                        type:"POST",
                        data:{
                           'lawyer_id': $('#lawyer_id').val(),
                        },

                        success:function(response) {
                           var schedules = [];
                           var highlighted_dates = [];
                           var schedule_id;
                           $.each(response, function(i, data){
                              var schedule_date = moment(data.datetime);
                              var schedule_day = schedule_date.format('YYYY-MM-DD');
                              highlighted_dates.push(moment(schedule_day).format('YYYY/MM/DD'));
                           });
                           $('#schedule_date').datetimepicker({
                              inline:true,
                              timepicker:false,
                              format:'Y-m-d',
                              dayOfWeekStart: 1,
                              minDate: moment(),
                              prevButton: false,
                              nextButton: false,
                              todayButton: false,
                              scrollMonth: false,
                              scrollTime: false,
                              scrollInput: false,
                              yearStart: new Date().getFullYear(),
                              yearEnd: new Date().getFullYear(),
                              monthStart: new Date().getMonth(),
                              monthEnd: new Date().getMonth() + 1,
                              highlightedDates: highlighted_dates,
                           });
                           $('#date_modal').datetimepicker({
                              inline:true,
                              timepicker:false,
                              format:'Y-m-d',
                              dayOfWeekStart: 1,
                              minDate: moment(),
                              prevButton: false,
                              nextButton: false,
                              todayButton: false,
                              scrollMonth: false,
                              scrollTime: false,
                              scrollInput: false,
                              yearStart: new Date().getFullYear(),
                              yearEnd: new Date().getFullYear(),
                              monthStart: new Date().getMonth(),
                              monthEnd: new Date().getMonth() + 1,

                              onGenerate:function(current_time,$input){
                              },
                              highlightedDates: highlighted_dates,
                              onSelectDate:function(day){
                                 var selected_day = new Date(day);
                                 selected_day = moment(selected_day).format('YYYY-MM-DD');
                                 schedules = [];
                                 var times = '';

                                 $.each(response, function(i, data){
                                    var schedule_date = moment(data.datetime);
                                    var schedule_day = schedule_date.format('YYYY-MM-DD');
                                    var schedule_time = schedule_date.format('HH:mm');

                                    if(schedule_day == selected_day){
                                       schedules.push(schedule_time);
                                    }
                                 });
                                 if(selected_day == moment(new Date()).format('YYYY-MM-DD')){
                                    $('.select_time #times_list .time').each(function(){
                                       if($(this).text() < moment(new Date()).format('HH:mm')){
                                          $(this).hide();
                                       }
                                    });
                                 }else{
                                    $('.select_time #times_list .time').each(function(){
                                       $(this).show();
                                    });
                                 }

                                 $('#create_schedule_modal .time').removeClass('active');
                                 var elements_not = '';
                                 var elements = '';
                                 $.each(schedules, function (i, time1) {
                                    $('#create_schedule_modal #times_list .time').each(function(i, el){
                                       var time2 = $(this).text();
                                       if(time1 == time2){
                                          var elements = $(el);
                                          times += time2 + ',';
                                       }else{
                                          var elements_not = '';
                                       }
                                       $(elements).addClass('active');

                                    });

                                 });
                                 var time_arr = [times.split(',')];
                                 var times_schedule = time_arr[0].slice(0, -1);
                                 $('#create_schedule_modal #time').val(times_schedule);
                              },
                           });
                        }
                     });

                  },500);
               },
               error: function (data) {
                  alert('На это время график уже существует');
               }
            });
         }

      });




   });


}(jQuery));
