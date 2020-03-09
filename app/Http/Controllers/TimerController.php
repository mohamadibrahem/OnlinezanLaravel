<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\OnlineConsultation;
use App\Lawyer;
use App\Client;
use Auth;



class TimerController extends Controller{

   public function datetime_timer(){
      $current_datetime = Carbon::now()->format('Y-m-d H:i:s');
      $datetime_arr = [];
      $consultation_duration = null;
      $chat_id = '';

      if(Auth::check()){
         $user = Auth::user();
         if($user->role_id == 3){
            $doctor = Lawyer::where('user_id', $user->id)->get()['0'];
            $doctor_user = Lawyer::where('user_id', $user->id)->get()['0']->user;
            $doctor_id = $doctor['id'];
            $appointments = OnlineConsultation::where('doctor_id', $doctor_id)->get();
            foreach ($appointments as $appointment) {
               if($appointment->doctor_id == $doctor_id){
                  if($appointment->datetime != null){
                     if($appointment->status == 0 && $current_datetime < Carbon::parse($appointment->datetime)){
                        $chat_id = $appointment->conversation_id;
                        $datetime_arr[] = Carbon::parse($appointment->datetime)->format('Y-m-d H:i');
                        $consultation_duration = $appointment->duration_time;
                        $chat_id = $appointment->conversation_id;
                     }
                  }
               }
            }
         }
         if($user->role_id == 4){
            $patient = Client::where('user_id', $user->id)->get()['0'];
            $patient_user = Client::where('user_id', $user->id)->get()['0']->user;
            $patient_id = $patient['id'];
            $appointments = OnlineConsultation::where('patient_id', $patient_id)->get();
            foreach ($appointments as $appointment) {
               if($appointment->patient_id == $patient_id){
                  if($appointment->datetime != null){
                     if($appointment->status == 0 && $current_datetime < Carbon::parse($appointment->datetime)){
                        $datetime_arr[] = Carbon::parse($appointment->datetime)->format('Y-m-d H:i');
                        $consultation_duration = $appointment->duration_time;
                     }
                  }
               }
            }
         }
      }


      if($datetime_arr != null){
         usort($datetime_arr, function($a, $b) {
            $dateTimestamp1 = strtotime($a);
            $dateTimestamp2 = strtotime($b);
            return $dateTimestamp1 < $dateTimestamp2 ? -1: 1;
         });
         foreach ($appointments as $appointment) {
            if(Carbon::parse($appointment->datetime)->format('Y-m-d H:i') == Carbon::parse($datetime_arr[0])->format('Y-m-d H:i')){
               $min_appointment_datetime = Carbon::parse($appointment->datetime)->format('Y-m-d H:i');
               $end_appointment_datetime = Carbon::parse($min_appointment_datetime)->addMinutes($consultation_duration)->format('Y-m-d H:i');
               $notification_timer_1 = Carbon::parse($min_appointment_datetime)->subSeconds(61)->format('Y-m-d H:i:s');
               $notification_timer_2 = Carbon::parse($min_appointment_datetime)->subSeconds(2)->format('Y-m-d H:i:s');
               $chat_id = $appointment->conversation_id;
               $chat_url = '/chat'.'/'.$chat_id;
            }
         }


         $data = ['chat_url' => $chat_url, 'current_datetime'=> $current_datetime,'min_appointment_datetime'=>$min_appointment_datetime, 'end_appointment_datetime'=> $end_appointment_datetime, 'notification_timer_1'=>$notification_timer_1, 'notification_timer_2'=>$notification_timer_2];

      }else{
         $data = false;
      }

      return response()->json($data, 200);

   }
}
