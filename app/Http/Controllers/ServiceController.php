<?php

namespace App\Http\Controllers;

use App\Service;
use App\Lawyer;
use App\Question;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
   /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
   public function index()
   {

      return view('inner_page.services.index');
   }

   /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
   public function create()
   {
      #ddd
   }

   /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
   public function store(Request $request)
   {
      //
   }

   /**
   * Display the specified resource.
   *
   * @param  \App\Service  $service
   * @return \Illuminate\Http\Response
   */
   public function show(Service $service)
   {
      $questions = Question::where('service_id', $service->id)->get();
      $specializations = Service::all();
      #dd($specializations);
      #dd($questions);

      $lawyers = Lawyer::where('status', 'accepted')->get();

      #dd($lawyers);

      $lawyerss = [];
      foreach ($lawyers as $lawyer) {
         if(json_decode($lawyer->specialization_id) !=null){
            foreach(json_decode($lawyer->specialization_id) as $spec){
               if($spec == $service->id){
                  $lawyerss[] = $lawyer;
               }
            }
         }
      }

      $lawyers = collect($lawyerss);

      $data = [
         'service' => $service,
         'lawyers' => $lawyers,
         'questions' => $questions,
         'specializations' => $specializations,
      ];

      #dd($data);

      return view('inner_page.services.show', compact('data'));
   }

   /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Service  $service
   * @return \Illuminate\Http\Response
   */
   public function edit(Service $service)
   {
      //
   }

   /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Service  $service
   * @return \Illuminate\Http\Response
   */
   public function update(Request $request, Service $service)
   {
      //
   }

   /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Service  $service
   * @return \Illuminate\Http\Response
   */
   public function destroy(Service $service)
   {
      //
   }
}
