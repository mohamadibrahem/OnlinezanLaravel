<?php

namespace App\Http\Controllers;

use App\OnlineConsultation;
use App\Client;
use App\Lawyer;
use App\Conversation;
use App\ConsultationFile;
use App\Schedule;
use App\Service;
use File;
use Auth;
use Slug;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ConsultationNotificationController;

class OnlineConsultationController extends Controller
{
   /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
   public function index()
   {
      $consultations = OnlineConsultation::all();
      $clients = Client::all();
      $lawyers = Lawyer::all();
      $now_datetime = Carbon::now();
      if(Auth::check()){
         $user = Auth::user();
         $userrole = $user->role_id;
      }else{
         $user = '';
         $userrole = '';
      }

      $lawyerid = '';
      foreach($lawyers as $item){
         if($user->id == $item->user_id){
            $lawyerid = $item->id;
         }
      }

      $clientid = '';
      foreach($clients as $item){
         if($user->id == $item->user_id){
            $clientid = $item->id;
         }
      }

      $coming_consultations = [];
      $completed_consultations = [];


      foreach ($consultations as $value) {
         if($user->role_id == 3){
            if($value->lawyer_id == $lawyerid){
               if($value->status == 'accepted' && $now_datetime < Carbon::parse($value->datetime)->addMinutes($value->time)->format('Y-m-d H:i:s')){
                  $value->datetime = Carbon::parse($value->datetime)->format('Y-m-d H:i');
                  $coming_consultations[] = $value;
               }

               if($value->status == 'completed'){
                  $completed_consultations[] = $value;
               }

            }
         }
         elseif($user->role_id == 4){
            if($value->client_id == $clientid){
               if($value->status == 'accepted' && $now_datetime < Carbon::parse($value->datetime)->addMinutes($value->time)->format('Y-m-d H:i:s')){
                  $coming_consultations[] = $value;
               }
               if($value->status == 'completed'){
                  $completed_consultations[] = $value;
               }
            }
         }
      }



      $coming_consultations = collect($coming_consultations)->all();
      $completed_consultations = collect($completed_consultations)->all();

      if(Auth::user()->role_id == 3){
         $notification = new ConsultationNotificationController;
         $notification->online_update($lawyerid);
      }
      return view('inner_page.online_consultations.index', compact('coming_consultations', 'completed_consultations', 'now_datetime'));
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

      $this->validate($request, [
         'date' => 'required',
         'time' => 'required'
      ]);

      $lawyers = lawyer::all();
      $clients = Client::all();
      $datetime = $request->get('datetime');
      $lawyer_id = $request->get('lawyer_id');
      $schedules = Schedule::all();

      $second_user_id = '';
      $price;
      $consultation_time = 15;
      $datetime = $request->get('datetime');
      foreach($lawyers as $item){
         if($item->id == $lawyer_id){
            $second_user_id = $item->user_id;
            $price = $item->online_consultation_price;
            $consultation_time = $item->consultation_time;
         }
      }
      $first_user_id = '';
      $client_id;
      foreach($clients as $item){
         if($item->user_id == Auth::user()->id){
            $first_user_id = $item->user_id;
            $client_id = $item->id;
         }
      }



      $conversation = new Conversation([
         'first_user_id' => $first_user_id,
         'second_user_id' => $second_user_id,
      ]);

      $conversation->save();

      if($conversation->save()){

         $consultation = new OnlineConsultation([
            'lawyer_id' => $lawyer_id,
            'client_id'=> $client_id,
            'datetime' => $datetime,
            'status' => 'accepted',
            'conversation_id' => $conversation->id,
            'time' => $consultation_time,
            'price' => $price,
            'comment' => $request->get('comment'),
            'payment_id' => $request->get('payment_id'),
         ]);


         $consultation->save();
         if($consultation->save()){
            $consultation_id = $consultation->id;
         }
         foreach($schedules as $schedule){
            if($schedule->id == $consultation->schedule_id){
               $schedule->delete();
            }
         }

         $request->validate([
            'consultation_files' => 'mimes:doc,docx,pdf,jpeg,jpg,png','max:4000',
         ]);

         $upload_files = $request->file();
         foreach ($upload_files as $file) {
            foreach ($file as $f) {
               $forigname = $f->getClientOriginalName();
               $filename = pathinfo($forigname, PATHINFO_FILENAME);
               $extension = pathinfo($forigname, PATHINFO_EXTENSION);
               $ftname = Slug::make($filename);
               $fname = time().'_'.$ftname.'.'.$extension;
               $f->move(public_path('uploads/consultation_files'), $fname);
               $files = new ConsultationFile([
                  'consultation_id' => $consultation->id,
                  'user_id' => Auth::user()->id,
                  'filename' => $fname,
                  'original_name' => $filename,
               ]);
               $files->save();
            }
         }

         $notification = new NotificationController;
         $notification->OnlineConsultation($lawyer_id, $client_id, $datetime);

         $notification2 = new ConsultationNotificationController;
         $notification2->online_store($lawyer_id, $consultation_id);
      }
      return redirect('/online_consultations');
   }

   /**
   * Display the specified resource.
   *
   * @param  \App\OnlineConsultation  $onlineConsultation
   * @return \Illuminate\Http\Response
   */
   public function show(OnlineConsultation $onlineConsultation)
   {
      //
   }


   public function detail(OnlineConsultation $consultation)
   {
      $services = Service::orderBy('name', 'asc')->get();
      $lawyer = Lawyer::where('id', $consultation->lawyer_id)->get()['0'];
      $client = Client::where('id', $consultation->client_id)->get()['0'];
      $client_uid = $client->user_id;
      $datetime = Carbon::now();
      $files = [];
      if(Auth::user()->role_id == 4){
         $consultation_files = ConsultationFile::where('consultation_id', $consultation->id)->get();
         $days = Auth::user()->client['date_storage'];
         foreach ($consultation_files as $file) {
            $date_expiration = new Carbon($file->created_at);
            $end = Carbon::parse($date_expiration)->addDays($days);
            $end = $end->format('Y-m-d');
            if($datetime->format('Y-m-d') < $end){
               $files[] = $file;
            }else{
               $file->delete();
            }
         }
      }

      $data = [
         'consultation' => $consultation,
         'services' => $services,
         'lawyer' => $lawyer,
         'files' => $files
      ];
      return view('inner_page.online_consultations.detail', compact('data'));
   }

   /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\OnlineConsultation  $onlineConsultation
   * @return \Illuminate\Http\Response
   */
   public function edit(OnlineConsultation $onlineConsultation)
   {
      //
   }

   /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\OnlineConsultation  $onlineConsultation
   * @return \Illuminate\Http\Response
   */
   public function update(Request $request, $consultation)
   {
      $consultation = OnlineConsultation::find($consultation);
      $consultation->update([
         'status' => 'completed'
      ]);
      return response()->json($consultation ,200);
   }

   public function consultation_delete(OnlineConsultation $consultation){
      $consultation->update([
         'status' => 'cancelled'
      ]);
      $consultation_id = $consultation->id;
      // $consultation_cancellation = new NotificationController;
      // $consultation_cancellation->consultationCancellation($appointment_id);

      return back();
   }

   /**
   * Remove the specified resource from storage.
   *
   * @param  \App\OnlineConsultation  $onlineConsultation
   * @return \Illuminate\Http\Response
   */
   public function destroy(OnlineConsultation $onlineConsultation)
   {
      //
   }
}
