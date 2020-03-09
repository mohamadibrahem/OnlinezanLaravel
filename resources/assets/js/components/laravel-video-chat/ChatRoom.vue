<template>
   <div>

      <div class="row">
         <div class="col-md-12 video-section">
            <div>
               <div class="videoUser">
                  <video class="img-responsive video"  id='localVideo' muted autoplay loop playsinline>
                  </video>

               </div>
               <div class="videoRemote">
                  <video class="img-responsive video" id='remoteVideo' controls autoplay loop playsinline>
                  </video>
               </div>
            </div>
         </div>

         <div class="col-md-12 chat-section">
            <div class="panel panel-primary">
               <div class="panel-heading row">
                  <div class="col">
                     <span class="glyphicon glyphicon-comment"></span> <span v-if="this.currentUser.role_id == 4">Видеочат с юристом: {{ withUser.lastname +' '+ withUser.firstname}}</span>
                     <span v-if="this.currentUser.role_id == 3">Видеочат с клиентом: {{ withUser.lastname +' '+ withUser.firstname}}</span>
                  </div>

                  <div class="col">
                     <button class="btn btn-light-green btn-md pull-right" type="button" id="appointment_finish">
                        <span class="fa fa-video-camera"></span>Завершить
                     </button>

                     <button class="btn  btn-light-green btn-md pull-right" @click="startVideoCallToUser(withUser.id)" type="button" id="videoCallSubmit" v-if="this.currentUser.role_id == 3">
                        <span class="fa fa-video-camera"></span>Начать консультацию
                     </button>
                     <button class="btn  btn-light-green btn-md pull-right" @click="startVideoCallToUser(withUser.id)" type="button" id="videoCallUpdate" v-if="this.currentUser.role_id == 3">
                        <span class="fa fa-video-camera"></span>Обновить консультацию
                     </button>
                  </div>
                  <div class="status" v-if="connection_close == false">
                     Пользователь отключился. Обновите звонок.
                  </div>
                  <button v-on:click="appointmentFinish" id="appointmentDestroy" class="hidden">destroy</button>

               </div>

               <!-- <div class="panel-body">
               <ul class="chat" v-chat-scroll>
               <li class="clearfix" v-for="message in messages" v-bind:class="{ 'right' : check(message.sender.id), 'left' : !check(message.sender.id) }">
               <span class="chat-img" v-bind:class="{ 'pull-right' : check(message.sender.id) , 'pull-left' : !check(message.sender.id) }">
               <img :src="'https://placehold.it/50/FA6F57/fff&text='+ message.sender.name" alt="User Avatar" class="img-circle" />
            </span>
            <div class="chat-body clearfix">
            <div class="header">
            <small class=" text-muted"><span class="glyphicon glyphicon-time" ></span><timeago :since="message.created_at" :auto-update="10"></timeago></small>
            <strong v-bind:class="{ 'pull-right' : check(message.sender.id) , 'pull-left' : !check(message.sender.id)}" class="primary-font">
            {{ message.sender.firstname }}
         </strong>
      </div>
      <p v-bind:class="{ 'pull-right' : check(message.sender.id) , 'pull-left' : !check(message.sender.id)}">
      {{ message.text }}
   </p>
   <div class="row">
   <div class="col-md-3" v-for="file in message.files">
   <img :src="file.file_details.webPath" alt="" class="img-responsive">
   <a :href="file.file_details.webPath" target="_blank" download>Скачать - {{ file.name }}</a>
</div>
</div>
</div>
</li>
</ul>
</div>
<div class="panel-footer">
<div class="input-group">
<input id="btn-input" type="text" v-model="text" class="form-control input-sm" placeholder="Введите сообщение..." />
<span class="input-group-btn">
<button class="btn btn-warning btn-sm" type="button" @click.prevent="send()" id="btn-chat">
Отправить
</button>
</span>
</div> -->
<!-- <div class="input-group">
<input type="file" multiple class="form-control">
<span class="input-group-btn">
<button class="btn btn-warning btn-sm" type="button" @click.prevent="sendFiles()">
Отправить файл
</button>
</span>
</div> -->
<!-- </div> -->
</div>
</div>


<div id="incomingVideoCallModal" class="modal fade" role="dialog">
   <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title">Входящий звонок</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
         </div>
         <div class="modal-footer">
            <button type="button" id="answerCallButton" class="btn btn-success">Принять звонок</button>
            <button type="button" id="denyCallButton" data-dismiss="modal" class="btn btn-danger">Отклонить</button>
         </div>
      </div>

   </div>
