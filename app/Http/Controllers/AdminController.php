<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lawyer;
use App\City;
use App\User;
use Illuminate\Database\Eloquent\Builder;
use DB;
use Storage;
use File;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\NotificationController;
use App\Service;
use App\Experience;
use App\Education;
use Illuminate\Support\Facades\Validator;
use App\Client;
use App\OnlineConsultation;
use App\ApplicationConsultation;
use App\UrgentConsultation;
use App\LawyersSpecialization;
use App\Question;
use App\News;
use App\Contact;
use App\ServiceControl;
use App\Contracts;
use App\LawyerDoc;
use Slug;


use App\Http\Controllers\ConsultationNotificationController;

class AdminController extends Controller
{
   // USERS

   public function services(){
      $services = Service::all();
      return view('admin.services.index', compact('services'));
   }
   public function services_edit(Service $service){
      return view('admin.services.edit', compact('service'));
   }

   public function services_store(Request $request, Service $service){
      $this->validate($request, [
         'title' => 'required',
         'service-trixFields' => 'required',
      ]);
      $service->where('id', $service->id)->update([
         'name' => $request->get('title'),
         'description' => $request->get('service-trixFields')['description'],
      ]);
      return redirect('/admin/services')->with(['messages' => 'Успешно добавлено!']);
   }


   public function user(){
      $users = new User;
      $users = $users->orderBy('lastname', 'asc')->paginate(20);
      return view('admin.users.index', compact('users'));
   }

   public function contact_form(){
      $contacts = new Contact;
      $contacts = $contacts->paginate(20);
      return view('admin.contacts.index', compact('contacts'));
   }

   public function service_control_form(){
      $contacts = new ServiceControl;
      $contacts = $contacts->paginate(20);
      return view('admin.service_control.index', compact('contacts'));
   }

   public function news(){
      $news = new News;
      $news = $news->orderBy('created_at', 'asc')->paginate(20);
      return view('admin.news.index', compact('news'));
   }

   public function news_create_page(){
      return view('admin.news.create');
   }

   public function news_store(Request $request){
      $this->validate($request, [
         'title' => 'required',
         'news-trixFields' => 'required',
      ]);
      News::create([
         'title' => $request->get('title'),
         'text' => $request->get('news-trixFields')['text'],
      ]);

      return redirect('/admin/news')->with(['messages' => 'Успешно добавлено!']);
   }
   public function news_delete($id){
      $news = News::find($id);
      $news->delete($news->id);
      return redirect()->back();
   }


   public function contracts(){
      $contracts = new Contracts;
      $contracts = $contracts->orderBy('created_at', 'asc')->paginate(20);
      return view('admin.contracts.index', compact('contracts'));
   }

   public function contracts_create_page(){
      return view('admin.contracts.create');
   }

   public function contracts_store(Request $request){

      $upload_files = $request->file();
      foreach ($upload_files as $f) {
         $forigname = $f->getClientOriginalName();
         $filename = pathinfo($forigname, PATHINFO_FILENAME);
         $extension = pathinfo($forigname, PATHINFO_EXTENSION);
         $ftname = Slug::make($filename);
         $fname = time().'_'.$ftname.'.'.$extension;
         $f->move(public_path('uploads/contracts'), $fname);
      }

      Contracts::create([
         'title' => $request->get('title'),
         'text' => $request->get('text'),
         'file' => $fname,
         'price' => $request->get('price'),
      ]);
      return redirect('/admin/contracts')->with(['messages' => 'Успешно добавлено!']);
   }
   public function contracts_delete($id){
      $contracts = Contracts::find($id);
      $contracts->delete($contracts->id);
      return redirect()->back();
   }


   public function question(){
      $questions = new Question;
      $questions = $questions->orderBy('created_at', 'asc')->paginate(20);
      return view('admin.questions.index', compact('questions'));
   }

   public function questions_create_page(){
      $specializations = Service::all();
      return view('admin.questions.create', compact('specializations'));
   }

   public function question_store(Request $request){

      Question::create([
         'title' => $request->get('title'),
         'text' => $request->get('text'),
         'status' => 'accepted',
         'service_id' => $request->get('service'),
      ]);

      return redirect('/admin/questions')->with(['messages' => 'Успешно добавлено!']);
   }


