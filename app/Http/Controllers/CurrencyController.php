<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Currency;
use App\Http\Requests\CurrencyRequest;

class CurrencyController extends Controller
{
    /**
     * Index action for the Currency Controller
     */
    public function index()
    {
    	return view('index');
    }

	/**
	 * Convert action for the Currency Controller
	 *
	 * @param CurrencyRequest $request The data from the form
	 */
	public function convert(CurrencyRequest $request)
	{
		$convert = new Currency($request->base,$request->target,$request->amount);
    	if (is_object($convert->convertCurrency())) {
    		return view('results',['data' => $convert]);
    	} else {
    		return redirect()->route('index')->with('apiError','There was a problem retrieving currency conversion information.');
    	}
	}
    
}