</div>

</div>
<div class="row">
   <div class="col-md-3" v-for="file in conversation.files">
      <img :src="file.file_details.webPath" alt="" class="img-responsive">
      <a :href="file.file_details.webPath" target="_blank" download>Скачать - {{ file.name }}</a>
   </div>
</div>


<!-- <button class="record button btn-success" v-if="this.currentUser.role_id == 3">Запись видео (15 мин.)</button>
<div id="div" v-if="this.currentUser.role_id == 3"></div><br>
<a id="link" v-if="this.currentUser.role_id == 3"></a> -->

</div>
</template>


<script>
var moment = require('moment');
var buzz = require('buzz');
var mySound;
Cookies.set('consultation_started',false);
$(function () {
   var chatPage = window.location.pathname.split('/')[1] == 'chat';
   if(chatPage){

      $.ajax({
         url: '/api/chat_timer',
         type: "post",
         data:{
            'chat_id': $('#chat_id').val(),
         },
      }).done(function(data){
         console.log(data);
         var current_datetime = data.now_datetime.date;
         var appointment_datetime = data.appointment_datetime.date;
         var consultation_finish = data.consultation_finish.date;
         var consultation_start = data.consultation_start;
         $('#clock .title').text('Время до начало консультации');

         if($('#clock .day span').text() == '0'){
            $('#clock .day').remove();
         }
         $('#clock').countdownTimer(moment(appointment_datetime),function(){
            $('#videoCallSubmit').show();
            $('#clock .title').text('Время до окончания консультации');
            $('#clock').countdownTimer(moment(consultation_finish),function(){
               $('#clock h2').remove();
               $('#clock .title').text('Консультация завершена');
               $('#appointment_finish, #videoCallSubmit, #videoCallUpdate').remove();
               $('.description .end').show();
               $.ajax({
                  type: 'POST',
                  url: $('#end_appointment').attr('action'),
                  data: $('#end_appointment').serialize(),
                  success:function(data){
                     new buzz.sound("/../sounds/notification", {
                        formats: ["ogg"],
                        autoplay:true,
                     });
                     $('#appointmentDestroy').click();
                     $('#appointmentFinishModal').modal('show');
                  }
               });
            });
         });


      });

   }



   $('#endAppointment .yes').click(function(e){
      e.preventDefault();
      var url = $('#end_appointment').attr('action');
      $.ajax({
         type: 'POST',
         url: url,
         data: $('#end_appointment').serialize(),
         success:function(data){
            // console.log(data);
            $('#appointmentDestroy').click();
            window.location.href = '/online_consultations'
         }
      });
      return false;
   });

   $('#appointment_finish').click(function(){
      $('#endAppointment').modal('show');
   });
   $('#endAppointment .no').click(function(){
      $('#endAppointment').modal('hide');
   });

   $('.modal,.close').click(function(){
      mySound.pause();
   });
   // window.onbeforeunload = function (e) {
   //   var message = "Your confirmation message goes here.",
   //   e = e || window.event;
   //   // For IE and Firefox
   //   if (e) {
   //     e.returnValue = message;
   //   }
   //
   //   // For Safari
   //   return message;
   // }

   var localVideo = document.getElementById('localVideo');
   var remoteVideo = document.getElementById('remoteVideo');
   var answerButton = document.getElementById('answerCallButton');
   if(answerButton != null){
      answerButton.onclick = answerCall;
   }
   $('input[type=file]').on('change', prepareUpload);

   if(document.getElementById('localVideo')){
      localVideo.volume = 0;
   }
   // $('.videoUser .volume').on('change',function(){
   //   localVideo.volume = $(this).val();
   // });
   //
   // $('.videoRemote .volume').on('change',function(){
   //   remoteVideo.volume = $(this).val();
   // });
   // function isFullScreen() {
   //   return !!(document.fullScreen ||
   //     document.webkitIsFullScreen ||
   //     document.mozFullScreen ||
   //     document.msFullscreenElement ||
   //     document.fullscreenElement);
   //   }
   //
   //   function handleFullScreen() {
   //     if ( isFullScreen() ) {
   //       if (document.exitFullscreen) document.exitFullscreen();
   //       else if (document.mozCancelFullScreen) document.mozCancelFullScreen();
   //       else if (document.webkitCancelFullScreen) document.webkitCancelFullScreen();
   //       else if (document.msExitFullscreen) document.msExitFullscreen();
   //     } else {
   //       if (remoteVideo.requestFullscreen) remoteVideo.requestFullscreen();
   //       else if (remoteVideo.mozRequestFullScreen) remoteVideo.mozRequestFullScreen();
   //       else if (remoteVideo.webkitRequestFullScreen) remoteVideo.webkitRequestFullScreen();
   //       else if (remoteVideo.msRequestFullscreen) remoteVideo.msRequestFullscreen();
   //     }
   //   }

   // $('.videoRemote .fullscreen').on('click',function(){
   //   handleFullScreen();
   // });

});

