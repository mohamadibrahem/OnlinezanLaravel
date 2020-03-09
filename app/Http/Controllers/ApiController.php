<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Schedule;
use App\Lawyer;
use Auth;
use Carbon\Carbon;
use App\OnlineConsultation;

class ApiController extends Controller
{

   public function timer(Request $request){
      $now_datetime = Carbon::now();
      $data = [];
      $chat_id = request()->chat_id;
      $appointments = OnlineConsultation::all();
      foreach($appointments as $appointment){
         if($appointment->conversation_id == $chat_id){
            $appointment_data = $appointment;
            $appointment_id = $appointment->id;
            $appointment_duration_time = $appointment->time;
            $appointment_datetime = $appointment->datetime;
         }
      }




      $appointment_datetime = Carbon::parse($appointment_datetime);
      $consultation_start = Carbon::parse($now_datetime)->diff($appointment_datetime);
      $consultation_finish = Carbon::parse($appointment_datetime)->addMinutes($appointment_duration_time);
      $data = [
         'now_datetime' => $now_datetime,
         'appointment_datetime' => $appointment_datetime,
         'consultation_start' => $consultation_start,
         'consultation_finish' => $consultation_finish,
      ];
      return response()->json($data, 200);

   }


   public function getSchedule(Request $request)
   {
      $now = Carbon::now();
      $lawyer_id = request()->lawyer_id;
      $consultations = OnlineConsultation::where('lawyer_id', $lawyer_id)->where('datetime','>', $now)->get();
      $schedule = Schedule::where('lawyer_id', $lawyer_id)->where('datetime','>', $now)->get();
      if(count($consultations) != 0){
         $schedule_dates = [];

         foreach ($consultations as $consultation) {
            foreach ($schedule as $sched) {
               if($consultation->datetime != $sched->datetime){
                  $schedule_dates[] = $sched;
               }
            }
         }
         $schedule_dates = array_unique($schedule_dates);
         $collection = collect($schedule_dates)->where('datetime','>', $now);
         $data = $collection;
         return response()->json($data, 200);
      }
      return response()->json($schedule, 200);

   }

}