   public function question_delete($id){
      $question = Question::find($id);
      $question->delete($question->id);
      return redirect()->back();
   }


   // DOCTORS

   // public function doctor_filter(Request $request){
   //    $doctors = Doctor::where('id', $request->get('doctorname'))->get();
   //    $doctors = collect($doctors)->where('user.lastname', 'like', '%'.$request->get('doctorname').'%')->paginate(10);
   // }
   public function lawyer(Request $request){

      $lawyers = Lawyer::paginate(10);
      return view('admin.lawyers.index', compact('lawyers'));
   }

   public function lawyer_create_page(){
      $user = Auth::user();
      $specializations = Service::all();
      $cities = City::orderBy('name', 'asc')->get();

      return view('admin.lawyers.create', compact('specializations', 'cities', 'data'));
   }
   //
   public function lawyer_create(Request $request){

      $this->validate($request, [
         'firstname' => 'required', 'string', 'max:255',
         'lastname' => 'required', 'string', 'max:255',
         'phone' => ['required', 'unique:users', 'min:10'],
         'email' => 'required|string|email|max:255|unique:users',
         'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
         'password_confirmation' => 'min:6',
         'specialization' => 'required',
         'city' => 'required',
      ]);


      if ($request->hasFile('input_img')) {
         $profileImage = $request->file('input_img');
         $filename = time() . '_' . $profileImage->getClientOriginalName();
         $path = 'profile_photo/';
         $profileImage->move(public_path('uploads/'.$path), $filename);
         $photo = strval($path . $filename);
      }else{
         $photo = '';
      }

      $experiences = Experience::where('lawyer_id', $lawyer->id)->get();
      $education = Education::where('lawyer_id', $lawyer->id)->get();

      $phone = '+7'.str_replace(['', '(', ')', '-'], '', $request->get('phone'));

      $user = User::create([
         'role_id' => 3,
         'status' => 'accepted',
         'firstname' => mb_convert_case($request->get('firstname'), MB_CASE_TITLE, "UTF-8"),
         'lastname' => mb_convert_case($request->get('lastname'), MB_CASE_TITLE, "UTF-8"),
         'middlename' => mb_convert_case($request->get('middlename'), MB_CASE_TITLE, "UTF-8"),
         'phone' => $phone,
         'email' => $request->get('email'),
         'password' => bcrypt($request->get('password')),
         'profile_photo' => $photo,

      ]);

      $lawyer = Lawyer::create([
         'user_id' => $user->id,
         'status' => 'accepted',
         'category_id' =>  json_encode($request->get('specialization2')),
         'specialization_id' =>  json_encode($request->get('specialization')),
         'service_types'  => json_encode($request->get('service_type')),
         'city_id' => $request->get('city'),
         'online_consultation_price' => 0,
         'urgent_consultation_price' => 0,
         'photo' => $photo,
      ]);

      $data = [
         'experiences' => $experiences,
         'education' => $education,
      ];
      $array_data = ['user' => $user, 'lawyer' => $lawyer, 'data' => $data];

      return redirect('/admin/lawyers')->with('success', 'Успешно добавлено!');
   }

   public function lawyer_docs(Lawyer $lawyer){
      $files = LawyerDoc::where('lawyer_id', $lawyer->id)->get();
      return view('admin.lawyers.docs', compact('lawyer', 'files'));
   }
   public function lawyer_edit(Lawyer $lawyer){
      $cities = City::all();
      $specializations = Service::all();
      $categories = LawyersSpecialization::all();
      $experiences = Experience::where('lawyer_id', $lawyer->id)->get();
      $education = Education::where('lawyer_id', $lawyer->id)->get();

      $specialization_arr = [];
      foreach($specializations as $specialization){
         if(json_decode($lawyer->specialization_id) != null){
            foreach(json_decode($lawyer->specialization_id) as $key => $spec){
               if($specialization->id == $spec){
                  $specialization_arr[] = $specialization->name;
               }
            }
         }
      }
      $specialization_name = rtrim(implode(', ', $specialization_arr), ',');


      $category_arr = [];
      foreach($categories as $category){
         if(json_decode($lawyer->category_id) != null){
            foreach(json_decode($lawyer->category_id) as $cat){
               if($category->id == $cat){
                  $category_arr[] = $category->name;
               }
            }
         }
      }

      $category_name = rtrim(implode(', ', $category_arr), ',');

      $data = [
         'specializations' => $specializations,
         'lawyer' => $lawyer,
         'specialization_name' => $specialization_name,
         'category_name' => $category_name,
         'experiences' => $experiences,
         'education' => $education,
         'categories' => $categories,
         'cities' => $cities,
         'categories' => $categories,
      ];


      return view('admin.lawyers.edit', compact('data'));
   }