var connection_close;
var files;
var cancelVideocall = false;
var conversationID;
var luid;
var ruid;
var startTime;
var localStream;
var pc;
var offerOptions = {
   offerToReceiveAudio: 1,
   offerToReceiveVideo: 1
};
var isCaller = false;
var peerConnectionDidCreate = false;
var candidateDidReceived = false;


// start();

export default {
   props: ['conversation' , 'currentUser'],
   data() {
      return {
         connection_close:true,
         onPeerConnection:false,
         show: true,
         conversationId : this.conversation.conversationId,
         channel : this.conversation.channel_name,
         messages : this.conversation.messages,
         withUser : this.conversation.user,
         cancelVideocall: false,
         text : '',
         constraints : {
            audio: false,
            video: true,
         },
      }
   },
   methods: {
      appointmentFinish: function (event) {
         onSignalClose();
         stop();
      },
      stopConnect () {
         onSignalClose();
         stop();
      },


      startVideoCallToUser (id) {
         Cookies.set('remoteUUID', id);
         window.remoteUUID = id;
         luid = Cookies.get('uuid');
         ruid = Cookies.get('remoteUUID');
         isCaller = true;
         start();
         this.onPeerConnection = true;
      },
      check(id) {
         return id === this.currentUser.id;

      },
      send() {
         axios.post('/chat/message/send',{
            conversationId : this.conversationId,
            text: this.text,
         }).then((response) => {
            this.text = '';
         });
      },
      sendFiles() {
         var data = new FormData();

         $.each(files, function(key, value)
         {
            data.append('files[]', value);
         });

         data.append('conversationId' , this.conversationId);

         axios.post('/chat/message/send/file', data);
      },
      listenForNewMessage: function () {
         Echo.join(this.channel)
         .here((users) => {
            console.log(users)
         })
         .listen('\\PhpJunior\\LaravelVideoChat\\Events\\NewConversationMessage', (data) => {
            var self = this;
            if ( data.files.length > 0 ){
               $.each( data.files , function( key, value ) {
                  self.conversation.files.push(value);
               });
            }
            this.messages.push(data);
         })
         .listen('\\PhpJunior\\LaravelVideoChat\\Events\\VideoChatStart', (data) => {

            if(data.to != this.currentUser.id){
               return;
            }

            if(data.type === 'signal'){
               onSignalMessage(data);
            }else if(data.type === 'text'){
               console.log('received text message from ' + data.from + ', content: ' + data.content);
            }else{
               console.log('received unknown message type ' + data.type + ' from ' + data.from);
            }
         });
      },
   },
   beforeMount () {
      Cookies.set('uuid', this.currentUser.id);
      Cookies.set('conversationID', this.conversationId);
   },
   mounted() {
      $('#videoCallUpdate, #appointment_finish, #videoCallSubmit, .description .end').hide();
      this.listenForNewMessage();

      // var doctor = this.currentUser.role_id;
      // console.log(this.currentUser.role_id);
   }
}

function onSignalMessage(m){
   if(m.subtype === 'offer'){
      Cookies.set('remoteUUID', m.from);
      onSignalOffer(m.content);
   }else if(m.subtype === 'answer'){
      onSignalAnswer(m.content);
   }else if(m.subtype === 'candidate'){
      onSignalCandidate(m.content);
   }else if(m.subtype === 'close'){
      onSignalClose();
   }else{
      console.log('unknown signal type ' + m.subtype);
   }
}

function onSignalClose() {
   trace('Ending call');
   pc.close();
   pc = null;
   closeMedia();
   clearView();
}

