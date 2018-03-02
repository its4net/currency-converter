<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
<title>{{ config('app.name', 'Currency Converter') }}</title>
@section('metaTags')
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
@show

@section('stylesheets')
<link rel="stylesheet" id="app-styles"  href="{{ asset('css/app.css') }}" type="text/css" media="all" />
@show
</head>
<body>

<div class="container">
  <div class="row justify-content-center">
    <div class="col-4">
      @if (session('apiError'))
    	<div class="alert alert-danger">
        	{{ session('apiError') }}
    	</div>
	  @endif
      @if ($errors->any())
    	<div class="alert alert-danger">
	        <ul>
	            @foreach ($errors->all() as $error)
	                <li>{{ $error }}</li>
	            @endforeach
	        </ul>
    	</div>
	  @endif
      <h1>Currency Converter</h1>
      <form method="POST" action="{{ route('convert') }}">
      	{{ csrf_field() }}
	    <div class="form-group">
    		<label for="base">Convert from</label>
    		<select class="form-control" id="base" name="base">      
		      <option>AUD</option>
		      <option>CAD</option>
		      <option>EUR</option>
		      <option>GBP</option>
		      <option>JPY</option>
		      <option>USD</option>
		    </select>
  		</div>
  		<div class="form-group">
  			<label for="target">Convert to</label>
    		<select class="form-control" id="target" name="target">
		      <option>AUD</option>
		      <option>CAD</option>
		      <option>EUR</option>
		      <option>GBP</option>
		      <option>JPY</option>
		      <option>USD</option>
		    </select>
  		</div>
	    <div class="form-group">
		    <label for="amount">Amount</label>
		    <input type="numeric" class="form-control" name="amount" id="amount" placeholder="Enter amount to convert">    
	    </div>  
  		<button type="submit" class="btn btn-primary">Convert</button>
    </form>
    </div>    
  </div>
</div>

</body>
</html>