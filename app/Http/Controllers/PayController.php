<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use CloudPayments;

class PayController extends Controller
{
#   private $x;
	public function doPayment()
	{	    
	    $array = [
	        'Amount' => 10,// Required
	        'Currency' => 'USD', // Required
	        'Name' => 'Last name', // Required
	        'CardCryptogramPacket' => '014242422424200202RFjR5ZGPMYrTCLKFcFfIUuTonrkdkHmtcZnI', // Required
	        'Email' => 'admin@mail.com',
	        'IpAddress' => $_SERVER['REMOTE_ADDR'],
	    ];

	    // Trying to do Payment
	    try {
	        $result = CloudPayments::cardsCharge($array);
	    } catch (\Exception $e) {
	        $result = $e->getMessage();
	    }

	   # return $array;


        $this->x = $array;
	    return $this->x;

/*
	   return redirect()
	   ->route('redirectPay', $array)
	   ->with('info', $array);
*/
	}


	public function card3ds()
	{	
		#Ловим сессию
		#dd(session()->get('info'));

		
		$this->doPayment();
		dd($this->x);

		/*
		$a = new PayController();
		$b = $a->doPayment();
		dd($b);*/
	}




}