function closeMedia(){
   localStream.getTracks().forEach(function(track){track.stop();});
}

function clearView(){
   localVideo.srcObject = null;
   remoteVideo.srcObject = null;
}

function onSignalCandidate(candidate){
   onRemoteIceCandidate(candidate);
}

function onRemoteIceCandidate(candidate){
   trace('onRemoteIceCandidate : ' + JSON.stringify(candidate));
   if(peerConnectionDidCreate){
      addRemoteCandidate(candidate);
   }else{
      //remoteCandidates.push(candidate);
      var candidates = Cookies.getJSON('candidate');

      if(candidateDidReceived){
         candidates.push(candidate);
      }else{
         candidates = [candidate];
         candidateDidReceived = true;
      }
      Cookies.set('candidate', candidates);
   }
}

function onSignalAnswer(answer){
   onRemoteAnswer(answer);

}

function onRemoteAnswer(answer){
   $('#answerValue').val(JSON.stringify(answer));
   console.log(JSON.parse($('#answerValue').val()));

   function maybeAddLineBreakToEnd(sdp) {
      var endWithLineBreak = new RegExp(/\n$/);
      if (!endWithLineBreak.test(sdp)) {
         return sdp + '\n';
      }
      return sdp;
   }
   var answer = JSON.parse($('#answerValue').val());
   $('#answerValueSdp').val(answer.sdp);
   var sdp = $('#answerValueSdp').val();
   sdp = maybeAddLineBreakToEnd(sdp);
   console.log(sdp);
   sdp = sdp.replace(/\n/g, '\r\n');
   answer.sdp = sdp;

   trace('onRemoteAnswer : ' + answer);

   pc.setRemoteDescription(answer).then(function(){
      onSetRemoteSuccess(pc)
   }, onSetSessionDescriptionError);
}

function onSignalOffer(offer){
   // Cookies.set('offer', offer);
   $('#offerValue').val(JSON.stringify(offer));
   $('#offerValueSdp').val(JSON.stringify(offer.sdp));
   if(Cookies.get('consultation_started') == 'false'){
      Cookies.set('consultation_started', true);
      $('#incomingVideoCallModal').modal('show');
      mySound = new buzz.sound("/../sounds/sound", {
         formats: ["ogg"],
         autoplay:true,
         loop: true
      });
   }
   else if(Cookies.get('consultation_started') == 'true'){
      isCaller = false;
      luid = Cookies.get('uuid');
      ruid = Cookies.get('remoteUUID');
      start();
   }


}

function answerCall() {
   isCaller = false;
   luid = Cookies.get('uuid');
   ruid = Cookies.get('remoteUUID');
   $('#incomingVideoCallModal').modal('hide');
   mySound.pause();
   start();
}

function gotStream(stream) {
   trace('Received local stream');
   localVideo.srcObject = stream;
   localStream = stream;
   localVideo.play();
   call();
}
//
//
// function gotLocalStream(stream) {
//   localVideo.srcObject = stream;
//   localStream = stream;
// }
// navigator.mediaDevices.getUserMedia({
//   audio: true,
//   video: {
//     width: { min: 640, ideal: 1280, max: 1360},
//     height: { min: 360, ideal: 720, max: 768},
//   }
// }).then(gotLocalStream);



// if(window.location.pathname.split('/')[1] == 'chat'){
//    function gotStreamCam(stream) {
//       localVideo.srcObject = stream;
//       localStream = stream;
//       localVideo.play();
//    }
//    navigator.mediaDevices.getUserMedia({
//       audio: true,
//       video: {
//          width: { ideal: 1280 },
//          height: { ideal: 720 }
//       }
//    })
//    .then(gotStreamCam)
//    .catch(function(e) {
//       alert('Ошибка подключения ' + e.name);
//    });
//    console.log(window.location.pathname.split('/')[1]);
//    console.log(window.location.pathname);
// }

function start() {
   console.log(new Date());
   navigator.mediaDevices.getUserMedia({
      audio: true,
      video: true
   })
   .then(gotStream)
   .catch(function(e) {
      alert('Ошибка подключения ' + e.name);
   });
}

function stop() {
   trace('Requesting local stream');
   navigator.mediaDevices.getUserMedia({
      audio: false,
      video: false,
   });
}




