<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Lawyer;
use App\Client;
use App\LawyerDoc;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Storage;
use File;
use Slug;
use Illuminate\Http\Request;
use App\Http\Controllers\NotificationController;

class RegisterController extends Controller
{
   /*
   |--------------------------------------------------------------------------
   | Register Controller
   |--------------------------------------------------------------------------
   |
   | This controller handles the registration of new users as well as their
   | validation and creation. By default this controller uses a trait to
   | provide this functionality without requiring any additional code.
   |
   */

   use RegistersUsers;

   /**
   * Where to redirect users after registration.
   *
   * @var string
   */
   protected $redirectTo = '/';

   /**
   * Create a new controller instance.
   *
   * @return void
   */
   public function __construct()
   {
      $this->middleware('guest');
   }

   /**
   * Get a validator for an incoming registration request.
   *
   * @param  array  $data
   * @return \Illuminate\Contracts\Validation\Validator
   */
   protected function validator(array $data)
   {
      $phone = str_replace([' ', '(', ')', '-'], '', $data['phone']);
      $request = request();
      if($request->hasFile('lawyer_docs')){
         $docs = $request->file('lawyer_docs');
      }else{
         $docs = '';
      }
      
      if($data['user_type'] == 'lawyer'){
         $role = 3;
      }elseif($data['user_type'] == 'client'){
         $role = 4;
      }

      if($role == 3){
         $data = [
            'firstname'=> $data['firstname'],
            'lastname'=> $data['lastname'],
            'email'=> $data['email'],
            'phone'=> $phone,
            'lawyer_docs' => $docs,
            'password'=> $data['password'],
            'password_confirmation'=> $data['password_confirmation'],
         ];
      }else if($role == 4){
         $data = [
            'firstname'=> $data['firstname'],
            'lastname'=> $data['lastname'],
            'email'=> $data['email'],
            'phone'=> $phone,
            'password'=> $data['password'],
            'password_confirmation'=> $data['password_confirmation'],
         ];
      }

      if($role == 3){
         return Validator::make($data, [
            'lawyer_docs' => ['required'],
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'unique:users', 'min:10'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
         ]);
      }else if($role == 4){
         return Validator::make($data, [
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'unique:users', 'min:10'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
         ]);
      }

   }

   /**
   * Create a new user instance after a valid registration.
   *
   * @param  array  $data
   * @return \App\User
   */
   protected function create(array $data)
   {

      $request = request();
      if ($request->hasFile('profile_photo')) {
         $profileImage = $request->file('profile_photo');
         $filename = time() . '_' . $profileImage->getClientOriginalName();
         $path = 'profile_photo/';
         $profileImage->move(public_path('uploads/'.$path), Slug::make($filename));
         $photo = strval($path . Slug::make($filename));
      }else{
         $photo = '';
      }

      if($data['user_type'] == 'lawyer'){
         $role = 3;
      }elseif($data['user_type'] == 'client'){
         $role = 4;
      }

      $user = User::create([
         'firstname' => mb_convert_case($data['firstname'], MB_CASE_TITLE, "UTF-8"),
         'lastname' => mb_convert_case($data['lastname'], MB_CASE_TITLE, "UTF-8"),
         'middlename' => mb_convert_case($data['middlename'], MB_CASE_TITLE, "UTF-8"),
         'email' => $data['email'],
         'phone' => str_replace([' ', '(', ')', '-'], '', $data['phone']),
         'profile_photo' => $photo,
         'status' => 'acceped',
         'role_id' => $role,
         'password' => bcrypt($data['password']),
      ]);

      if($role == 3){
         $lawyer = Lawyer::create([
            'user_id'=>$user->id,
            'status'=>'not_accepted',
            'specialization_id' => null,
            'category_id' => null,
            'city_id' => null,
            'online_consultation_price' => 0,
            'urgent_consultation_price' => 0,
            'education' => null,
            'biography' => null,
         ]);
         if($lawyer){

            if($request->hasFile('lawyer_docs')){
               $upload_files = $request->file('lawyer_docs');
               foreach ($upload_files as $f) {
                  $forigname = $f->getClientOriginalName();
                  $filename = pathinfo($forigname, PATHINFO_FILENAME);
                  $extension = pathinfo($forigname, PATHINFO_EXTENSION);
                  $ftname = Slug::make($filename);
                  $fname = time().'_'.$ftname.'.'.$extension;
                  $f->move(public_path('uploads/lawyer_docs'), $fname);
                  LawyerDoc::create([
                     'lawyer_id'=>$lawyer->id,
                     'filename'=>$fname,
                     'original_name'=>$filename,
                  ]);
               }
            }
         }
      }
      elseif($role == 4){
         $client = Client::create([
            'user_id'=>$user->id,
            'status'=>'accepted',
         ]);
      }
      if($user){
         $phone = $user->phone;
         $email = $user->email;
         $fullname = $user->lastname . ' ' . $user->firstname . ' ' . $user->middlename;
         $controller = new NotificationController;
         $controller->registered($email, $phone, $fullname);
      }
      return $user;

   }
}
