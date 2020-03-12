<?php

namespace App\Http\Controllers;

use App\Lawyer;
use App\Service;
use App\Experience;
use App\Education;
use Auth;
use App\Schedule;
use App\ConsultationNotification;

use Illuminate\Http\Request;

class LawyerController extends Controller
{
   /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
   public function index()
   {
      $lawyers = Lawyer::where('status', 'accepted')->where('specialization_id', '!=', null)->get();
      $specializations = Service::all();
      $data = [
         'lawyers' => $lawyers,
         'specializations' => $specializations,
      ];

      #dd($data);

      return view('inner_page.lawyers.index', compact('data'));
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
      //
   }

   /**
   * Display the specified resource.
   *
   * @param  \App\Lawyer  $lawyer
   * @return \Illuminate\Http\Response
   */

   public function info(Lawyer $lawyer, Request $request)
   {
      $lawyer_id = request()->lawyer_id;


      $lawyer = Lawyer::where('status', 'accepted')->where('specialization_id', '!=', null)->where('id', $lawyer_id)->get()['0'];
      $lawyer_fullname = $lawyer->user['lastname'].' '.$lawyer->user['firstname'];
      $lawyer_price = $lawyer->urgent_consultation_price;
      $data = [
         'lawyer_fullname' => $lawyer_fullname,
         'lawyer_price' => $lawyer_price
      ];

      return response()->json($data, 200);
   }

   public function online_time(Request $request, Lawyer $lawyer){
      if(Auth::user()->role_id == 3){
         $lawyer = Lawyer::find(Auth::user()->lawyer['id']);
         $lawyer->consultation_time = $request->get('duration_time');
         $lawyer->save();

         $schedules = Schedule::all();
         foreach($schedules as $schedule){
            if($lawyer->id == $schedule->lawyer_id){
               $schedule->delete();
            }
         }
         return back();
      }
   }


   public function show(Lawyer $lawyer)
   {
   
      $experiences = Experience::where('lawyer_id', $lawyer->id)->get();

      $online_consultation = ConsultationNotification::where('lawyer_id', $lawyer->id)->where('type', 'online')->get();
      $urgent_consultation = ConsultationNotification::where('lawyer_id', $lawyer->id)->where('type', 'urgent')->get();      

      $online_consultation = count($online_consultation);
      $urgent_consultation = count($urgent_consultation);

      $education = Education::where('lawyer_id', $lawyer->id)->get();
      $specializations = Service::all();
      // $lawyer = $lawyer->where('status', 'accepted')->get();
      $data = [
         'lawyer' => $lawyer,
         'experience' => $experiences,
         'education' => $education,
         'specializations' => $specializations,
      ];

      return view('inner_page.lawyers.show', compact('data', 'online_consultation', 'urgent_consultation'));
   }

   /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Lawyer  $lawyer
   * @return \Illuminate\Http\Response
   */
   public function edit(Lawyer $lawyer)
   {
      //
   }

   /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Lawyer  $lawyer
   * @return \Illuminate\Http\Response
   */
   public function update(Request $request, Lawyer $lawyer)
   {
      //
   }

   /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Lawyer  $lawyer
   * @return \Illuminate\Http\Response
   */
   public function destroy(Lawyer $lawyer)
   {
      //
   }
}
