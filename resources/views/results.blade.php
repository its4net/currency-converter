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
      <h1>Currency Converter</h1>
      <p>{{ $data->baseAmount }} {{ $data->baseCurrency }} converts to {{ $data->convertedAmount }} {{ $data->targetCurrency }}</p>
    </div>    
  </div>
</div>

</body>
</html>