   public function lawyer_accepted(Request $request, User $user, Lawyer $lawyer){
      $lawyer->update([
         'status' => 'accepted'
      ]);
      $email = $lawyer->user['email'];
      $phone = $lawyer->user['phone'];
      $controller = new NotificationController;
      $controller->profile_accept($email, $phone);
      return redirect()->back();
   }

   public function lawyer_not_accepted(Request $request, User $user, Lawyer $lawyer){
      $lawyer->update([
         'status' => 'not_accepted'
      ]);
      return redirect()->back();
   }

   public function lawyer_update(Request $request, User $user, Lawyer $lawyer){

      // $this->validate($request,[
      //    'photo' => 'mimes:jpeg,jpg,png|required|max:120000'
      // ]);

      $filename_photo = $lawyer->user['profile_photo'];



      if ($request->hasFile('photo')) {
         if(File::exists(public_path('uploads/').$filename_photo)){
            File::delete(public_path('uploads/').$filename_photo);
         }
         $profileImage = $request->file('photo');
         $filename = time() . '_' . $profileImage->getClientOriginalName();
         $profileImage->move(public_path('uploads/profile_photo/'), $filename);
         $photo = strval('profile_photo/' . $filename);
      }else{
         $photo = $lawyer->user['profile_photo'];
      }




      if($request->get('phone') != null){
         $phone = str_replace([' ', '(', ')', '-'], '', $request->get('phone'));
      }else{
         $phone = $lawyer->user['phone'];
      }

      $request->merge([
         'phone' => $phone,
      ]);



      // Validator::make($request->all(), [
      //    'phone' => 'unique:users,phone,' . Auth::user()->id . ',id',
      //    'email' => 'unique:users,email,'. Auth::user()->id . ',id', 'email',
      //    'firstname' => 'required',
      //    'lastname' => 'required',
      //    'specialization' => 'required',
      // ])
      // ->validate();

      if($request->get('urgent_price') != null){
         $urgent_price = $request->get('urgent_price');
      }else{
         $urgent_price = 0;
      }
      if($request->get('online_price') != null){
         $online_price = $request->get('online_price');
      }else{
         $online_price = 0;
      }

      $lawyer->where('user_id', $lawyer->user['id'])->update([
         'specialization_id' => json_encode($request->get('specialization')),
         'category_id' => json_encode($request->get('specialization2')),
         'city_id' => $request->get('city'),
         'biography' => $request->get('biography'),
         'service_types' => json_encode($request->get('service_type')),
         'urgent_consultation_price' => $urgent_price,
         'online_consultation_price' => $online_price,
      ]);

      $user->where('id', $lawyer->user['id'])->update([
         'firstname'=> $request->get('firstname'),
         'lastname'=> $request->get('lastname'),
         'middlename'=> $request->get('middlename'),
         'phone'=> $phone,
         'email'=> $request->get('email'),
         'profile_photo' => $photo

      ]);

      return redirect()->back();
   }



   public function experience_store(Request $request){

      Experience::create([
         'name' => $request->get('name'),
         'description' => $request->get('description'),
         'position' => $request->get('position'),
         'lawyer_id' => $request->get('lawyer_id'),
      ]);


      return redirect()->back()->with(['messages' => 'Успешно добавлено!']);
   }


