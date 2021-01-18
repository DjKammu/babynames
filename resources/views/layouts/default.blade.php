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

  </head>
  <body data-new-gr-c-s-check-loaded="14.991.0" data-gr-ext-installed="">
    
<div class="container main-bg">
  <header class="blog-header py-3">
    <div class="row flex-nowrap justify-content-between align-items-center">
      <div class="col-4 pt-1 social">
        <a href=""><i class="fa fa-facebook"></i></a>
         <a href=""><i class="fa fa-instagram"></i></a>
      </div>
      <div class="col-4 text-center">
        <a class="blog-header-logo text-dark" href="{{ url('/') }}">BabyNamesWizards</a>
      </div>
      <div class="col-3 d-xs-none d-flex justify-content-end align-items-center ">
           <div class="input-group">
            <input type="text" class="form-control" placeholder="Search Name" aria-label="Recipient's username" aria-describedby="button-addon2">
            <button class="btn btn-outline-secondary" type="button" id="button-addon2"><i class="fa fa-search"></i></button>
          </div>
      </div>
    </div>
  </header>

  <div class="nav-scroller py-1 mb-2">
    <nav class="nav d-flex justify-content-between">
      <a class="p-2 link-secondary" href="{{ url('names/american') }}">American</a>
      <a class="p-2 link-secondary" href="{{ url('names/arabic') }}">Arabic</a>
      <a class="p-2 link-secondary" href="{{ url('names/australian') }}">Australian</a>
      <a class="p-2 link-secondary" href="{{ url('names/christian') }}">Christian</a>
      <a class="p-2 link-secondary" href="{{ url('names/indian') }}">Indian</a>
      <!-- <a class="p-2 link-secondary" href="{{ url('names/american') }}">More</a> -->
    </nav>
  </div>
  <main>
     @yield('content')
  	
  </main>

<footer class="blog-footer">
  <p>Blog template built for <a href="{{ url('/') }}">BabyNamesWizards.com</a> by <a href="{{ url('/') }}">@BabyNamesWizards</a>.</p>
  <p>
    <a href="#">Back to top</a>
  </p>
</footer>

</div>
</body>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
  </body>
</html>
