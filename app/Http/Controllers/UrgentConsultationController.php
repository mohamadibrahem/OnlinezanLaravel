<?php

namespace App\Http\Controllers;

use App\UrgentConsultation;
use Illuminate\Http\Request;
use Auth;
use App\Lawyer;
use App\Client;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ConsultationNotificationController;
use Carbon\Carbon;

class UrgentConsultationController extends Controller
{
   /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
   public function index()
   {
      if(Auth::check()){
         if(Auth::user()->role_id == 3){
            $lawyer_id = Auth::user()->lawyer['id'];
            $consultations_open = UrgentConsultation::where('status', 'new')->where('lawyer_id', $lawyer_id)->orderBy('created_at')->get();
            $consultations_close = UrgentConsultation::where('status', 'success')->where('lawyer_id', $lawyer_id)->orderBy('created_at', 'desc')->get();
            $notification = new ConsultationNotificationController;
            $lawyerid = $lawyer_id;
            $notification->urgent_update($lawyerid);
         }
         if(Auth::user()->role_id == 4){
            $client_id = Auth::user()->client['id'];
            $consultations_open = UrgentConsultation::where('status', 'new')->where('client_id', $client_id)->orderBy('created_at')->get();
            $consultations_close = UrgentConsultation::where('status', 'success')->where('client_id', $client_id)->orderBy('created_at', 'desc')->get();
         }
      }



      return view('inner_page.urgent_consultations.index', compact('consultations_close', 'consultations_open'));
   }


   public function description($consultation)
   {
      $consultations = UrgentConsultation::find($consultation);
      return $consultations->description;

   }

   public function conclusion_post(Request $request, $consultation)
   {
      $consultations = UrgentConsultation::find($consultation);
      $consultations->conclusion = $request->get('conclusion');
      $consultations->npa = json_encode($request->get('npa'));
      $consultations->save();
      return view('inner_page.urgent_consultations.conclusion', compact('consultations'));

   }

   public function conclusion_get($consultation)
   {
      $consultations = UrgentConsultation::find($consultation);
      return view('inner_page.urgent_consultations.conclusion', compact('consultations'));

   }


   public function success(Request $request, $consultation)
   {
      $consultations = UrgentConsultation::find($consultation);
      $consultations->status = 'success';
      $consultations->closing_datetime = Carbon::now();
      $consultations->save();
      return redirect()->back();
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
      $clients = Client::where('user_id', Auth::user()->id)->get()['0'];
      $client_id = $clients['id'];
      $client_phone = $clients->user['phone'];
      $lawyer_id = $request->get('urgent_lawyer_id');
      $consultation = UrgentConsultation::create([
         'status' => 'new',
         'client_id' => $client_id,
         'client_phone' => $client_phone,
         'lawyer_id' => $lawyer_id,
         'description' => $request->get('description'),
         'received_datetime' => Carbon::now()
      ]);

      if($consultation){
         $lawyer_id = $consultation->lawyer_id;
         $consultation_id = $consultation->id;
         $notification = new NotificationController;
         $notification->UrgentConsultation($lawyer_id, $client_id);

         $notification2 = new ConsultationNotificationController;
         $notification2->urgent_store($lawyer_id, $consultation_id);
      }
      // }

      return redirect()->back();
   }

   /**
   * Display the specified resource.
   *
   * @param  \App\UrgentConsultation  $urgentConsultation
   * @return \Illuminate\Http\Response
   */
   public function show(UrgentConsultation $urgentConsultation)
   {
      //
   }

   /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\UrgentConsultation  $urgentConsultation
   * @return \Illuminate\Http\Response
   */
   public function edit(UrgentConsultation $urgentConsultation)
   {
      //
   }

   /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\UrgentConsultation  $urgentConsultation
   * @return \Illuminate\Http\Response
   */
   public function update(Request $request, UrgentConsultation $urgentConsultation)
   {
      //
   }

   public function consultation_delete(UrgentConsultation $consultation){
      $consultation->update([
         'status' => 'cancelled',
      ]);
      // $consultation_id = $consultation->id;
      // $consultation_cancellation = new NotificationController;
      // $consultation_cancellation->consultationCancellation($appointment_id);

      return back();
   }

   /**
   * Remove the specified resource from storage.
   *
   * @param  \App\UrgentConsultation  $urgentConsultation
   * @return \Illuminate\Http\Response
   */
   public function destroy(UrgentConsultation $urgentConsultation)
   {
      //
   }
}