   public function education_store(Request $request){

      Education::create([
         'name' => $request->get('name'),
         'degree' => $request->get('degree'),
         'special' => $request->get('special'),
         'lawyer_id' => $request->get('lawyer_id'),
      ]);

      return redirect()->back()->with(['messages' => 'Успешно добавлено!']);
   }


   public function experience_delete($id)
   {
      $experience = Experience::find($id);
      $experience->delete($experience->id);
      return redirect()->back();
   }

   public function education_delete($id)
   {
      $education = Education::find($id);
      $education->delete($education->id);
      return redirect()->back();
   }


   // public function doctor_accepted(Doctor $doctor){
   //    $doctor->status = 1;
   //    $doctor->save();
   //    $phone = $doctor->user['phone'];
   //    $email = $doctor->user['email'];
   //    $controller = new NotificationController;
   //    $controller->profile_accept($email, $phone);
   //    return back();
   // }
   //
   //
   // public function doctor_weight(Request $request, Doctor $doctor){
   //    $doctor->weight = $request->get('weight');
   //    $doctor->save();
   //    return back();
   // }
   //
   // public function doctor_blocked(Doctor $doctor){
   //    $doctor->status = 0;
   //    $doctor->save();
   //    return back();
   // }
   public function lawyer_delete($id){
      $lawyer = Lawyer::find($id);
      $experiences = Experience::all();
      $educations = Education::all();
      $users = User::all();
      foreach($users as $user){
         if($user->id == $lawyer->user_id){
            $user->delete($user->id);
         }
      }
      foreach ($experiences as $experience) {
         if($experience->lawyer_id == $id){
            $experience->delete($experience->lawyer_id);
         }
      }

      foreach ($educations as $education) {
         if($education->lawyer_id == $id){
            $education->delete($education->lawyer_id);
         }
      }

      $lawyer->delete($lawyer->id);
      return back();
   }
   //
   // // DASHBOARD
   // public function dashboard(){
   //    return view('admin.dashboard');
   // }

   // // PROFILE
   public function profile(){
      return view('admin.profile');
   }
   //
   // //PATIENTS
   public function clients(){
      $clients = Client::all();
      return view('admin.clients.index', compact('clients'));
   }
   //
   // //CONSULTATIONS
   public function consultation_urgent(){
      $consultations = new UrgentConsultation();
      $consultations = $consultations::orderBy('created_at', 'desc')->paginate(20);
      return view('admin.consultations.urgent.index', compact('consultations'));
   }

   public function consultation_urgent_conclusion($consultation){
      $consultations = UrgentConsultation::find($consultation);
      return view('admin.consultations.urgent.conclusion', compact('consultations'));
   }

   public function consultation_application_conclusion($consultation){
      $consultations = ApplicationConsultation::find($consultation);
      return view('admin.consultations.offline.conclusion', compact('consultations'));
   }


   public function consultation_online(){
      $now_time = Carbon::now();
      $appointments = new OnlineConsultation();
      $appointments = $appointments::orderBy('datetime', 'desc')->paginate(20);
      return view('admin.consultations.online.index', compact('appointments', 'now_time'));
   }
   public function consultation_application(){
      $now_time = Carbon::now();
      $receptions = new ApplicationConsultation();
      $receptions = $receptions::orderBy('created_at', 'desc')->paginate(20);
      return view('admin.consultations.offline.index', compact('receptions', 'now_time'));
   }

   public function application_comment(ApplicationConsultation $consultation){
      return view('admin.consultations.offline.comment', compact('consultation'));
   }

   public function application_lawyer_edit(ApplicationConsultation $consultation){
      $lawyers = Lawyer::paginate(20);
      $specializations = Service::all();
      $specializations2 = LawyersSpecialization::all();
      return view('admin.consultations.offline.edit', compact('lawyers', 'consultation', 'specializations', 'specializations2'));
   }

   public function application_lawyer_store(Request $request, ApplicationConsultation $consultation){
      $consultation->lawyer_id = $request->get('lawyer');
      $consultation->status_id = 3;
      $consultation->received_datetime = Carbon::now();
      $updated = $consultation->update();
      if($updated){
         $lawyer_id = $consultation->lawyer_id;
         $consultation_id = $consultation->id;
         $notification = new ConsultationNotificationController;
         $notification->application_store($lawyer_id, $consultation_id);
      }

      return redirect('/admin/consultations/application');
   }


