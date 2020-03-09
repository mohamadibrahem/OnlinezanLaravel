<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;
// use App\Mail\InviteMail;
use App\Mail\OnlineConsultationMail;
// use App\Mail\InterpretationMail;
// use App\Mail\AppointConsultationMail;
// use App\Mail\AppointmentCancellation;
// use App\Mail\ReceptionCancellation;
// use App\Mail\RegisteredMail;
// use App\Mail\ProfileAcceptedMail;
// use App\Mail\WriteUs;
// use App\Mail\FeedbackMail;
// use App\Mail\ServiceMail;
use Response;
use App\Lawyer;
use App\Client;
use App\OnlineConsultation;
use App\UrgentConsultation;
use App\User;
use Auth;
use Carbon\Carbon;
use App\Mail\ProfileAcceptedMail;

class NotificationController extends Controller
{


   // public function feedback_mail(Request $request){
   //    $this->validate($request, [
   //       'name' => 'required', 'string', 'max:255',
   //       'email' => 'required|string|email|max:255',
   //       'message' => 'required',
   //    ]);
   //    $email = $request->get('email');
   //    $name = $request->get('name');
   //    $title = $request->get('subject');
   //    $message = $request->get('message');
   //    $feedback = ['email' => $email, 'name'=>$name, 'title'=>$title, 'message'=>$message];
   //    Mail::to('help@1430.kz')->send(new FeedbackMail($feedback));
   //    return redirect()->back()->with('message', 'Заявка успешно отправлено!');
   // }

   public function profile_accept($email, $phone){
      // $notification = '';
      // Mail::to($email)->send(new ProfileAcceptedMail($notification));
      $username='astservisplus1';
      $password='9XSsTvvKi';
      $url = 'http://kazinfoteh.org:9507';
      $params = [
         'action' => 'sendmessage',
         'messagetype' => 'SMS',
         'username' => $username,
         'password' => $password,
         'originator'=> 'onlinezan.kz',
         'recipient' => $phone,
         'messagedata'=> "Vash profıl aktıvırovan na portale onlinezan.kz.",
      ];
      $ch = curl_init($url);
      curl_setopt($ch, CURLOPT_HEADER, 1);
      curl_setopt($ch, CURLOPT_TIMEOUT, 30);
      curl_setopt($ch, CURLOPT_POST, 1);
      curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
      $data = curl_exec($ch);
      curl_close($ch);
   }


   public function registered($email, $phone, $fullname){
      // $notification = ' ';
      // Mail::to($email)->send(new RegisteredMail($notification));

      // $data = ['fullname' => $fullname, 'phone' => $phone];

      // Mail::send('emails/registered_to_admin', compact('data'), function ($message) use($data){
      //    $message->to('help@1430.kz')->subject('Новый пользователь на портале onlinezan.kz');
      // });
      //
      // Mail::send('emails/registered_to_admin', compact('data'), function ($message) use($data){
      //    $message->to('help@1430.kz')->subject('Новый пользователь на портале onlinezan.kz');
      // });

      $username='astservisplus1';
      $password='9XSsTvvKi';
      $url = 'http://kazinfoteh.org:9507';
      $params = [
         'action' => 'sendmessage',
         'messagetype' => 'SMS',
         'username' => $username,
         'password' => $password,
         'originator'=> 'zanonline',
         'recipient' => $phone,
         'messagedata'=> "Blagodarim vas za registrasiyu na portale onlinezan.kz. Vash profıl budet aktıvırovan v techenıı 48 chasov.",
      ];
      $ch = curl_init($url);
      curl_setopt($ch, CURLOPT_HEADER, 1);
      curl_setopt($ch, CURLOPT_TIMEOUT, 30);
      curl_setopt($ch, CURLOPT_POST, 1);
      curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
      $data = curl_exec($ch);
      curl_close($ch);
   }

