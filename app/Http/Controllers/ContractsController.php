<?php

namespace App\Http\Controllers;

use App\Contracts;
use Illuminate\Http\Request;

class ContractsController extends Controller
{
   /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
   public function index()
   {
      $contracts = Contracts::all();
      return view('inner_page.contracts.index', compact('contracts'));
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
   * @param  \App\Contracts  $contracts
   * @return \Illuminate\Http\Response
   */
   public function show(Contracts $contract)
   {
      return view('inner_page.contracts.show',  compact('contract'));
   }

   /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Contracts  $contracts
   * @return \Illuminate\Http\Response
   */
   public function edit(Contracts $contracts)
   {
      //
   }

   /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Contracts  $contracts
   * @return \Illuminate\Http\Response
   */
   public function update(Request $request, Contracts $contracts)
   {
      //
   }


   public function download(Request $request, $contract)
   {
      $contract = Contracts::find($contract);
      return $contract->file;
   }
   /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Contracts  $contracts
   * @return \Illuminate\Http\Response
   */
   public function destroy(Contracts $contracts)
   {
      //
   }
}
