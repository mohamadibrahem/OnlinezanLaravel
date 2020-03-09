<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Service;
use App\Lawyer;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use Auth;
use App\UrgentConsultation;
use App\ApplicationConsultation;
use App\ConsultationNotification;

class ComposerServiceProvider extends ServiceProvider
{
   /**
   * Bootstrap services.
   *
   * @return void
   */

   public function boot()
   {

      View::composer('main_page.index', function($view) {
         $services = Service::orderBy('weight', 'asc')->get();
         $lawyers = Lawyer::where('status', 'accepted')->where('specialization_id', '!=', null)->get();

         $view->with([
            'services' => $services,
            'lawyers' => $lawyers,
         ]);
      });


      View::composer('layouts.header', function($view) {
         $services = Service::all();
         if(Auth::check()){
            if(Auth::user()->role_id == 3){
               $lawyer_id = Auth::user()->lawyer['id'];
               $application_notification = ConsultationNotification::where('status', 0)->where('lawyer_id', $lawyer_id)->where('type', 'application')->get();
               $count_application_consultation = 0;
               foreach ($application_notification as $key => $value) {
                  $count_application_consultation += $value->message_count;
               }

               $urgent_notification = ConsultationNotification::where('status', 0)->where('lawyer_id', $lawyer_id)->where('type', 'urgent')->get();
               $count_urgent_consultation = 0;
               foreach ($urgent_notification as $key => $value) {
                  $count_urgent_consultation += $value->message_count;
               }

               $online_notification = ConsultationNotification::where('status', 0)->where('lawyer_id', $lawyer_id)->where('type', 'online')->get();
               $count_online_consultation = 0;
               foreach ($online_notification as $key => $value) {
                  $count_online_consultation += $value->message_count;
               }

            }else{
               $count_urgent_consultation = '';
               $count_online_consultation = '';
               $count_application_consultation = '';
            }
         }else{
            $count_online_consultation = '';
            $count_urgent_consultation = '';
            $count_application_consultation = '';
         }
         $view->with([
            'services' => $services,
            'count_urgent_consultation' => $count_urgent_consultation,
            'count_application_consultation' => $count_application_consultation,
            'count_online_consultation' => $count_online_consultation
         ]);
      });

      View::composer('layouts.footer_front', function($view) {
         $services = Service::all();

         $view->with([
            'services' => $services,
         ]);
      });
      View::composer('layouts.footer_not_front', function($view) {
         $services = Service::all();

         $view->with([
            'services' => $services,
         ]);
      });
   }

   /**
   * Register services.
   *
   * @return void
   */
   public function register()
   {
      //
   }
}
