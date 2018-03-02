<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Kozz\Laravel\Facades\Guzzle;
use GuzzleHttp\Exception\RequestException;

/**
 * Model class for currency conversion
 */
class Currency extends Model
{
    /**
     * @var string 3 digit currency code of currency being converted
     */
    public $baseCurrency;
    /**
     * @var decimal Amount of currency to be converted
     */
    public $baseAmount;
    /**
     * @var string 3 digit currency code to be converted to
     */
    public $targetCurrency;
    /**
     * @var decimal Amount of currency after conversion
     */
    public $convertedAmount;
    /**
     * @var float Multiplier to calculate conversion
     */
    protected $conversionMultiplier;

    /**
     * Constructor for Currency model class
     *
     * @param string|null $base 3 digit currency code to be converted
     * @param string|null $target 3 digit currency code to be converted to
     * @param decimal|null $amount Currency amount to be converted
     */
    public function __construct($base = null, $target = null, $amount = null)
    {
    	$this->baseCurrency = $base;
    	$this->targetCurrency = $target;
    	$this->baseAmount = $amount;
    }

    /**
     * Makes API call and returns the conversion multiplier
     *
     * @return bool Status of API call
     */
    protected function getMultiplier()
    {
    	try {
	    	$response = Guzzle::get('https://api.fixer.io/latest',[
	    		'query' => [
	    			'base' => $this->baseCurrency,
	    			'symbols' => $this->targetCurrency
	    		]
	    	]);
	    }
    	catch (RequestException $e) {
            report($e);
            return false;
        }
        if ($response->getStatusCode() == 200) {
            Log::info("API Call Successful: {$response->getStatusCode()}");
            $json = json_decode($response->getBody());
            $this->conversionMultiplier = $json->rates->{$this->targetCurrency};
            return true;            
        }
        Log::error('API Error',['status' => $response->getStatusCode(), 'body' => $response->getBody()]);
        return false;
    }

    /**
     * Calculates the conversion of one currency to another
     *
     * @return mixed
     */
    public function convertCurrency()
    {
    	$result = $this->getMultiplier();
    	if ($result) {
    		$this->convertedAmount = number_format(round($this->baseAmount * $this->conversionMultiplier,2),2);
    		return $this;
    	} else {
    		return false;
    	}    	
    }
}
