<?php

namespace App\Http\Controllers;

use App\ApplicationConsultation;
use Illuminate\Http\Request;
use Storage;
use File;
use Auth;
use App\Lawyer;
use Carbon\Carbon;
use App\Http\Controllers\ConsultationNotificationController;
use Slug;

class ApplicationConsultationController extends Controller
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
         $userrole = $user->role_id;
         $now_datetime = Carbon::now();

         $lawyers = Lawyer::all();
         $lawyerid = '';
         foreach($lawyers as $item){
            if($user->id == $item->user_id){
               $lawyerid = $item->id;
            }
         }
         $consultations = ApplicationConsultation::all();
         $consultations_open = ApplicationConsultation::where('status_id', 3)->where('lawyer_id', $lawyerid)->get();
         $consultations_close = ApplicationConsultation::where('status_id', 4)->where('lawyer_id', $lawyerid)->get();

         $consultations_all = [];

         foreach ($consultations as $value) {
            if($user->role_id == 3){
               if($value->lawyer_id == $lawyerid){
                  $consultations_all[] = $value;
               }
            }
         }
         $consultations = collect($consultations_all)->sortByDesc('created_at')->all();
         if(Auth::user()->role_id == 3){
            $notification = new ConsultationNotificationController;
            $notification->application_update($lawyerid);
         }
      }else{
         $user = '';
         $userrole = '';
      }


      return view('inner_page.applications.index', compact('consultations', 'consultations_open', 'consultations_close'));
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
         'client_name' => 'required', 'string', 'max:255',
         'client_phone' => 'required', 'string', 'max:255',
         'client_email' => 'required|string|email|max:255',
         'service' => 'required',
      ]);
      $files = $request->file('application_file');
      $files_arr = [];
      if($request->hasFile('application_file')) {
         foreach ($files as $file) {
            $forigname = $file->getClientOriginalName();
            $filename = pathinfo($forigname, PATHINFO_FILENAME);
            $extension = pathinfo($forigname, PATHINFO_EXTENSION);
            $slug_name = Slug::make($filename);
            $fname = time().'_'.$slug_name.'.'.$extension;
            $file->move(public_path('uploads/application_files/'), $fname);
            $files_arr[] = $fname;
         }
      }else{
         $files_arr = [];
      }

      $files_list = json_encode($files_arr);

      ApplicationConsultation::create([
         'client_name' => $request->get('client_name'),
         'client_phone' => $request->get('client_phone'),
         'client_email' => $request->get('client_email'),

         'user_type' => $request->get('user_type'),
         'service' => $request->get('service'),
         'comment' => $request->get('comment'),
         'file' => $files_list,
         'status_id' => 1,

      ]);

      return redirect()->back();
   }


   public function description($consultation)
   {
      $consultations = ApplicationConsultation::find($consultation);
      return $consultations->comment;
   }

   public function conclusion_post(Request $request, $consultation)
   {
      $consultations = ApplicationConsultation::find($consultation);
      $consultations->conclusion = $request->get('conclusion');
      $consultations->npa = json_encode($request->get('npa'));
      $consultations->save();

      return view('inner_page.applications.conclusion', compact('consultations'));

   }

   public function conclusion_get($consultation)
   {
      $consultations = ApplicationConsultation::find($consultation);
      // if($consultations->conclusion == ''){
      //    $data = [
      //       'client' => $consultations->client_name,
      //       'conclusion' => 'Пусто'
      //    ];
      // }
      // $data = [
      //    'client' => $consultations->client_name,
      //    'conclusion' => $consultations->conclusion
      // ];
      return view('inner_page.applications.conclusion', compact('consultations'));
   }


   /**
   * Display the specified resource.
   *
   * @param  \App\ApplicationConsultation  $applicationConsultation
   * @return \Illuminate\Http\Response
   */
   public function show(ApplicationConsultation $applicationConsultation)
   {
      //
   }

   /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\ApplicationConsultation  $applicationConsultation
   * @return \Illuminate\Http\Response
   */
   public function edit(ApplicationConsultation $applicationConsultation)
   {
      //
   }

   /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\ApplicationConsultation  $applicationConsultation
   * @return \Illuminate\Http\Response
   */
   public function update(Request $request, ApplicationConsultation $applicationConsultation)
   {
      $applicationConsultation->update([
         'status_id' => 3
      ]);
      return redirect()->back();
   }

   public function application_detail($id){
      $consultation = ApplicationConsultation::find($id);
      return view('inner_page.applications.detail', compact('consultation'));
   }


   public function application_update($id)
   {
      $applicationConsultation = ApplicationConsultation::find($id);
      $applicationConsultation->update([
         'status_id' => 4,
         'closing_datetime' => Carbon::now()
      ]);
      return redirect()->back();
   }

   /**
   * Remove the specified resource from storage.
   *
   * @param  \App\ApplicationConsultation  $applicationConsultation
   * @return \Illuminate\Http\Response
   */
   public function destroy(ApplicationConsultation $applicationConsultation)
   {
      //
   }
}
