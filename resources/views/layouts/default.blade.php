<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" 
    crossorigin="anonymous">

    <link rel="stylesheet" href="{{ asset('css/font-awesome.css') }}" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

   {!! \App\Helpers\BabynamesWizards::getSEOTags() !!}
	
  <link rel="apple-touch-icon" sizes="180x180" href="{{ \Storage::url('favicon/apple-touch-icon.png') }}">
  <link rel="icon" type="image/png" sizes="32x32" href="{{ \Storage::url('favicon/favicon-32x32.png') }}">
  <link rel="icon" type="image/png" sizes="16x16" href="{{ \Storage::url('favicon/favicon-16x16.png') }}">
  <link rel="manifest" href="{{ \Storage::url('favicon/site.webmanifest') }}">

	<link rel="stylesheet" type="text/css" href="{{ asset('css/main.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/custom.css') }}">
  
  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-PWJGNKSTVQ"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-PWJGNKSTVQ');
  </script>

  </head>
  <body data-new-gr-c-s-check-loaded="14.991.0" data-gr-ext-installed="">
    
<div class="container main-bg">
  <header class="blog-header py-3 d-none d-md-block">
    <div class="row flex-nowrap justify-content-between align-items-center">
      <div class="col-4 pt-1 social">
        <a href=""><i class="fa fa-facebook"></i></a>
         <a href=""><i class="fa fa-instagram"></i></a>
      </div>
      <div class="col-4 text-center">
        <a class="blog-header-logo text-dark" href="{{ url('/') }}">BabyNamesWizards</a>
      </div>
      <div class="col-3 d-xs-none d-flex justify-content-end align-items-center ">
           <!-- <div class="input-group">
            <input type="text" class="form-control" placeholder="Search Name" aria-label="Recipient's username" aria-describedby="button-addon2">
            <button class="btn btn-outline-secondary" type="button" id="button-addon2"><i class="fa fa-search"></i></button>
          </div> -->
      </div>
    </div>
  </header>

  <div>

     <nav class="navbar navbar-expand-sm bg-light navbar-light">
            <div class="container-fluid">
                <a class="navbar-brand d-md-none blog-header-logo" href="#">BabyNamesWizards</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav">
                    <li class="nav-item">
                    <a class="nav-link" href="{{ route('baby-names','american') }}">American</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="{{route('baby-names','arabic') }}">Arabic</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="{{ route('baby-names','australian') }}">Australian</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="{{ route('baby-names','christian') }}">Christian</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="{{ route('baby-names','english') }}">English</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="{{ route('baby-names','french') }}">French</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="{{ route('baby-names','indian') }}">Indian</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="{{ route('baby-names','more') }}">More</a>
                    </li>    
                </ul>
                </div>
            </div>
        </nav>
  </div>
  <main>
     @yield('content')
  	
  </main>

<footer class="blog-footer">
  <p> Copyright Reserved &copy; {{ date('Y') }} <a href="{{ url('/') }}">BabyNamesWizards.com</a> by <a href="{{ url('/') }}">@BabyNamesWizards</a>.</p>
  <p>
    <a href="javascript:void(0)">Back to top</a>
  </p>
</footer>

</div>
  <script src="{{ asset('js/jquery-min.js')}} "></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
@yield('pagescript')

</body>
</html>
