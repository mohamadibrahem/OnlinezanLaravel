@extends('layouts.app')
@section('content')
   @section('title', 'Проверка связи')

   <div class="connection-test">
      <div class="container">
         <div class="col-12">
            <br>
            <br>
            <div>
               <h4>Проверка звука</h4>
               <br>
               <br>
               <div>
                  <audio id="audio" src="http://www.sousound.com/music/healing/healing_01.mp3" preload="auto"  ></audio>
                  <button id="play" class="btn btn-primary">Запустить</button>
                  <button id="stop" class="btn btn-danger">Остановить</button>
               </div>
               <br>
               <hr>
               <br>
               <h4>Проверка микрофона</h4>
               <br>
               <button id="microStart" class="btn btn-primary" onclick="з.start()">Запустить микрофон</button>

               <br>
               <canvas id="meter" width="500" height="50"></canvas>
               <br>
               Следите за зеленым ползунком
               <br>
               <hr>
               <br>
               <h4>Проверка камеры</h4>
               <br>
               <br>
               <video width="400px" class="video" id="video" autoplay></video>

               <script>
               var video = document.getElementById('video');

               // Get access to the camera!
               if(navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
                  // Not adding `{ audio: true }` since we only want video now
                  navigator.mediaDevices.getUserMedia({ video: true}).then(function(stream) {
                     //video.src = window.URL.createObjectURL(stream);
                     video.srcObject = stream;
                     video.play();
                  });
               }
               </script>
            </div>
         </div>
      </div>

   </div>




   <script>

   var playBtn = document.getElementById('play');
   var stopBtn = document.getElementById('stop');
   var playSound = function() {
      audio.play();
   };
   playBtn.addEventListener('click', playSound, false);
   stopBtn.addEventListener('click', function(){audio.pause()}, false);
   </script>

   <script>
   var audioContext = null;
   var meter = null;
   var canvasContext = null;
   var WIDTH=500;
   var HEIGHT=50;
   var rafID = null;

   met = function() {

      // grab our canvas
      canvasContext = document.getElementById( "meter" ).getContext("2d");

      // monkeypatch Web Audio
      //window.AudioContext = window.AudioContext || window.webkitAudioContext;

      // grab an audio context
      audioContext = new AudioContext();

      // Attempt to get audio input
      try {


         // ask for an audio input
         navigator.getUserMedia(
            {
               "audio": {
                  "mandatory": {
                     "googEchoCancellation": "false",
                     "googAutoGainControl": "false",
                     "googNoiseSuppression": "false",
                     "googHighpassFilter": "false"
                  },
                  "optional": []
               },
            }, gotStream, didntGetStream);
         } catch (e) {
            alert('getUserMedia threw exception :' + e);
         }

      }


      function didntGetStream() {
         alert('Stream generation failed.');
      }

      var mediaStreamSource = null;

      function gotStream(stream) {
         // Create an AudioNode from the stream.
         mediaStreamSource = audioContext.createMediaStreamSource(stream);

         // Create a new volume meter and connect it.
         meter = createAudioMeter(audioContext);
         mediaStreamSource.connect(meter);

         // kick off the visual updating
         drawLoop();
      }

      function drawLoop( time ) {
         // clear the background
         canvasContext.clearRect(0,0,WIDTH,HEIGHT);

         // check if we're currently clipping
         if (meter.checkClipping())
         canvasContext.fillStyle = "red";
         else
         canvasContext.fillStyle = "green";

         // draw a bar based on the current volume
         canvasContext.fillRect(0, 0, meter.volume*WIDTH*1.4, HEIGHT);

         // set up the next visual callback
         rafID = window.requestAnimationFrame( drawLoop );
      }


      function createAudioMeter(audioContext,clipLevel,averaging,clipLag) {
         var processor = audioContext.createScriptProcessor(512);
         processor.onaudioprocess = volumeAudioProcess;
         processor.clipping = false;
         processor.lastClip = 0;
         processor.volume = 0;
         processor.clipLevel = clipLevel || 0.98;
         processor.averaging = averaging || 0.95;
         processor.clipLag = clipLag || 750;

         // this will have no effect, since we don't copy the input to the output,
         // but works around a current Chrome bug.
         processor.connect(audioContext.destination);

         processor.checkClipping =
         function(){
            if (!this.clipping)
            return false;
            if ((this.lastClip + this.clipLag) < window.performance.now())
            this.clipping = false;
            return this.clipping;
         };

         processor.shutdown =
         function(){
            this.disconnect();
            this.onaudioprocess = null;
         };

         return processor;
      }

      function volumeAudioProcess( event ) {
         var buf = event.inputBuffer.getChannelData(0);
         var bufLength = buf.length;
         var sum = 0;
         var x;

         // Do a root-mean-square on the samples: sum up the squares...
         for (var i=0; i<bufLength; i++) {
            x = buf[i];
            if (Math.abs(x)>=this.clipLevel) {
               this.clipping = true;
               this.lastClip = window.performance.now();
            }
            sum += x * x;
         }

         // ... then take the square root of the sum.
         var rms =  Math.sqrt(sum / bufLength);

         // Now smooth this out with the averaging factor applied
         // to the previous sample - take the max here because we
         // want "fast attack, slow release."
         this.volume = Math.max(rms, this.volume*this.averaging);
      }



      var з     = new webkitSpeechRecognition(),
      voice     = "";
      chance = 0;

      з.onstart  = є=> {

         voice = "";

         з.onresult = є=> {
            voice  = є.results[0][0].transcript;
            chance = Math.round(є.results[0][0].confidence*10000)/100;
         }
         з.onend    = є=> (voice === "") ? no_speech() : speech();
         var reseter,
         active = false;
         //var op = є=> $('#bars').css({opacity:є});
         //var bc = є=> $('#bars div').css({backgroundColor:є})
         //var ht = є=> $('stylehere').html(є);

         з.onaudiostart  = є=> met();
         // з.onspeechstart = є=> bc("#6634ff");
         // з.onspeechend   = є=> bc("#1ee7a6");
         з.onaudioend    = є=> {meter.shutdown();}

         var no_speech   = є=> {console.log('no-speech')};
         var speech      = є=> {console.log(voice,chance)};
      }
      </script>
   @endsection