function call() {
   conversationID = Cookies.get('conversationID');

   trace('Starting call');
   startTime = window.performance.now();
   var videoTracks = localStream.getVideoTracks();
   var audioTracks = localStream.getAudioTracks();
   if (videoTracks.length > 0) {
      trace('Using video device: ' + videoTracks[0].label);
   }
   if (audioTracks.length > 0) {
      trace('Using audio device: ' + audioTracks[0].label);
   }

   var configuration = {
      "iceServers":
      [
         {urls:'stun:stun01.sipphone.com'},
         {urls:'stun:stun.ekiga.net'},
         {urls:'stun:stun.fwdnet.net'},
         {urls:'stun:stun.ideasip.com'},
         {urls:'stun:stun.iptel.org'},
         {urls:'stun:stun.rixtelecom.se'},
         {urls:'stun:stun.schlund.de'},
         {urls:'stun:stunserver.org'},
         {urls:'stun:stun.softjoys.com'},
         {urls:'stun:stun.voiparound.com'},
         {urls:'stun:stun.voipbuster.com'},
         {urls:'stun:stun.voipstunt.com'},
         {urls:'stun:stun.voxgratia.org'},
         {urls:'stun:stun.xten.com'},
         {
            urls: 'turn:numb.viagenie.ca',
            credential: 'muazkh',
            username: 'webrtc@live.com'
         },


      ]
   };
   pc = new RTCPeerConnection(configuration);

   trace('Created local peer connection object pc');

   pc.onicecandidate = function(e) {
      onIceCandidate(pc, e);
   };

   pc.oniceconnectionstatechange = function(e) {
      onIceStateChange(pc, e);
   };


   pc.onaddstream = gotRemoteStream;
   pc.onremovestream = function(ev) { alert("onremovestream event detected!"); };

   pc.addStream(localStream);

   trace('Added local stream to pc');
   peerConnectionDidCreate = true;

   if(isCaller) {
      trace(' createOffer start');
      trace('pc createOffer start');

      pc.createOffer(
         offerOptions
      ).then(
         onCreateOfferSuccess,
         onCreateSessionDescriptionError
      );
   }else{
      onAnswer();
   }
}
function onCreateAnswerSuccess(desc) {

   trace('Answer from pc:\n' + desc.sdp);
   trace('pc setLocalDescription start');
   pc.setLocalDescription(desc).then(
      function() {
         onSetLocalSuccess(pc);
      },
      onSetSessionDescriptionError
   );
   conversationID = Cookies.get('conversationID');
   var message = {from: luid, to:ruid, type: 'signal', subtype: 'answer', content: desc, time:new Date()};
   axios.post('/trigger/' + conversationID , message );

}


function onAnswer(){
   // var remoteOffer = Cookies.get('offer'); old
   function maybeAddLineBreakToEnd(sdp) {
      var endWithLineBreak = new RegExp(/\n$/);
      if (!endWithLineBreak.test(sdp)) {
         return sdp + '\n';
      }
      return sdp;
   }
   var offer = JSON.parse($('#offerValue').val());
   $('#offerValueSdp').val(offer.sdp);
   var sdp = $('#offerValueSdp').val();
   sdp = maybeAddLineBreakToEnd(sdp);
   console.log(sdp);
   sdp = sdp.replace(/\n/g, '\r\n');
   offer.sdp = sdp;
   pc.setRemoteDescription(offer).then(function(){
      onSetRemoteSuccess(pc)
   }, onSetSessionDescriptionError);

   pc.createAnswer().then(
      onCreateAnswerSuccess,
      onCreateSessionDescriptionError
   );
}



function onSetRemoteSuccess(pc) {
   trace(pc + ' setRemoteDescription complete');
   applyRemoteCandidates();
}

function applyRemoteCandidates(){
   var candidates = Cookies.getJSON('candidate');
   for(var candidate in candidates){
      addRemoteCandidate(candidates[candidate]);
   }
   Cookies.remove('candidate');
}

