<?php

namespace App\Http\Controllers;

use App\Education;
use Illuminate\Http\Request;
use App\Lawyer;
use Auth;
class EducationController extends Controller
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
      return view('inner_page.education.create');
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
      Education::create([
          'name' => $request->get('name'),
          'degree' => $request->get('degree'),
          'special' => $request->get('special'),
          'lawyer_id' => $lawyer_id,
      ]);

      return redirect()->back()->with(['messages' => 'Успешно добавлено!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Education  $education
     * @return \Illuminate\Http\Response
     */
    public function show(Education $education)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Education  $education
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $education = Education::find($id);
      return view('inner_page.education.edit', compact('education'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Education  $education
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $education = Education::find($id);
      $lawyer = Lawyer::where('user_id', Auth::user()->id)->get()['0'];
      $lawyer_id = $lawyer['id'];
      $education->update([
          'name' => $request->get('name'),
          'degree' => $request->get('degree'),
          'special' => $request->get('special'),
          'lawyer_id' => $lawyer_id,
      ]);
      return view('inner_page.education.edit', compact('education'));
      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Education  $education
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $education = Education::find($id);
      $education->delete($education->id);
      return redirect()->back();
    }
}
