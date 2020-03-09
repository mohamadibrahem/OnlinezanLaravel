<?php

namespace App\Http\Controllers;

use App\ConsultationFile;
use Illuminate\Http\Request;

use Auth;
use Slug;
use Carbon\Carbon;
use File;

class ConsultationFileController extends Controller
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
      $request->validate([
         'filename' => 'mimes:doc,docx,pdf,jpeg,jpg,png','max:4000',
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
               'consultation_id' => $request->get('consultation_id'),
               'user_id' => Auth::user()->id,
               'filename' => $fname,
               'original_name' => $filename,
            ]);
            $files->save();
         }
      }
      return back();
   }

   /**
   * Display the specified resource.
   *
   * @param  \App\ConsultationFile  $consultationFile
   * @return \Illuminate\Http\Response
   */
   public function show(ConsultationFile $consultationFile)
   {
      //
   }

   /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\ConsultationFile  $consultationFile
   * @return \Illuminate\Http\Response
   */
   public function edit(ConsultationFile $consultationFile)
   {
      //
   }

   /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\ConsultationFile  $consultationFile
   * @return \Illuminate\Http\Response
   */
   public function update(Request $request, ConsultationFile $consultationFile)
   {
      //
   }

   /**
   * Remove the specified resource from storage.
   *
   * @param  \App\ConsultationFile  $consultationFile
   * @return \Illuminate\Http\Response
   */
   public function destroy(ConsultationFile $consultation_file)
   {
      $file = $consultation_file;
      $user = Auth::user();
      if($user->id == $file->user_id){
         if(file_exists(public_path('uploads/consultation_files/').$file->filename)){
            unlink(public_path('uploads/consultation_files/').$file->filename);
         }
         $file->delete();
      }
      return back();
   }

}
