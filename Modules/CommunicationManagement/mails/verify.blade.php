{{-- <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
   
</head> --}}
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>@yield('page_title') | {{ $portal->Organization->organization_name }}</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="{{ asset ('images/icons/favicon.png') }}"/>
<!--===============================================================================================-->
    <link rel="stylesheet" href="{{ asset ('plugins/bootstrap-4.1/css/bootstrap.css') }}">	
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset ('fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
<!--===============================================================================================-->

	<link rel="stylesheet" type="text/css" href="{{ asset ('fonts/elegant-font/html-css/style.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset ('css/util.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset ('css/custom.css') }}">
	
 <link href="{{ asset ('css/email.css')}}" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-10 text-center">
                <img src="{{asset($portal->Organization->official_logo)}}" alt="Company Logo" height="70px;">
            </div>
            <div class="col-md-10">
                <div class="bg-dark text-center">
                    <h3 class="text-white mt-1">Welcome to GMC Digital Store</h3>
                </div> 
               
<p>
    Thanks for signing up for our newsletter.
    I am sure this is your email {{-- <span>{{ $enquiry->email }}</span><br> --}}
    We love you!!!
</p>

            </div>
        </div>
    </div>

</body>
</html>