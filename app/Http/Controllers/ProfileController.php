<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;
use File;
use Auth;

use App\User;
use App\City;
use App\Lawyer;
use App\Client;
use App\LawyersSpecialization;
use App\Experience;
use App\Education;
use App\Service;
use App\LawyerDoc;


use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
   public function index(){


      $user = Auth::user();
      $cities = City::all();
      if($user->role_id == 3){
         $specializations = Service::all();
         $categories = LawyersSpecialization::all();
         $lawyer = Lawyer::where('user_id', $user->id)->get();
         foreach ($lawyer as $value) {
            $lawyer = $value;
         }
         $files = LawyerDoc::where('lawyer_id', $lawyer->id)->get();
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
      }

      if($user->role_id == 3){
         $data = [
            'user' => $user,
            'specializations' => $specializations,
            'categories' => $categories,
            'lawyer' => $lawyer,
            'specialization_name' => $specialization_name,
            'category_name' => $category_name,
            'experiences' => $experiences,
            'education' => $education,
            'categories' => $categories,
            'cities' => $cities,
            'files' => $files,
         ];
      }
      if($user->role_id == 4){
         $data = [
            'user' => $user,
         ];
      }

      return view('inner_page.profile.index', compact('data'));

   }


   public function edit(){
      $user = Auth::user();
      $specializations = Service::all();
      $categories = LawyersSpecialization::all();
      $lawyer = Lawyer::where('user_id', $user->id)->get();
      foreach ($lawyer as $value) {
         $lawyer = $value;
      }

      $experiences = Experience::where('lawyer_id', $lawyer->id)->get();
      $education = Education::where('lawyer_id', $lawyer->id)->get();

      $specialization_arr = [];
      foreach ($specializations as $key => $specialization){
         foreach (json_decode($lawyer->specialization_id) as $key => $spec){
            if($specialization->id == $spec){
               $specialization_arr[] = $specialization->name;
            }
         }
      }
      $specialization_name = rtrim(implode(', ', $specialization_arr), ',');


      $category_arr = [];
      foreach($categories as $category){
         foreach(json_decode($lawyer->category_id) as $cat){
            if($category->id == $cat){
               $category_arr[] = $category->name;
            }
         }
      }

      $category_name = rtrim(implode(', ', $category_arr), ',');


      $data = [
         'user' => $user,
         'specializations' => $specializations,
         'lawyer' => $lawyer,
         'specialization_name' => $specialization_name,
         'category_name' => $category_name,
         'experiences' => $experiences,
         'education' => $education,
         'categories' => $categories
      ];

      return view('inner_page.profile.edit', compact('data'));
   }


   public function update_user(Request $request, User $user, Lawyer $lawyer, Client $client){

      $this->validate($request,[
         'video' => 'mimes:mp4,mov,ogg,qt | max:30000'
      ]);

      $filename_photo = Auth::user()->profile_photo;



      if ($request->hasFile('photo')) {
         if(File::exists(public_path('uploads/').$filename_photo)){
            File::delete(public_path('uploads/').$filename_photo);
         }
         $profileImage = $request->file('photo');
         $filename = time() . '_' . $profileImage->getClientOriginalName();
         $profileImage->move(public_path('uploads/profile_photo/'), Slug::make($filename));
         $photo = strval('profile_photo/' . Slug::make($filename));
      }else{
         $photo = Auth::user()->profile_photo;
      }




      if($request->get('phone') != null){
         $phone = str_replace([' ', '(', ')', '-'], '', $request->get('phone'));
      }else{
         $phone = Auth::user()->phone;
      }

      $request->merge([
         'phone' => $phone,
      ]);


      if(Auth::user()->role_id == 4){

         Validator::make($request->all(), [
            'phone' => 'unique:users,phone,' . Auth::user()->id . ',id',
            'email' => 'unique:users,email,'. Auth::user()->id . ',id', 'email',
            'firstname' => 'required',
            'lastname' => 'required',
         ])
         ->validate();

         $client->where('user_id', Auth::user()->id)->update([
            'date_storage' => $request->get('date_storage')
         ]);
      }


      if(Auth::user()->role_id == 3){

         Validator::make($request->all(), [
            'phone' => 'unique:users,phone,' . Auth::user()->id . ',id',
            'email' => 'unique:users,email,'. Auth::user()->id . ',id', 'email',
            'firstname' => 'required',
            'lastname' => 'required',
            'specialization' => 'required',
         ])
         ->validate();

         $this->validate($request, [
            'service_type' => 'required',
         ],
         [
            'service_type.required' => 'Вы должны выбрать хотя бы одну предоставляемую услугу',
         ]
      );



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


      if($request->hasFile('video')) {
         $video = Auth::user()->lawyer['video'];
         if(File::exists(public_path('uploads/profile_video/').$video)){
            File::delete(public_path('uploads/profile_video/').$video);
         }
         $profileVideo = $request->file('video');
         $video = time() . '_' . $profileVideo->getClientOriginalName();
         $profileVideo->move(public_path('uploads/profile_video/'), $video);
         $video = strval($video);
      }else{
         $video = Auth::user()->lawyer['video'];
      }

      $lawyer->where('user_id', Auth::user()->id)->update([
         'specialization_id' => json_encode($request->get('specialization')),
         'category_id' => json_encode($request->get('specialization2')),
         'city_id' => $request->get('city'),
         'biography' => $request->get('biography'),
         'service_types' => json_encode($request->get('service_type')),
         'urgent_consultation_price' => intval($urgent_price),
         'online_consultation_price' => intval($online_price),
         'video' => $video,
      ]);
   }

   $user->where('id', Auth::user()->id)->update([
      'firstname'=> $request->get('firstname'),
      'lastname'=> $request->get('lastname'),
      'middlename'=> $request->get('middlename'),
      'phone'=> $phone,
      'email'=> $request->get('email'),
      'profile_photo' => $photo

   ]);

   return redirect()->back();
}


public function delete_video(Request $request, User $user, Lawyer $lawyer){
   $video = Auth::user()->lawyer['video'];
   if(File::exists(public_path('uploads/profile_video/').$video)){
      File::delete(public_path('uploads/profile_video/').$video);
   }
   if(Auth::user()->role_id == 3){
      $lawyer->where('user_id', Auth::user()->id)->update([
         'video' => ''
      ]);
   }
   return redirect()->bacK();
}

}
