<?php

namespace App\Http\Controllers;

use App\Experience;
use App\Lawyer;
use Auth;
use Illuminate\Http\Request;

class ExperienceController extends Controller
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
      $lawyers = Lawyer::all();
      return view('inner_page.experience.create', compact('lawyers'));
   }

   /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
   public function store(Request $request)
   {

      $lawyer = Lawyer::where('user_id', Auth::user()->id)->get()['0'];
      $lawyer_id = $lawyer['id'];
      Experience::create([
         'name' => $request->get('name'),
         'description' => $request->get('description'),
         'lawyer_id' => $lawyer_id,
         'position' => $request->get('position'),
      ]);

      return redirect()->back()->with(['messages' => 'Успешно добавлено!']);
   }

   /**
   * Display the specified resource.
   *
   * @param  \App\Experience  $experience
   * @return \Illuminate\Http\Response
   */
   public function show(Experience $experience)
   {
      //
   }

   /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Experience  $experience
   * @return \Illuminate\Http\Response
   */
   public function edit($id)
   {
      $experience = Experience::find($id);
      return view('inner_page.experience.edit', compact('experience'));
   }

   /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Experience  $experience
   * @return \Illuminate\Http\Response
   */
   public function update(Request $request, $id)
   {
      $experience = Experience::find($id);
      $lawyer = Lawyer::where('user_id', Auth::user()->id)->get()['0'];
      $lawyer_id = $lawyer['id'];
      $experience->update([
         'name' => $request->get('name'),
         'description' => $request->get('description'),
         'lawyer_id' => $lawyer_id,
         'position' => $request->get('position'),
      ]);
      return view('inner_page.experience.edit', compact('experience'));

   }

   /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Experience  $experience
   * @return \Illuminate\Http\Response
   */
   public function destroy($id)
   {
      $experience = Experience::find($id);
      $experience->delete($experience->id);
      return redirect()->back();
   }
}
