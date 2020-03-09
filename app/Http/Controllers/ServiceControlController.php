<?php

namespace App\Http\Controllers;

use App\ServiceControl;
use Illuminate\Http\Request;

class ServiceControlController extends Controller
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
      $this->validate($request, [
          'name' => 'required', 'string', 'max:255',
          'phone' => 'required|max:255',
          'message' => 'required',
      ]);
      ServiceControl::create([
          'name' => $request->get('name'),
          'phone' => $request->get('phone'),
          'comment' => $request->get('message'),
      ]);
      return redirect()->back()->with(['message' => 'Успешно отправлено!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ServiceControl  $serviceControl
     * @return \Illuminate\Http\Response
     */
    public function show(ServiceControl $serviceControl)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ServiceControl  $serviceControl
     * @return \Illuminate\Http\Response
     */
    public function edit(ServiceControl $serviceControl)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ServiceControl  $serviceControl
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ServiceControl $serviceControl)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ServiceControl  $serviceControl
     * @return \Illuminate\Http\Response
     */
    public function destroy(ServiceControl $serviceControl)
    {
        //
    }
}