   public function OnlineConsultation($lawyer_id,$client_id,$datetime) {
      function translit($s) {
         $s = (string) $s; // преобразуем в строковое значение
         $s = trim($s); // убираем пробелы в начале и конце строки
         $s = function_exists('mb_strtolower') ? mb_strtolower($s) : strtolower($s); // переводим строку в нижний регистр (иногда надо задать локаль)
         $s = strtr($s, array('а'=>'a','б'=>'b','в'=>'v','г'=>'g','д'=>'d','е'=>'e','ё'=>'e','ж'=>'j','з'=>'z','и'=>'i','й'=>'y','к'=>'k','л'=>'l','м'=>'m','н'=>'n','о'=>'o','п'=>'p','р'=>'r','с'=>'s','т'=>'t','у'=>'u','ф'=>'f','х'=>'h','ц'=>'c','ч'=>'ch','ш'=>'sh','щ'=>'shch','ы'=>'y','э'=>'e','ю'=>'yu','я'=>'ya','ъ'=>'','ь'=>'', 'ұ'=>'u', 'ү'=>'ú', 'ә'=>'á', 'і'=>'i', 'һ'=>'h', 'қ'=>'q'));
         return $s; // возвращаем результат
      }
      $consult_datetiime = Carbon::parse($datetime)->format('H:i') . '  ' . Carbon::parse($datetime)->format('d/m');

      $lawyer = Lawyer::where('id', $lawyer_id)->get();
      foreach ($lawyer as $key => $value) {
         $lawyer = $value;
      }
      $client = Client::where('id', $client_id)->get();
      foreach ($client as $key => $value) {
         $client = $value;
      }
      $lawyer_fullname = $lawyer['user']['lastname'].' '.mb_substr($lawyer['user']['firstname'],0,1,'UTF-8');
      $client_fullname = $client['user']['lastname'].' '.mb_substr($client['user']['firstname'],0,1,'UTF-8');

      $commentLawyer = 'К вам на онлайн консультацию записался(лась) '.$client_fullname . '.' . ' в '.$consult_datetiime . ' Наш инстаграм @1430.kz.сайт http://www.1430.kz';
      $commentClient = 'Вы записались на онлайн консультацию к врачу '.$lawyer_fullname . '.' . ' в '.$consult_datetiime. ' Наш инстаграм @1430.kz сайт http://www.1430.kz';
      // Mail::to($client['user']['email'])->send(new OnlineConsultationMail($commentClient));
      // Mail::to($lawyer['user']['email'])->send(new OnlineConsultationMail($commentLawyer));

      $translit_client_name = translit(ucfirst($client_fullname));
      $client_convert = mb_convert_case($translit_client_name, MB_CASE_TITLE, "UTF-8");

      $translit_lawyer_name = translit(ucfirst($lawyer_fullname));
      $lawyer_convert = mb_convert_case($translit_lawyer_name, MB_CASE_TITLE, "UTF-8");

      $username='astservisplus1';
      $password='9XSsTvvKi';
      $url = 'http://kazinfoteh.org:9507';
      $params_client = [
         'action' => 'sendmessage',
         'messagecount' => 2,
         'username' => $username,
         'password' => $password,
         'originator'=> 'zanger',
         'messagetype' => 'SMS:TEXT',
         'recipient' => $client['user']['phone'],
         'sendondate' => Carbon::now(),
         'messagedata'=> 'Vy zapisany na online konsultasiyu k uristu ' . $lawyer_convert . '. v ' . $consult_datetiime,
      ];

      $params_lawyer = [
         'action' => 'sendmessage',
         'messagecount' => 2,
         'username' => $username,
         'password' => $password,
         'originator'=> 'zanger',
         'messagetype' => 'SMS:TEXT',
         'sendondate' => Carbon::now(),
         'recipient' => $lawyer['user']['phone'],
         'messagedata'=> 'K vam na online konsultaciyu zapisan ' . $client_convert . '. v ' . $consult_datetiime,
      ];

      $ch = curl_init($url);
      curl_setopt($ch, CURLOPT_HEADER, 1);
      curl_setopt($ch, CURLOPT_TIMEOUT, 30);
      curl_setopt($ch, CURLOPT_POST, 1);
      curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params_client));
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
      $data = curl_exec($ch);
      curl_close($ch);

      $ch = curl_init($url);
      curl_setopt($ch, CURLOPT_HEADER, 1);
      curl_setopt($ch, CURLOPT_TIMEOUT, 30);
      curl_setopt($ch, CURLOPT_POST, 1);
      curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params_lawyer));
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
      $data = curl_exec($ch);
      curl_close($ch);
   }

   public function UrgentConsultation($lawyer_id,$client_id) {
      function translit($s) {
         $s = (string) $s; // преобразуем в строковое значение
         $s = trim($s); // убираем пробелы в начале и конце строки
         $s = function_exists('mb_strtolower') ? mb_strtolower($s) : strtolower($s); // переводим строку в нижний регистр (иногда надо задать локаль)
         $s = strtr($s, array('а'=>'a','б'=>'b','в'=>'v','г'=>'g','д'=>'d','е'=>'e','ё'=>'e','ж'=>'j','з'=>'z','и'=>'i','й'=>'y','к'=>'k','л'=>'l','м'=>'m','н'=>'n','о'=>'o','п'=>'p','р'=>'r','с'=>'s','т'=>'t','у'=>'u','ф'=>'f','х'=>'h','ц'=>'c','ч'=>'ch','ш'=>'sh','щ'=>'shch','ы'=>'y','э'=>'e','ю'=>'yu','я'=>'ya','ъ'=>'','ь'=>'', 'ұ'=>'u', 'ү'=>'ú', 'ә'=>'á', 'і'=>'i', 'һ'=>'h', 'қ'=>'q'));
         return $s; // возвращаем результат
      }

      $lawyer = Lawyer::where('id', $lawyer_id)->get();
      foreach ($lawyer as $key => $value) {
         $lawyer = $value;
      }
      $client = Client::where('id', $client_id)->get();
      foreach ($client as $key => $value) {
         $client = $value;
      }
      $lawyer_fullname = $lawyer['user']['lastname'].' '.mb_substr($lawyer['user']['firstname'],0,1,'UTF-8');
      $client_fullname = $client['user']['lastname'].' '.mb_substr($client['user']['firstname'],0,1,'UTF-8');

      // $commentLawyer = 'К вам на онлайн консультацию записался(лась) '.$client_fullname . '.' . ' в '.$consult_datetiime . ' Наш инстаграм @1430.kz.сайт http://www.1430.kz';
      // $commentClient = 'Вы записались на онлайн консультацию к врачу '.$lawyer_fullname . '.' . ' в '.$consult_datetiime. ' Наш инстаграм @1430.kz сайт http://www.1430.kz';
      // Mail::to($client['user']['email'])->send(new OnlineConsultationMail($commentClient));
      // Mail::to($lawyer['user']['email'])->send(new OnlineConsultationMail($commentLawyer));

      $translit_client_name = translit(ucfirst($client_fullname));
      $client_convert = mb_convert_case($translit_client_name, MB_CASE_TITLE, "UTF-8");

      $translit_lawyer_name = translit(ucfirst($lawyer_fullname));
      $lawyer_convert = mb_convert_case($translit_lawyer_name, MB_CASE_TITLE, "UTF-8");

      $username='astservisplus1';
      $password='9XSsTvvKi';
      $url = 'http://kazinfoteh.org:9507';
      $params_client = [
         'action' => 'sendmessage',
         'messagecount' => 2,
         'username' => $username,
         'password' => $password,
         'originator'=> 'zanger',
         'messagetype' => 'SMS:TEXT',
         'recipient' => $client['user']['phone'],
         'sendondate' => Carbon::now(),
         'messagedata'=> 'vy otpravili zayavku na srochnuyu konsultaciyu k yuristu ' . $lawyer_convert,
      ];

      $params_lawyer = [
         'action' => 'sendmessage',
         'messagecount' => 2,
         'username' => $username,
         'password' => $password,
         'originator'=> 'zanger',
         'messagetype' => 'SMS:TEXT',
         'sendondate' => Carbon::now(),
         'recipient' => $lawyer['user']['phone'],
         'messagedata'=> 'k vam na srochnuyu konsultaciyu otpravil zayavku ' . $client_convert,
      ];

      $ch = curl_init($url);
      curl_setopt($ch, CURLOPT_HEADER, 1);
      curl_setopt($ch, CURLOPT_TIMEOUT, 30);
      curl_setopt($ch, CURLOPT_POST, 1);
      curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params_client));
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
      $data = curl_exec($ch);
      curl_close($ch);

      $ch = curl_init($url);
      curl_setopt($ch, CURLOPT_HEADER, 1);
      curl_setopt($ch, CURLOPT_TIMEOUT, 30);
      curl_setopt($ch, CURLOPT_POST, 1);
      curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params_lawyer));
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
      $data = curl_exec($ch);
      curl_close($ch);
   }

}