function addRemoteCandidate(candidate){
   pc.addIceCandidate(candidate).then(
      function() {
         onAddIceCandidateSuccess(pc);
      },
      function(err) {
         onAddIceCandidateError(pc, err);
      });
   }

   function onIceCandidate(pc, event) {
      onSetRemoteSuccess(pc);
      if (event.candidate){
         trace(pc + ' ICE candidate: \n' + (event.candidate ? event.candidate.candidate : '(null)'));
         conversationID = Cookies.get('conversationID');
         var message = {from: luid, to:ruid, type: 'signal', subtype: 'candidate', content: event.candidate, time:new Date()};
         axios.post('/trigger/' + conversationID , message );
      }
   }

   function onAddIceCandidateSuccess(pc) {
      trace(pc + ' addIceCandidate success');
      cancelVideocall = true;
   }

   function onAddIceCandidateError(pc, error) {
      trace(pc + ' failed to add ICE Candidate: ' + error.toString());
   }

   function onIceStateChange(pc, event) {
      if (pc) {
         trace(pc + ' ICE state: ' + pc.iceConnectionState);
         console.log('ICE state change event: ', event);
         if(pc.iceConnectionState == 'disconnected'){
            $('#videoCallSubmit').hide();
            $('#videoCallUpdate').show();
            $('.videoRemote .control-panel').hide();
            remoteVideo.src = null;
            var connection_close = false;
            $('.status_doctor, .status_patient').hide();
            call();
         }else if(pc.iceConnectionState == 'connected'){
            var connection_close = true;
            $('#appointment_finish').show();
            $('#videoCallUpdate').hide();
            $('.videoRemote .control-panel').show();
            $('#videoCallSubmit').hide();
            $('.status_doctor, .status_patient').hide();
            Cookies.set('consultation_started', true);

         }
      }

   }

   function onCreateSessionDescriptionError(error) {
      trace('Failed to create session description: ' + error.toString());
   }

   function onCreateOfferSuccess(desc) {


      function maybeAddLineBreakToEnd(sdp) {
         var endWithLineBreak = new RegExp(/\n$/);
         if (!endWithLineBreak.test(sdp)) {
            return sdp + '\n';
         }
         return sdp;
      }
      var desc = desc;
      $('#offerValueSdp').val(desc.sdp);
      var sdp = $('#offerValueSdp').val();
      sdp = maybeAddLineBreakToEnd(sdp);
      console.log(sdp);
      sdp = sdp.replace(/\n/g, '\r\n');
      desc.sdp = sdp;

      trace('Offer from pc\n' + desc.sdp);
      trace('pc setLocalDescription start');
      pc.setLocalDescription(desc).then(
         function() {
            pc.getStats();
            onSetLocalSuccess(pc);
         },
         onSetSessionDescriptionError
      );

      conversationID = Cookies.get('conversationID');
      var message = {from: luid, to:ruid, type: 'signal', subtype: 'offer', content: desc, time:new Date()};
      axios.post('/trigger/' + conversationID , message );
   }

   function onSetLocalSuccess(pc) {
      trace( pc + ' setLocalDescription complete');
   }

   function onSetSessionDescriptionError(error) {
      trace('Failed to set session description: ' + error.toString());
   }

   function gotRemoteStream(e) {
      if (remoteVideo.srcObject !== e.stream) {
         remoteVideo.srcObject = e.stream;
         trace('pc received remote stream');
      }
   }

   function trace(arg) {
      var now = (window.performance.now() / 1000).toFixed(3);
      console.log(now + ': ', arg);
   }

   function prepareUpload(event)
   {
      files = event.target.files;
   }

   </script>

   <style>
   .status_doctor, .status_patient{
      position: absolute;
      padding: 10px;
      font-size: 20px;
   }
   .btn.pull-right{
      font-size: 16px;
      margin-left: 10px;
   }
   .chat-img{
      width: 20px;
      display: none;
   }
   .glyphicon-time{
      margin-left: 5px;
   }
   ul.chat .right{
      background: #f2f2f2;
      padding: 0 10px;
      margin-bottom: 20px;
      border-radius: 4px;
      width: 50%;
      float: right;
      clear: both;
   }
   ul.chat .left{
      background: #f2f2f2;
      padding: 0 10px;
      margin-bottom: 20px;
      border-radius: 4px;
      width: 50%;
      float: left;
      clear: both;
   }
   ul.chat .header{
      flex-direction: column-reverse;
      display: flex;
      margin-left: -10px;
      width: calc(100% + 20px);
   }
   ul.chat .header .primary-font{
      padding: 5px 10px;
      color: #fff;
      border-radius: 4px;
   }
   ul.chat .right .header .primary-font{
      background: #3097D1;
   }
   ul.chat .left .header .primary-font{
      background: #00a9ad;
   }

   </style>