   public function lawyers_specializations()
   {  $lawyersSpecializations = LawyersSpecialization::paginate(20);
      return view('admin.lawyers_specializations.index', compact('lawyersSpecializations'));
   }


   public function lawyers_specializations_create_page(){
      return view('admin.lawyers_specializations.create');
   }


   public function create(Request $request){

      $this->validate($request, [
         'name' => 'required', 'string', 'min:3', 'max:5',
         'description' => 'required', 'string', 'max:5',
      ]);


      LawyersSpecialization::create([
         'name' => $request->get('name'),
         'description' => $request->get('description'),
      ]);

      return redirect()->back()->with(['messages' => 'Успешно добавлено!']);
   }


   public function delete_specialization($id)
   {
      $specialization = LawyersSpecialization::find($id);
      $specialization->delete($specialization->id);
      return redirect()->back()->with(['messages' => 'Успешно удалено!']);
   }

   public function update_specialization_page(LawyersSpecialization $id)
   {  
      return view('admin.lawyers_specializations.update', compact('id'));
   }


   public function update_specialization(LawyersSpecialization $id)
   {  

      $id->update([
         'name' => request('name'),
         'description' => request('description'),         
      ]);

      return redirect()->back()->with(['messages' => 'Успешно обновлено!']);
   }





   //
   // //INTERPRETATIONS
   // public function interpretation_scans(){
   //    $interpretations = Interpretation::orderBy('created_at', 'desc')->paginate(20);
   //    return view('admin.interpretations.scans.index', compact('interpretations'));
   // }
   // public function interpretation_analyses(){
   //    return view('admin.interpretations.analyses.index');
   // }
   //
   // //PAYMENTS
   // public function payment(){
   //    $payments = new PaymentHistory();
   //    $payments = $payments::orderBy('created_at', 'desc')->paginate(20);
   //    return view('admin.payments.index', compact('payments'));
   // }
   //
   // //SPECIALIZATION
   // public function specialization(){
   //    $specializations = new Category();
   //    $specializations = $specializations::orderBy('title', 'ASC')->paginate(20);
   //    return view('admin.specializations.index', compact('specializations'));
   // }
   // public function specialization_create(){
   //    return view('admin.specializations.create');
   // }
   // public function specialization_store(Request $request, Category $specialization){
   //    $this->validate($request, [
   //       'name' => 'required',
   //    ]);
   //
   //    $specialization = new Category([
   //       'title' => $request->get('name'),
   //       'description' => $request->get('description'),
   //       'parent_id' => 0,
   //    ]);
   //    $specialization->save();
   //    return back();
   // }
   //
   // //INSTITUTIONS
   // public function institutions(){
   //    $institutions = new Institution();
   //    $institutions = $institutions::orderBy('name', 'ASC')->paginate(20);
   //    return view('admin.institutions.index', compact('institutions'));
   // }
   // public function institution_create(){
   //    return view('admin.institutions.create');
   // }
   // public function institution_store(Request $request, Institution $institution){
   //    $this->validate($request, [
   //       'name' => 'required',
   //    ]);
   //    $institution = new Institution([
   //       'name' => $request->get('name'),
   //       'address' => $request->get('address'),
   //       'city' => $request->get('city'),
   //    ]);
   //    $institution->save();
   //    return back();
   // }
   //
   // //CITIES
   // public function cities(){
   //    $cities = new City();
   //    $cities = $cities::orderBy('name', 'ASC')->paginate(20);
   //    return view('admin.cities.index', compact('cities'));
   // }
   //
   // //QUALIFICATONS
   // public function qualifications(){
   //    $qualifications = new Qualification();
   //    $qualifications = $qualifications::orderBy('name', 'ASC')->paginate(20);
   //    return view('admin.qualifications.index', compact('qualifications'));
   // }
   //
   // //REPORTS
   // public function reports(){
   //    return view('admin.reports.index');
   // }

}
