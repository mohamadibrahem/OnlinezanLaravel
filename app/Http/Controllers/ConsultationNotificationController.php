<?php

namespace App\Http\Controllers;

use App\ConsultationNotification;
use Illuminate\Http\Request;
use Auth;
use App\ApplicationConsultation;
use App\Lawyer;
use App\User;
use Brian2694\Toastr\Facades\Toastr;

use Notification;
use App\Notifications\NewApplication;
use App\Events\NotificationViewed;
use Pusher\Pusher;

use Illuminate\Support\Facades\Redis;

class ConsultationNotificationController extends Controller
{
   /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
   public function index()
   {
      //
   }

   public function showProfile()
   {
      $id = Auth::user()->id;
      $user = Redis::get('user:profile:'.$id);

      return $user;
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
   public function application_store($lawyer_id, $consultation_id)
   {
      if(Auth::check()){
         $user = Auth::user();
         $notification = ConsultationNotification::create([
            'lawyer_id' => $lawyer_id,
            'consultation_id' => $consultation_id,
            'type' => 'application',
            'status' => 0,
            'message_count' => 1,
         ]);
         if($notification){
            $lawyer = Lawyer::where('id',$notification->lawyer_id)->get()['0'];
            $lawyer_name = $lawyer->user['lastname']. ' ' .$lawyer->user['firstname'];
            Toastr::success("Заявка назначена юристу : $lawyer_name");

            // Notification::send($user, new NewApplication($toastr));

            // $options = array(
            //    'cluster' => env('PUSHER_APP_CLUSTER'),
            //    'encrypted' => true
            // );
            // $pusher = new Pusher(
            //    env('PUSHER_APP_KEY'),
            //    env('PUSHER_APP_SECRET'),
            //    env('PUSHER_APP_ID'),
            //    $options
            // );
            //
            // $data['message'] = "<a href='/applications'>У вас новая заявка по консультации</a>";
            // $pusher->trigger('notify-channel', 'App\\Events\\NotificationViewed', $data);
         }
      }else{
         $user = '';
      }
   }

   public function urgent_store($lawyer_id, $consultation_id)
   {
      if(Auth::check()){
         $user = Auth::user();
         $notification = ConsultationNotification::create([
            'lawyer_id' => $lawyer_id,
            'consultation_id' => $consultation_id,
            'type' => 'urgent',
            'status' => 0,
            'message_count' => 1,
         ]);
      }else{
         $user = '';
      }
   }


   public function online_store($lawyer_id, $consultation_id)
   {
      if(Auth::check()){
         $user = Auth::user();
         $notification = ConsultationNotification::create([
            'lawyer_id' => $lawyer_id,
            'consultation_id' => $consultation_id,
            'type' => 'online',
            'status' => 0,
            'message_count' => 1,
         ]);
      }else{
         $user = '';
      }
   }

   public function application_change_status()
   {

   }

   /**
   * Display the specified resource.
   *
   * @param  \App\ConsultationNotification  $consultationNotification
   * @return \Illuminate\Http\Response
   */
   public function show(ConsultationNotification $consultationNotification)
   {
      //
   }

   /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\ConsultationNotification  $consultationNotification
   * @return \Illuminate\Http\Response
   */
   public function edit(ConsultationNotification $consultationNotification)
   {
      //
   }

   /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\ConsultationNotification  $consultationNotification
   * @return \Illuminate\Http\Response
   */
   public function application_update($lawyerid)
   {
      if(Auth::check()){
         $user = Auth::user();
         $notifications = ConsultationNotification::where('lawyer_id', $lawyerid)->where('status', 0)->where('type','application')->get();
         foreach ($notifications as $key => $value) {
            $value->update([
               'status' => 1,
            ]);
         }

      }else{
         $user = '';
      }
   }

   public function urgent_update($lawyerid)
   {
      if(Auth::check()){
         $user = Auth::user();
         $notifications = ConsultationNotification::where('lawyer_id', $lawyerid)->where('status', 0)->where('type','urgent')->get();
         foreach ($notifications as $key => $value) {
            $value->update([
               'status' => 1,
            ]);
         }
      }else{
         $user = '';
      }
   }

   public function online_update($lawyerid)
   {
      if(Auth::check()){
         $user = Auth::user();
         $notifications = ConsultationNotification::where('lawyer_id', $lawyerid)->where('status', 0)->where('type','online')->get();
         if(count($notifications) != 0){
            foreach ($notifications as $key => $value) {
               $value->update([
                  'status' => 1,
               ]);
            }
         }
      }else{
         $user = '';
      }
   }

   /**
   * Remove the specified resource from storage.
   *
   * @param  \App\ConsultationNotification  $consultationNotification
   * @return \Illuminate\Http\Response
   */
   public function destroy(ConsultationNotification $consultationNotification)
   {
      //
   }
}
