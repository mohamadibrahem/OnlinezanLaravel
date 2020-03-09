<?php

namespace App\Http\Controllers;

use App\Schedule;
use Illuminate\Http\Request;
use Auth;
use App\Lawyer;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Carbon\CarbonPeriod;

class ScheduleController extends Controller
{
   /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
   public function index()
   {
      if(Auth::check()){
         $user = Auth::user();
         if($user->role_id == 3){
            $now = Carbon::now();
            $lawyers = Lawyer::where('user_id', $user->id)->get();
            foreach ($lawyers as $item) {
               $lawyer = $item;
            }
            $consultation_time = $lawyer->consultation_time;
            if($consultation_time == ''){
               $consultation_time = 15;
            }
            $schedules = Schedule::all();

            $start = Carbon::parse("07:00");
            $end = Carbon::parse("24:00");
            $interval =  CarbonInterval::fromString($consultation_time.'m');
            $times = CarbonPeriod::create($start, $interval, $end);
            $range = [];
            foreach ($times as $time) {
               $range[] = Carbon::parse($time)->format('H:i');
            }

            $data = [
               'lawyer' => $lawyer,
               'schedules' => $schedules,
               'time' => $consultation_time,
               'range' => $range,
            ];

            return view('inner_page.schedules.index', compact('data'));
         }
      }

   }

   /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
   public function create()
   {
      //
   }

   /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
   public function store(Request $request)
   {
      $user = Auth::user();
      $lawyers = Lawyer::all();
      $lawyer_id = '';
      foreach($lawyers as $lawyer){
         if($lawyer->user_id == $user->id){
            $lawyer_id = $lawyer->id;
         }
      }

      $time = $request->get('time_schedule');
      $date = $request->get('date_schedule');

      function process($data)
      {
         $entries = array();
         $filteredData = $data;
         if (preg_match_all("/\(([^)]*)\)/", $data, $matches)) {
            $entries = $matches[0];
            $filteredData = preg_replace("/\(([^)]*)\)/", "-placeholder-", $data);
         }
         $arr = array_map("trim", explode(",", $filteredData));
         if (!$entries) {
            return $arr;
         }
         $j = 0;
         foreach ($arr as $i => $entry) {
            if ($entry != "-placeholder-") {
               continue;
            }
            $arr[$i] = $entries[$j];
            $j++;
         }
         return $arr;
      }

      $time_str = $time;
      $time_arr = process($time_str);
      $date_str = $date.' ';
      $datetime_array = preg_filter('/^/', $date_str, $time_arr);

      $schedules = Schedule::all();

      foreach($datetime_array as $datetime){
         if(substr($datetime, 11,14) != ''){
            $schedule = new Schedule([
               'lawyer_id' => $lawyer_id,
               'datetime' => $datetime,
            ]);
            $schedule->save();
         }
      }

      foreach($schedules as $sched){
         if($sched->lawyer_id == $lawyer_id){
            foreach($datetime_array as $datetime1){
               if(substr($sched->datetime, 0, 10) == substr($datetime1, 0, 10)){
                  $sched->delete();
               }
            }
         }
      }
   }

   /**
   * Display the specified resource.
   *
   * @param  \App\Schedule  $schedule
   * @return \Illuminate\Http\Response
   */
   public function show(Schedule $schedule)
   {
      //
   }

   /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Schedule  $schedule
   * @return \Illuminate\Http\Response
   */
   public function edit(Schedule $schedule)
   {
      //
   }

   /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Schedule  $schedule
   * @return \Illuminate\Http\Response
   */
   public function update(Request $request, Schedule $schedule)
   {
      //
   }

   /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Schedule  $schedule
   * @return \Illuminate\Http\Response
   */
   public function destroy(Schedule $schedule)
   {
      //
   }
}
