<?php

namespace App\Http\Controllers;

use App\Client;
use Illuminate\Http\Request;
use Auth;
use App\OnlineConsultation;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      if(Auth::check()){
         if(Auth::user()->role_id == 3){
            $lawyer_id = Auth::user()->lawyer['id'];
            $consultations = OnlineConsultation::where('lawyer_id', $lawyer_id)->get();
            $consultations_arr = [];
            foreach ($consultations as $key => $value) {
               $consultations_arr[] = $value->client_id;
            }
            $consultations = array_unique($consultations_arr);
            $clients = Client::all();
            $clients_arr = [];
            foreach ($clients as $key => $client) {
               foreach ($consultations as $key => $value) {
                  if($value == $client->id){
                     $clients_arr[] = $client;
                  }
               }
            }
            $clients = collect($clients_arr)->all();
            return view('inner_page.my_clients.index', compact('clients'));
         }
      }

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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        //
    }
}
